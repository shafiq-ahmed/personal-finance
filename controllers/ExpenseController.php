<?php

namespace app\controllers;

use app\models\AddExpenseJob;
use app\models\Expense;
use app\models\ExpenseSearch;
use app\models\Sources;
use Yii;
use yii\db\Exception;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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


        if ($this->request->isPost) {
            //if post request successfully loaded
            //and model is successfully saved
            //redirect to view page
            try{
                if ($model->load($this->request->post()) ) {
                    //push insert operation to queue
                    Yii::$app->queue->delay(1)->push(new AddExpenseJob([
                        'model'=>$model
                    ]));

                    return $this->redirect(['index']);
                }

            }catch (\Throwable $modelSaveError){
                Yii::$app->session->setFlash('danger',$modelSaveError->getMessage());
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Expense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Expense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Displays payment view for single model
     * @param int $id ID
     * @returns string
     * @throws NotFoundHttpException
     */
    public function actionPayment($id)
    {
        $model=$this->findModel($id);


        //if there is an error in model loading or saving
        //show error flash message
        try {
            //if it is a post request
            //and model is loaded and saved properly show updated view page
            //if not a post request, show payment page
            if ($this->request->isPost && $model->load($this->request->post())) {
                //load source instance using sourceid
                $source=Sources::findOne($model->source);

                //Source must have minimum 500tk after payment
                //otherwise payment is denied and shown flash error message
                if($model->amount>$source->currentBalance-500){
                    throw new Exception('You don\'t have sufficient funds for this payment');
                }
                //TODO: Validate database entries
                //set isPaid to 1 after succesfull payment
                $model->isPaid=1;

                $model->save();
                return $this->render('view', [
                    'model' => $model
                ]);
            }
        }catch(\Throwable $modelOperationError){
            Yii::$app->session->setFlash('danger',$modelOperationError->getMessage());
        }

        return $this->render('payment',[
            'model'=>$model
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
