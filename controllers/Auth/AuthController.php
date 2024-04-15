<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\API\User\CustomUser;

class AuthController extends Controller
{
    // Ação para autenticar e gerar token
    public function actionLogin()
    {
        if (Yii::$app->request->isPost) {
            $cpf = Yii::$app->request->post('cpf');
            $password = Yii::$app->request->post('password');

            $user = CustomUser::findByCpf($cpf); // Supondo que você tenha uma função findByCpf no seu model de usuário

            if ($user !== null && $user->validatePassword($password)) {
                // Gera um token Bearer válido
                $token = Yii::$app->security->generateRandomString();

                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => true, 'token' => $token];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'message' => 'Invalid credentials'];
            }
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('Method Not Allowed. This endpoint supports only POST requests.');
        }
    }
}
