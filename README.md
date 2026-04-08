# Eloquent UUID-able

Eloquent trait that adds a UUID as an additional column alongside the numeric `id` in Laravel models.

Full documentation: [opensource.duma.sh/libraries/php/eloquent-uuidable](https://opensource.duma.sh/libraries/php/eloquent-uuidable)

## Requirements

- PHP `^8.3`
- Laravel `^13.0`

## Installation

```bash
composer require kduma/eloquent-uuidable
```

## Usage

```php
use KDuma\Eloquent\Uuidable;
use KDuma\Eloquent\Attributes\HasUuid;

#[HasUuid(field: 'uuid')]
class User extends Model
{
    use Uuidable;
}
```

Add a `uuid` column to your migration:

```php
$table->uuid('uuid')->unique();
```

UUID is auto-generated on create. Find by UUID with `User::whereUuid($uuid)` or `User::byUuid($uuid)`.

> Unlike Laravel's built-in `HasUuids`, this package keeps the numeric `id` as the primary key and stores the UUID in a separate column.
