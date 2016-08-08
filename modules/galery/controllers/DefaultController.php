<?php

namespace app\modules\galery\controllers;


use Yii;
use app\modules\galery\models\Album;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `galery` module
 */
class DefaultController extends Controller
{

    /**
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Album::find()
                ->joinWith(['photo'])->select(['album.*','photo.id AS picture_id', 'photo.picture_url'])
                ->orderBy('album.name')
                ->groupBy('album.id'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
