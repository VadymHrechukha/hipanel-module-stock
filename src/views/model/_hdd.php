<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('formfactor') ?></label>
    <?= Html::activeTextInput($model, "[$i]props[hdd][formfactor]", ['class' => 'form-control', 'value' => $model->props['hdd']['formfactor'] ?? null]) ?>
</div>
