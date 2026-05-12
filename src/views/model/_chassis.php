<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('formfactor') ?></label>
    <?= Html::activeTextInput($model, "[$i]props[formfactor]", ['class' => 'form-control', 'value' => $model->props['chassis:formfactor'] ?? null]) ?>
</div>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('units_qty') ?></label>
    <?= Html::activeInput('number', $model, "[$i]props[units_qty]", ['class' => 'form-control', 'min' => '1', 'max' => '100', 'value' => $model->props['chassis:units_qty'] ?? null]) ?>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('25_hdd_qty') ?></label>
            <?= Html::activeTextInput($model, "[$i]props[25_hdd_qty]", ['class' => 'form-control', 'value' => $model->props['chassis:25_hdd_qty'] ?? null]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?= $model->getAttributeLabel('35_hdd_qty') ?></label>
            <?= Html::activeTextInput($model, "[$i]props[35_hdd_qty]", ['class' => 'form-control', 'value' => $model->props['chassis:35_hdd_qty'] ?? null]) ?>
        </div>
    </div>
</div>
