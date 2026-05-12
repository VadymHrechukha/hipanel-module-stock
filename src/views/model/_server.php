<?php

use yii\helpers\Html;

?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('units_qty') ?></label>
            <?= Html::activeInput('number', $model, "[$i]props[units_qty]", ['class' => 'form-control', 'min' => '1', 'max' => '100', 'value' => $model->props['server:units_qty'] ?? null]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('ram_qty') ?></label>
            <?= Html::activeInput('number', $model, "[$i]props[ram_qty]", ['class' => 'form-control', 'min' => '1', 'max' => '100', 'value' => $model->props['server:ram_qty'] ?? null]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('cpu_qty') ?></label>
            <?= Html::activeTextInput($model, "[$i]props[cpu_qty]", ['class' => 'form-control', 'value' => $model->props['server:cpu_qty'] ?? null]) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('25_hdd_qty') ?></label>
            <?= Html::activeTextInput($model, "[$i]props[25_hdd_qty]", ['class' => 'form-control', 'value' => $model->props['server:25_hdd_qty'] ?? null]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('35_hdd_qty') ?></label>
            <?= Html::activeTextInput($model, "[$i]props[35_hdd_qty]", ['class' => 'form-control', 'value' => $model->props['server:35_hdd_qty'] ?? null]) ?>
        </div>
    </div>
</div>
