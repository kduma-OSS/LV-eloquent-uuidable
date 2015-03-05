# L5-eloquent-guidable
Eases using and generating guid's in Laravel Eloquent models.

# Setup
Add the package to the require section of your composer.json and run `composer update`

    "kduma/eloquent-guidable": "~1.0"

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
