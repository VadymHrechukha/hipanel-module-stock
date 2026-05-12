<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <label class="control-label"><?= $model->getAttributeLabel('formfactor') ?></label>
    <?= Html::activeTextInput($model, "[$i]props[ssd][formfactor]", ['class' => 'form-control', 'value' => $model->props['ssd:formfactor'] ?? null]) ?>
</div>
