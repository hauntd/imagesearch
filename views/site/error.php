<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">
    <div class="site-index">

        <div class="content-block">
            <div class="content-block-header">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="content-block-body">
                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>

                <p>The above error occurred while the Web server was processing your request.</p>
                <p><?= Html::a('Go Back', ['/'], ['class' => 'btn btn-default btn-block']) ?></p>
            </div>
        </div>
    </div>

</div>
