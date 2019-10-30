<?php

namespace frontend\controllers;

use frontend\models\Auth;
use Yii;
use app\models\Following;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Abraham\TwitterOAuth\TwitterOAuth;
use yii\web\Response;

/**
 * FollowingController implements the CRUD actions for Following model.
 */
class FollowingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'],],],];
    }

    /**
     * Lists all Following models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $dataProvider = new ActiveDataProvider(['query' => Following::find(), 'pagination' => ['pageSize' => 5,]]);

        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single Following model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Creates a new Following model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//
//        $model = new Following();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', ['model' => $model,]);
//    }

    /**
     * Updates an existing Following model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing Following model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Following model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Following the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Following::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /* Get tweets from Twitter API
    @screen_name attribute app\models\Following
    */
    public function actionGetTweets(string $screen_name)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $model = new Auth();
        $user = Auth::findOne(['user_id' => $model->getUserId(),]);

        $connection = new TwitterOAuth(Yii::$app->params['consumerKey'], Yii::$app->params['consumerSecret']);

        $tweets = $connection->get("statuses/user_timeline", ['screen_name' => $screen_name, 'count' => 10]);

        return $this->render('tweets', ['tweets' => $tweets, 'screen_name' => $screen_name]);
    }

    public function actionSearchUser()
    {
        $model = new Following();
        if ($model->load(Yii::$app->request->post())) {
            $connection = new TwitterOAuth(Yii::$app->params['consumerKey'], Yii::$app->params['consumerSecret'], Yii::$app->params['Access_token'], Yii::$app->params['Access_token_secret']);
            $users = $connection->get("users/search", ["q" => "$model->screen_name", 'count' => 10]);
            if ($users) {
                return $this->render('create', ['model' => $model, 'users' => $users]);
            }
        }

        return $this->render('search', ['model' => $model]);
    }

    public function actionSaveChooseUser(string $screen_name)
    {
        $model = new Following();
        $model->screen_name = '@'.$screen_name;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Ok');
            return $this->redirect(['following/index']);
        }
    }
}
