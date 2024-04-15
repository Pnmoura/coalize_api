<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use app\models\Product;

class ProductController extends Controller
{
    // Ação para criar um novo produto
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = new Product();

            if ($model->load(Yii::$app->request->bodyParams, '') && $model->save()) {
                return ['success' => true, 'message' => 'Product created successfully', 'data' => $model];
            } else {
                return ['success' => false, 'message' => 'Failed to create product', 'errors' => $model->errors];
            }
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('Method Not Allowed. This endpoint supports only POST requests.');
        }
    }

    // Ação para listar produtos por cliente - Passando o ID do cliente via body da requisição
    public function actionListByClient($clientId)
    {
        if (Yii::$app->request->isGet) {
            
            Yii::$app->response->format = Response::FORMAT_JSON;

            $dataProvider = new ActiveDataProvider([
                'query' => Product::find()->where(['client_id' => $clientId]),
            ]);

            return ['success' => true, 'data' => $dataProvider->getModels()];
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('Method Not Allowed. This endpoint supports only GET requests.');
        }
    }

    // Ação para listar produtos por paginação via URI
    public function actionIndex($limit = null)
    {
        if (Yii::$app->request->isGet) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $query = Product::find();
            if ($limit !== null && is_numeric($limit)) {
                $query->limit($limit);
            }

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return ['success' => true, 'data' => $dataProvider->getModels()];
        } else {
            throw new \yii\web\MethodNotAllowedHttpException('Method Not Allowed. This endpoint supports only GET requests.');
        }
    }
}
