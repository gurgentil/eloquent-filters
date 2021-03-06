# Eloquent Filters

[![Latest Version](https://img.shields.io/github/release/gurgentil/eloquent-filters.svg?style=flat-square)](https://github.com/gurgentil/eloquent-filters/releases)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/gurgentil/eloquent-filters/run-tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/gurgentil/eloquent-filters.svg?style=flat-square)](https://scrutinizer-ci.com/g/gurgentil/eloquent-filters)
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

Add the `Gurgentil\EloquentFilters\Filterable` trait to your model class. 
The trait will look for a filter builder for the model inside `App\Filters`.

## Creating filters

Run the artisan command:

```bash
php artisan make:filter Users/NameFilter
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

You can perform filter queries on your model by passing a list of filters to the `filter` method:

```php
User::filter([
    'name' => 'John',
])->get();
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
