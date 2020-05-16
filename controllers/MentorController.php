<?php

namespace frontend\controllers;

use frontend\models\Profile;
use Yii;
use frontend\models\Mentor;
use frontend\models\MentorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MentorController implements the CRUD actions for Mentor model.
 */
class MentorController extends Controller
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
     * Lists all Mentor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main3';
        $searchModel = new MentorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $menteeDataProvider = $searchModel->searchMentee(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menteeDataProvider' => $menteeDataProvider,
        ]);
    }

    /**
     * Displays a single Mentor model.
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

    /**
     * Creates a new Mentor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'main3';
        $model = new Mentor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionApproveMentee($id)
    {
        $model = $this->findModel($id);
        if($model->mentor_id != Yii::$app->user->identity->id){
            throw new UnauthorizedHttpException('Invalid Request.');
        }
        $model->status=Mentor::STATUS_ACCEPTED;
        $model->save();
        $profile=Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        $profile->points+=300;
        $profile->save();
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Mentor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main5';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mentor model.
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
     * Finds the Mentor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mentor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mentor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
