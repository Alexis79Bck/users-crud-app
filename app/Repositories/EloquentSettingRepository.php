<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Collection;

class EloquentSettingRepository implements SettingRepositoryInterface
{
    protected Setting $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findByKey(string $key): ?Setting
    {
        return $this->model->where('key', $key)->first();
    }

    /**
     * Actualiza una configuración existente o crea una nueva.
     * @param string $key La clave de la configuración.
     * @param string $value El valor a almacenar (si es un array o booleano, se serializará).
     * @param string $type El tipo de dato para ayudar a la deserialización.
     * @param string|null $group El grupo al que pertenece la configuración.
     * @param string|null $description Una descripción de la configuración.
     * @return Setting
     */
    public function update(string $key, string $value, string $type = 'string', ?string $group = null, ?string $description = null): Setting
    {
        return $this->model->updateOrCreate(
            ['key' => $key],
            [
                'value' => $this->serializeValue($value, $type),
                'type' => $type,
                'group' => $group,
                'description' => $description,
            ]
        );
    }

    /**
     * Utiliza el método updateOrCreate de Eloquent directamente.
     * @param array $attributes Atributos para buscar o crear (ej. ['key' => 'app_name'])
     * @param array $values Valores para actualizar o crear
     * @return Setting
     */
    public function updateOrCreate(array $attributes, array $values): Setting
    {
        if (isset($values['value']) && isset($values['type'])) {
            $values['value'] = $this->serializeValue($values['value'], $values['type']);
        }
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function getGroup(string $groupName): Collection
    {
        return $this->model->where('group', $groupName)->get();
    }

    public function delete(string $key): bool
    {
        $setting = $this->findByKey($key);
        if ($setting) {
            return $setting->delete();
        }
        return false;
    }

    /**
     * Serializa el valor de la configuración según su tipo.
     * @param mixed $value
     * @param string $type
     * @return string
     */
    protected function serializeValue(mixed $value, string $type): string
    {
        return match($type) {
            'boolean' => $value ? '1' : '0', // Guardar booleanos como '1' o '0'
            'json', 'array' => json_encode($value),
            default => (string) $value,
        };
    }

    /**
     * Deserializa el valor de la configuración según su tipo.
     * @param Setting $setting
     * @return mixed
     */
    public function deserializeValue(Setting $setting): mixed
    {
        return match($setting->type) {
            'boolean' => (bool) $setting->value,
            'integer' => (int) $setting->value,
            'float' => (float) $setting->value,
            'json', 'array' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    /**
     * Actualiza múltiples settings en una sola operación.
     * @param array $settings [ [key => ..., value => ..., type => ..., group => ..., description => ...], ... ]
     * @return bool
     */
    public function updateMany(array $settings): bool
    {
        foreach ($settings as $item) {
            $this->update(
                $item['key'],
                $item['value'],
                $item['type'] ?? 'string',
                $item['group'] ?? null,
                $item['description'] ?? null
            );
        }
        return true;
    }

    /**
     * Busca un setting por grupo y clave.
     * @param string $group
     * @param string $key
     * @return Setting|null
     */
    public function findByGroupAndKey(string $group, string $key): ?Setting
    {
        return $this->model->where('group', $group)->where('key', $key)->first();
    }
}