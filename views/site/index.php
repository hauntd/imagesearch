<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $urlForm app\models\UrlForm */
/* @var $imageForm app\models\ImageForm */

$this->title = 'Image Search';
$this->context->layout = 'main_menu';
?>
<div class="container">
    <div class="site-index">
        <div class="row">
            <div class="col-xs-12">
                <div class="content-nav">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#with-file" aria-controls="settings" role="tab" data-toggle="tab">With file</a>
                        </li>
                        <li role="presentation">
                            <a href="#with-url" aria-controls="settings" role="tab" data-toggle="tab">With URL</a>
                        </li>
                    </ul>
                </div>
                <div class="content-block">
                    <div class="content-block-body">
                        <div class="alert alert-info">
                            <strong>JPG, JPEG or PNG</strong>; 2 MB max
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="with-file">
                                <?php $form = ActiveForm::begin([
                                    'options' => ['enctype' => 'multipart/form-data'],
                                    'action' => '/?type=file',
                                ]) ?>
                                <?= $form->field($imageForm, 'imageFile')->fileInput() ?>
                                <?= Html::submitButton('Find similar', ['class' => 'btn btn-primary btn-block']) ?>
                                <?php ActiveForm::end() ?>
                            </div>
                            <div class="tab-pane" id="with-url">
                                <?php $form = ActiveForm::begin(['action' => '/?type=url']) ?>
                                <?= $form->field($urlForm, 'url')->textInput(['placeholder' => 'URL'])->label(false) ?>
                                <?= Html::submitButton('Search similar images', ['class' => 'btn btn-primary btn-block']) ?>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
