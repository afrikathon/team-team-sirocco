<?php

namespace frontend\controllers;

use frontend\models\Offers;
use frontend\models\Mentor;
use Yii;
use frontend\models\Profile;
use frontend\models\Feedback;
use frontend\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\web\UnauthorizedHttpException;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main3';
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'main3';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewrate($id)
    {
        $this->layout = 'main5';
        return $this->render('viewrate', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRecruiteroffer($id)
    {
        $this->layout = 'main5';
        $model = new Offers();

        if ($model->load(Yii::$app->request->post())) {
            $talent=User::findOne($id);
            $model->talent_id=$talent->id;
            $model->talent_name=$talent->username;
            $model->talent_email=$talent->email;
            $model->recruiter_id=Yii::$app->user->identity->id;
            $model->recruiter_name=Yii::$app->user->identity->username;
            $model->recruiter_email=Yii::$app->user->identity->email;
            $model->status=Offers::STATUS_PENDING;
            if($model->save()){
                return $this->redirect(['offers/index']);
            }
        }

        return $this->render('recruiteroffer', [
            'model' => $model,
        ]);
    }


    public function actionRateAnotherTalent($id){
        $this->layout = 'main3';
        $model = new Feedback();

        if ($model->load(Yii::$app->request->post())) {
            $profile = $this->findModel($id);
            $model->user_id=$profile->user_id;
            $model->reviewer_id=Yii::$app->user->identity->id;
            if($model->save()) {
                $profile->points += ((int)$model->rating * Feedback::FEED_POINTS_BASE);
                $profile->save();
            }
            return $this->redirect(['profile/index']);
        }

        return $this->render('ratetalent', [
            'model' => $model,
        ]);

    }

    public function actionRequestMentor($id)
    {
        $this->layout = 'main5';
        $model = new Mentor();

        $mentor=User::findOne($id);
        $model->mentee_id=Yii::$app->user->identity->id;
        $model->mentee_name=Yii::$app->user->identity->username;
        $model->mentor_id=$mentor->id;
        $model->mentor_email=$mentor->email;
        $model->mentor_name=$mentor->username;
        $model->status=Mentor::STATUS_PENDING;
        if($model->save()){
            return $this->redirect(['mentor/index']);
        }

        return $this->redirect(['profile/index']);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $this->layout = 'main3';
//        $model = new Profile();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    public function actionTalent()
    {
        $this->layout = 'main3';
        $model= Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        if($model){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model = new Profile();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id=Yii::$app->user->identity->id;
            //$model->display_picture
            $model->points=200;
            $model->status=Profile::STATUS_ACTIVE;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main5';
        $model = $this->findModel($id);
        if($model->user_id != Yii::$app->user->identity->id){
            throw new UnauthorizedHttpException('You are not allowed to update another person\'s profile.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
