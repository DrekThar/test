<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Albums', ['/galery/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add photo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="photo-list">
        <?if(!empty($dataProvider)):?>

            <div class="row">
                <?foreach($dataProvider->getModels() as $photo):?>
                    <?
                    /**
                     * @var $photo app\models\Photo
                     */
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="/galery/photo/view?id=<?= $photo->id ?>">
                                <img src="<?=$photo->preview_url?>" alt="<?= $photo->name ?>">
                            </a>
                            <div class="caption">
                                <h3><a href="/galery/photo/view?id=<?= $photo->id ?>"><?= $photo->name ?></a></h3>
                                <div class="action-buttons">
                                    <a href="/galery/photo/delete?id=<?= $photo->id ?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>

        <?endif;?>

    </div>

</div>
