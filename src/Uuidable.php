<?php

declare(strict_types=1);

namespace KDuma\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use KDuma\Eloquent\Attributes\HasUuid;

trait Uuidable
{
    protected static function bootUuidable(): void
    {
        static::creating(function (Model $model): void {
            $model->generateUuidOnCreateOrUpdate();
        });

        static::updating(function (Model $model): void {
            $model->generateUuidOnCreateOrUpdate();
        });
    }

    public static function byUuid(string $uuid): static
    {
        return static::whereUuid($uuid)->first();
    }

    public function regenerateUuid(): void
    {
        $this->{$this->getUuidField()} = $this->uuidGenerate();
    }

    public function getUuidField(): string
    {
        return $this->resolveUuidableConfig('field', 'uuid_field', 'uuid');
    }

    public function scopeWhereUuid(Builder $query, string $uuid): Builder
    {
        return $query->where($this->getTable() . '.' . $this->getUuidField(), $uuid);
    }

    protected function uuidGenerate(): string
    {
        $uuid = (string) Str::uuid();

        $checkDuplicates = $this->resolveUuidableConfig('checkDuplicates', 'check_for_uuid_duplicates', false);
        if (!$checkDuplicates) {
            return $uuid;
        }

        $rowCount = DB::table($this->getTable())
            ->where($this->getUuidField(), $uuid)
            ->count();

        return $rowCount > 0 ? $this->uuidGenerate() : $uuid;
    }

    protected function generateUuidOnCreateOrUpdate(): void
    {
        if ($this->{$this->getUuidField()} === null) {
            $this->regenerateUuid();
        }
    }

    private function resolveUuidableConfig(string $attrProperty, string $legacyProperty, mixed $default): mixed
    {
        $value = static::resolveClassAttribute(HasUuid::class, $attrProperty);
        if ($value !== null) {
            return $value;
        }

        if (isset($this->{$legacyProperty})) {
            trigger_error(
                "Using \${$legacyProperty} on " . static::class . ' is deprecated. Use #[HasUuid] attribute instead.',
                E_USER_DEPRECATED,
            );
            return $this->{$legacyProperty};
        }

        return $default;
    }
}
