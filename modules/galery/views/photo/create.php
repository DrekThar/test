<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Photo */
/* @var $albumList array */
/* @var $form yii\widgets\ActiveForm */



$this->title = 'Add photo';
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="photo-form">

        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'album_id')->dropDownList($albumList) ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
