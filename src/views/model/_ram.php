<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('size') ?></label>
    <div class="input-group">
        <?= Html::activeTextInput($model, "[$i]props[ram][size]", ['class' => 'form-control', 'value' => $model->props['ram:size'] ?? null]) ?>
        <span class="input-group-addon">GB</span>
    </div>
</div>
