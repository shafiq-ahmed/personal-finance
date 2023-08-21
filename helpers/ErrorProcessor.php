<?php

namespace app\helpers;
/**
 * Class to handle error related operations and manipulate error data
 * */
class ErrorProcessor
{
    /**
     * Method for errors property and geterrors() method.
     * return a error string from arrays of errors
     * Returns string
     * */
    public static function arrayToString(array $errors)
    {
        $errorMessage = '';
        foreach ($errors as $error) {
            foreach ($error as $errorText) {
                $errorMessage .= $errorText . '<br>';
            }
        }

        return $errorMessage;
    }

}