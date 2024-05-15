<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\httpclient\Client;

class StockController extends Controller
{
    public function actionGetStockData($symbol)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api-fxtrade.oanda.com/v1/candles?instrument='.$symbol.'_USD&count=1&granularity=D')
            ->send();
        
        if ($response->isOk) {
            $data = $response->data;
            // Process and return stock data
            return $data;
        } else {
            // Return error response
            Yii::$app->response->statusCode = 500;
            return ['error' => 'Failed to fetch stock data.'];
        }
    }
}
