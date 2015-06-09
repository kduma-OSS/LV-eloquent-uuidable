# L5-eloquent-guidable
[![Latest Stable Version](https://poser.pugx.org/kduma/eloquent-guidable/v/stable.svg)](https://packagist.org/packages/kduma/eloquent-guidable) 
[![Total Downloads](https://poser.pugx.org/kduma/eloquent-guidable/downloads.svg)](https://packagist.org/packages/kduma/eloquent-guidable) 
[![Latest Unstable Version](https://poser.pugx.org/kduma/eloquent-guidable/v/unstable.svg)](https://packagist.org/packages/kduma/eloquent-guidable) 
[![License](https://poser.pugx.org/kduma/eloquent-guidable/license.svg)](https://packagist.org/packages/kduma/eloquent-guidable)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/266daf9d-d071-4f3c-9055-0a5445304c90/mini.png)](https://insight.sensiolabs.com/projects/266daf9d-d071-4f3c-9055-0a5445304c90)

Eases using and generating guid's in Laravel Eloquent models.

# Setup
Add the package to the require section of your composer.json and run `composer update`

    "kduma/eloquent-guidable": "^1.1"

# Prepare models
Inside your model (not on top of file) add following lines:
    
    use \KDuma\Eloquent\Guidable;

In database create `guid` string field. If you use migrations, you can use following snippet:

    $table->string('guid')->unique();

# Usage
By default it generates slug on first save.

- `$model->newGuid()` - Generate new guid. (Remember to save it by yourself)
- `Model::whereGuid($slug)->first()` - Find by guid. (`whereGuid` is query scope)
   

# Packagist
View this package on Packagist.org: [kduma/eloquent-guidable](https://packagist.org/packages/kduma/eloquent-guidable)
