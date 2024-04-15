<?php

namespace app\components\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\UnauthorizedHttpException;

class BearerAuth extends ActionFilter
{
    public function beforeAction($action)
    {
        $token = Yii::$app->request->headers->get('Authorization');

        if ($token !== null && preg_match('/^Bearer\s+(.*?)$/', $token, $matches)) {
            // Token Bearer encontrado, permite a ação continuar
            return true;
        } else {
            throw new UnauthorizedHttpException('Missing or invalid Bearer token.');
        }
    }
}
