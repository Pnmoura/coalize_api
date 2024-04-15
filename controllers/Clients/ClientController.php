<?php

namespace app\controllers\Clients;

use app\models\Client;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\Controller;

class ClientController extends Controller
{
    public $modelClass = 'app\models\Client';

    public function actionCustomSelect()
    {
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand('SELECT * FROM client');
        $clients = $command->queryAll();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $clients;
    }

    public function actionIndex()
    {
        $query = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->get('pageSize', 10), // Default page size is 10
            ],
        ]);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $dataProvider;
    }
}
