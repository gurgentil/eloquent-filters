# Eloquent Filters

[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides a nice and easy way to add query filters to your Eloquent models without turning your model 
classes into massive God objects.

After setting it up, if you are building an API, for example, you can simply add this piece of code to your controller:

```php
User::filter($request->get('filter'))->get();
```

Now make a request to `/api/users?filter[name]=John` and let the fun begin.

## Installation

Install the package via composer:

```bash
composer require gurgentil/eloquent-filters
```

## Usage

Create a filter builder that extends `Gurgentil\EloquentFilters\FilterBuilder`. This is where you will register all the filters for your Eloquent model.

```php
namespace App\Filters;

use Gurgentil\EloquentFilters\FilterBuilder;

class UserFilters extends FilterBuilder
{
    protected $availableFilters = [];
}
```

Add a scope to the model:

```php
public function scopeFilter($query, $filters)
{
    return (new UserFilters)->apply($query, $filters);
}
```

## Creating filters

Run the artisan command:

```bash
php artisan make:filter Users\NameFilter
```

Register the filter in the builder you created previously:

```php
namespace App\Filters;

use App\Filters\Users\NameFilter;
use Gurgentil\EloquentFilters\FilterBuilder;

class UserFilters extends FilterBuilder
{
    protected $availableFilters = [
        'name' => NameFilter::class,
    ];
}
```

Last but not least, implement your query in `NameFilter`:

```php
namespace App\Filters\Users;

use Gurgentil\EloquentFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class NameFilter implements Filter
{
    /**
     * Apply filter.
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value)
    {
        return $builder->where('name', $value);
    }
}
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Gustavo Rorato Gentil](https://github.com/gurgentil)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
