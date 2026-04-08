# Eloquent UUID-able

[![Latest Stable Version](https://poser.pugx.org/kduma/eloquent-uuidable/v/stable.svg)](https://packagist.org/packages/kduma/eloquent-uuidable)
[![Total Downloads](https://poser.pugx.org/kduma/eloquent-uuidable/downloads.svg)](https://packagist.org/packages/kduma/eloquent-uuidable)
[![License](https://poser.pugx.org/kduma/eloquent-uuidable/license.svg)](https://packagist.org/packages/kduma/eloquent-uuidable)

Eases using and generating UUIDs in Laravel Eloquent models as an additional column alongside the numeric `id`.

Check full documentation here: [opensource.duma.sh/libraries/php/eloquent-uuidable](https://opensource.duma.sh/libraries/php/eloquent-uuidable)

## Requirements

- PHP `^8.3`
- Laravel `^13.0`

## Installation

```bash
composer require kduma/eloquent-uuidable
```

## Setup

Add the `Uuidable` trait to your model:

```php
use KDuma\Eloquent\Uuidable;

class User extends Model
{
    use Uuidable;
}
```

In your migration, create a `uuid` column:

```php
$table->uuid('uuid')->unique();
```

## Configuration

### New style — PHP Attribute (recommended)

```php
use KDuma\Eloquent\Uuidable;
use KDuma\Eloquent\Attributes\HasUuid;

#[HasUuid(field: 'public_uuid', checkDuplicates: true)]
class User extends Model
{
    use Uuidable;
}
```

Available `HasUuid` parameters:
- `field` — column name to store the UUID (default: `'uuid'`)
- `checkDuplicates` — query DB to ensure uniqueness before saving (default: `false`)

### Old style — model properties (deprecated, triggers `E_USER_DEPRECATED`)

```php
class User extends Model
{
    use Uuidable;

    protected string $uuid_field = 'public_uuid';         // ⚠️ deprecated
    protected bool $check_for_uuid_duplicates = true;      // ⚠️ deprecated
}
```

## Usage

- UUID is automatically generated on `create` and `update` if the field is `null`
- `$model->regenerateUuid()` — manually regenerate (save afterwards)
- `Model::whereUuid($uuid)` — query scope to find by UUID
- `Model::byUuid($uuid)` — shorthand to retrieve a model by UUID
- `$model->getUuidField()` — returns the configured UUID field name

> **Note:** This package adds UUID as an *additional column* alongside the numeric auto-increment `id`. This is different from Laravel's built-in `HasUuids` trait which replaces the primary key.

## Upgrade from `kduma/eloquent-guidable` (1.x / 2.x)

To switch from the old `guid` column name to `uuid`, add to your model:

```php
#[HasUuid(field: 'guid')]
class User extends Model
{
    use Uuidable;
}
```

## Packagist

[kduma/eloquent-uuidable](https://packagist.org/packages/kduma/eloquent-uuidable)
