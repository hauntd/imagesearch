<?php
/** @var $model app\models\Image */
?>
<div class="row">
    <div class="col-xs-12">
        <a class="catalog-item-link main pull-left" href="<?= $model->getUrl() ?>">
            <img class="catalog-item" src="<?= $model->getPreviewUrl() ?>">
        </a>
        <?php foreach ($model->similar as $similar): ?>
            <a class="catalog-item-link similar pull-left" href="<?= $similar->getUrl() ?>">
                <img class="catalog-item" src="<?= $similar->getPreviewUrl() ?>">
                <span class="distance"><?= $similar->score ?>%</span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
