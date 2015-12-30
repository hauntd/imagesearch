<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $content string */

$this->beginContent('@app/views/layouts/main.php');
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Image Search',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Find similar', 'url' => ['/site/index']],
            ['label' => 'Catalog', 'url' => ['/site/catalog']],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>

<?php $this->endContent(); ?>
