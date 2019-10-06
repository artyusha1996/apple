<?php


namespace backend\controllers;


use App\Helpers\HttpResponseHelper;
use Yii;

class Controller extends \yii\rest\Controller
{
    /**
     * @param array $data
     * @param int $code
     * @param null $message
     * @return array
     */
    protected function responseJSON($data = [], $code = HttpResponseHelper::SUCCESS, $message = null)
    {
        $response = [];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = $code;

        if (!empty($data)) {
            $response['data'] = $data;
        }

        if (!is_null($message)) {
            $response['message'] = $message;
        }

        return $response;
    }
}
