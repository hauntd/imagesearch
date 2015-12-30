<?php

/** @var $model app\models\Image */
?>
<a class="grid-item-link" href="<?= $model->getUrl() ?>">
    <img class="grid-item" src="<?= $model->getPreviewUrl() ?>">
</a>
