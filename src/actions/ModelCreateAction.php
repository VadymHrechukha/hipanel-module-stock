<?php

namespace hipanel\modules\stock\actions;

use hipanel\actions\SmartCreateAction;
use hipanel\modules\stock\models\HardwareSettings;
use Yii;

class ModelCreateAction extends SmartCreateAction
{
    public function saveCollection()
    {
        $pendingHardwareSettings = $this->collectHardwareSettings();

        $result = parent::saveCollection();

        if ($result) {
            $this->persistHardwareSettings($pendingHardwareSettings);
        }

        return $result;
    }

    private function collectHardwareSettings(): array
    {
        $pending = [];
        foreach ($this->collection->models as $model) {
            if (empty($model->type) || !is_array($model->props)) {
                continue;
            }
            $typeProps = $model->props[$model->type] ?? null;
            if (!empty($typeProps)) {
                $pending[] = [
                    'model' => $model,
                    'type' => $model->type,
                    'props' => $typeProps,
                ];
            }
        }

        return $pending;
    }

    private function persistHardwareSettings(array $pendingHardwareSettings): void
    {
        foreach ($pendingHardwareSettings as $hw) {
            $model = $hw['model'];
            if (empty($model->id)) {
                continue;
            }
            try {
                HardwareSettings::perform('set-hardware-settings', [
                    'id' => $model->id,
                    'model_type' => $hw['type'],
                    'props' => [$hw['type'] => $hw['props']],
                ]);
            } catch (\Exception $e) {
                Yii::error($e->getMessage(), __METHOD__);
            }
        }
    }
}
