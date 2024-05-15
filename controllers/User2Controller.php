<?php
namespace app\controllers;

use Yii;
use app\models\User;
// use yii\web\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
class User2Controller extends ActiveController
{
    public $modelClass = 'app\models\User';
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }
    // public function init()
    // {
    //     parent::init();
    //     // Set response format to JSON
    //     \Yii::$app->response->format = Response::FORMAT_JSON;
    // }
    public function actionIndex()
    {
        $users = User::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => User::find(),
        ]);
        // return $users;
        return $this->asJson($users);
    //     return $this->render('index', ['users' => $users 
    //                     ,
    //                     'dataProvider' => $dataProvider,
    // ]);
    }

    public function actionView($id)
    {
        $user = $this->findModel($id);
        return $this->render('view', ['user' => $user]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}