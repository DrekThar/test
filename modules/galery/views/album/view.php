<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\galery\models\Album */
/* @var $photoList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',
            'author_name',
            'email:email',
            'phone',
        ],
    ]) ?>

    <h1>Photo list</h1>
    <div class="photo-list">

        <?= Html::a('Add photo', ['/galery/photo/create', 'album_id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?if(!empty($photoList)):?>

            <div class="row" style="margin-top: 15px;">
                <?foreach($photoList as $photo):?>
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
