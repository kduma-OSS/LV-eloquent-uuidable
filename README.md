# L5-eloquent-uuidable
[![Latest Stable Version](https://poser.pugx.org/kduma/eloquent-uuidable/v/stable.svg)](https://packagist.org/packages/kduma/eloquent-uuidable) 
[![Total Downloads](https://poser.pugx.org/kduma/eloquent-uuidable/downloads.svg)](https://packagist.org/packages/kduma/eloquent-uuidable) 
[![Latest Unstable Version](https://poser.pugx.org/kduma/eloquent-uuidable/v/unstable.svg)](https://packagist.org/packages/kduma/eloquent-uuidable) 
[![License](https://poser.pugx.org/kduma/eloquent-uuidable/license.svg)](https://packagist.org/packages/kduma/eloquent-uuidable)

Eases using and generating guid's in Laravel Eloquent models.

Check full documentation here: [opensource.duma.sh/libraries/php/eloquent-uuidable](https://opensource.duma.sh/libraries/php/eloquent-uuidable)

# Setup
Install it using composer

    composer require kduma/eloquent-uuidable

# Prepare models
Inside your model (not on top of file) add following lines:
    
    use \KDuma\Eloquent\Uuidable;

In database create `uuid` string field. If you use migrations, you can use following snippet:

    $table->uuid('uuid')->unique();

# Usage
By default it generates slug on first save.

- `$model->regenerateUuid()` - Generate new uuid. (Remember to save it by yourself)
- `Model::whereUuid($uuid)->first()` - Find by guid. (`whereUuid` is query scope)
   
# Upgrade from 1.x/2.x version of `kduma/eloquent-guidable`

Add following line to yours models to switch from using `uuid` column name to `guid` as it was used in previous versions:

	protected $uuid_field = 'guid';

# Packagist
View this package on Packagist.org: [kduma/eloquent-uuidable](https://packagist.org/packages/kduma/eloquent-uuidable)
