<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalog';
$this->context->layout = 'main_menu';
?>
<div class="site-results">
    <div class="grid">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item_catalog',
            'itemOptions' => ['tag' => false],
            'layout' => '{summary}</div> <div class="clearfix">{items}</div> {pager}',
            'pager' => [
                'options' => ['class' => 'clearfix pagination'],
            ],
        ]) ?>
    </div>
</div>
