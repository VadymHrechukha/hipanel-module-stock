<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('max_ram_size') ?></label>
    <?= Html::activeTextInput($model, "[$i]props[motherboard][max_ram_size]", ['class' => 'form-control', 'value' => $model->props['motherboard']['max_ram_size'] ?? null]) ?>
</div>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('ram_slots') ?></label>
    <?= Html::activeInput('number', $model, "[$i]props[motherboard][ram_slots]", ['class' => 'form-control', 'min' => 1, 'max' => 100, 'value' => $model->props['motherboard']['ram_slots'] ?? null]) ?>
</div>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('cpu_sockets') ?></label>
    <?= Html::activeTextInput($model, "[$i]props[motherboard][cpu_sockets]", ['class' => 'form-control', 'value' => $model->props['motherboard']['cpu_sockets'] ?? null]) ?>
</div>
