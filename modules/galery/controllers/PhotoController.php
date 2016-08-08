<?php

namespace app\modules\galery\controllers;

use Yii;
use app\modules\galery\models\Photo;
use app\modules\galery\models\Album;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhotoController implements the CRUD actions for Photo model.
 */
class PhotoController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Photo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Photo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Photo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->album = Album::findOne($model->album_id)->name;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($album_id = null)
    {
        $model = new Photo();
        $arAlbum = Album::find()->select(['id', 'name'])->indexBy('id')->asArray()->all();
        $albumList = ['' => ''];
        foreach($arAlbum as $key => $value){
            $albumList[$key] = $value['name'];
        }

        if($album_id){
            $model->album_id = $album_id;
        }

        if (Yii::$app->request->isPost) {

            $req = Yii::$app->request->post('Photo');
            $model->name = $req['name'];
            $model->adress = $req['adress'];
            $model->album_id = $req['album_id'];
            $model->date_created = time();
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if(!$model->upload()){
                return $this->render('create', ['model' => $model,]);
            }

            if ($model->save()) {
                return $this->redirect(['/galery/album/view', 'id' => $model->album_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'albumList' => $albumList,
        ]);
    }

    /**
     * Deletes an existing Photo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Photo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
