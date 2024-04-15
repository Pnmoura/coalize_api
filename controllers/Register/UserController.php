<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\API\User\CustomUser;

class UserController extends Controller
{
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {
            $model = new CustomUser();
            $model->load(Yii::$app->request->post(), '');

            if ($model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => true, 'message' => 'User created successfully', 'data' => $model];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'message' => 'Failed to create user', 'errors' => $model->errors];
            }
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('Method Not Allowed. This endpoint supports only POST requests.');
        }
    }
}
