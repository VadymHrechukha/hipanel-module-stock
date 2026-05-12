<?php

namespace hipanel\modules\stock\actions;

use hipanel\actions\SmartUpdateAction;
use hipanel\modules\stock\models\HardwareSettings;
use Yii;

class ModelUpdateAction extends SmartUpdateAction
{
    public function fetchModels()
    {
        $models = parent::fetchModels();

        foreach ($models as $model) {
            if (!empty($model->props) && is_array($model->props)) {
                $model->props = $this->nestProps($model->props);
            }
        }

        return $models;
    }

    private function nestProps(array $flatProps): array
    {
        $nested = [];
        foreach ($flatProps as $key => $value) {
            [$type, $attr] = explode(':', $key, 2) + [1 => null];
            if ($attr !== null) {
                $nested[$type][$attr] = $value;
            }
        }
        return $nested;
    }

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
            if (empty($model->type) || !is_array($model->props) || empty($model->props[$model->type])) {
                continue;
            }
            $pending[] = [
                'id' => $model->id,
                'type' => $model->type,
                'props' => $model->props[$model->type],
            ];
        }

        return $pending;
    }

    private function persistHardwareSettings(array $pendingHardwareSettings): void
    {
        foreach ($pendingHardwareSettings as $hw) {
            if (empty($hw['id'])) {
                continue;
            }
            try {
                HardwareSettings::perform('set-hardware-settings', [
                    'id' => $hw['id'],
                    'model_type' => $hw['type'],
                    'props' => [$hw['type'] => $hw['props']],
                ]);
            } catch (\Exception $e) {
                Yii::error($e->getMessage(), __METHOD__);
            }
        }
    }
}
