<?php

namespace App\Interfaces;

use App\Models\Setting;
use Illuminate\Support\Collection;

interface SettingRepositoryInterface
{
    public function all(): Collection;
    public function findByKey(string $key): ?Setting;
    public function update(string $key, string $value, string $type = 'string', ?string $group = null, ?string $description = null): Setting;
    public function updateOrCreate(array $attributes, array $values): Setting;
    public function getGroup(string $groupName): Collection;
    public function delete(string $key): bool;
    public function updateMany(array $settings): bool;
    public function findByGroupAndKey(string $group, string $key): ?Setting;
}