<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Album', ['/galery/album/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add photo', ['/galery/photo/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <? foreach ($dataProvider->getModels() as $album): ?>
            <?
            /**
             * @var $album yii\db\BaseActiveRecord
             * @var $photo app\models\Photo
             */
            $photo = $album->getRelatedRecords();
            $photo = $photo['photo'];
            $count = $photo ? count($photo) : 0;
            if($photo){
                $photo = reset($photo);
            }
            ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href="/galery/album/view?id=<?= $album->id ?>">
                        <img src="<?=($count ? $photo->preview_url : '/images/no-image.png')?>" alt="<?= $album->name ?>">
                    </a>
                    <div class="caption">
                        <h3><a href="/galery/album/view?id=<?= $album->id ?>"><?= $album->name ?> <span class="badge"><?=$count?></span></a></h3>
                        <?if($count):?>
                            <p>Updated: <?= date("Y-m-d H:i", $album->date_updated) ?></p>
                        <?endif;?>

                        <div class="action-buttons">
                            <a href="/galery/album/update?id=<?= $album->id ?>" title="Update" aria-label="Update" data-pjax="0">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="/galery/album/delete?id=<?= $album->id ?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
