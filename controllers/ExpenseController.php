<?php

namespace app\controllers;

use app\models\AddExpenseJob;
use app\models\Expense;
use app\models\ExpenseSearch;
use app\models\Sources;
use app\models\Transactions;
use Cassandra\Time;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpenseController implements the CRUD actions for Expense model.
 */
class ExpenseController extends Controller
{
    /**
     * @inheritDoc
     */
    const MINIMUM_AMOUNT = 500;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Expense models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExpenseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expense model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {


        $model = Expense::findOne($id);
        //lazily load source model
        $source = $model->sourceModel;
        return $this->render('view', [
            'model' => $model,
            'sourceName' => $source ? $source->name : null
        ]);
    }


    /**
     * Creates a new Expense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Expense();
        $model->setScenario('create');


        if ($this->request->isPost) {
            //if post request successfully loaded
            //and model is successfully saved
            //redirect to view page
            try {
                if ($model->load($this->request->post())) {

                    /*if(!$model->save()){
                       echo "<pre>";
                       print_r($model->getErrors());
                    }*/

                    //push insert operation to queue
                    Yii::$app->queue->delay(1)->push(new AddExpenseJob([
                        'model' => $model
                    ]));

                    return $this->redirect(['index']);
                }

            } catch (\Throwable $modelSaveError) {
                Yii::$app->session->setFlash('danger', $modelSaveError->getMessage());
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Displays payment view for single model
     * @param int $id ID
     * @returns string
     * @throws NotFoundHttpException
     */
    public function actionPayment($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('make_payment');

        //if there is an error in model loading or saving
        //show error flash message


        if ($this->request->isPost) {

            $model->load($this->request->post());
            //TODO: Validate database entries


            //set isPaid to 1 after successful payment
            $model->isPaid = 1;

            //push record update operation to queue
            /*Yii::$app->queue->delay(1)->push(new AddExpenseJob([
                'model'=>$model
            ]));*/

            $transaction = Yii::$app->db->beginTransaction();

            try {
                //if it is a post request
                if ($model->save()) {
                    $transaction->commit();
                    return $this->render('view', [
                        'model' => $model,
                        'sourceName' => $model->sourceModel->name
                    ]);
                }
            } catch (\Throwable $modelOperationError) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('danger', $modelOperationError->getMessage());
            }

        }

        return $this->render('payment', [
            'model' => $model
        ]);


    }

    /**
     * Finds the Expense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Expense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expense::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
