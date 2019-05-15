Paginate Formatter For PHP
==========================

[![CircleCI](https://circleci.com/gh/microparts/paginateformatter-php/tree/master.svg?style=svg)](https://circleci.com/gh/microparts/paginateformatter-php/tree/master)
[![codecov](https://codecov.io/gh/microparts/paginateformatter-php/branch/master/graph/badge.svg)](https://codecov.io/gh/microparts/paginateformatter-php)

This a simple formatter based on [Pagerfanta](https://github.com/whiteoctober/Pagerfanta) library.
Specially created for follow up corporate standards of pagination format.

## Installation

```bash
composer install microparts/paginateformatter-php
```

## Usage

Basic:
```php
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Microparts\PaginateFormatter\PaginateFormatter;

$adapter = new ArrayAdapter($array);
$pagerfanta = new Pagerfanta($adapter);
$paginate = new PaginateFormatter($pagerfanta);

$paginate->format(); // returns formatted output.
```

Replace current page results from Pagerfanta:
```php
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Microparts\PaginateFormatter\PaginateFormatter;

$adapter = new ArrayAdapter($array);
$pagerfanta = new Pagerfanta($adapter);
$paginate = new PaginateFormatter($pagerfanta);

$paginate->setItems($transformedModel)->format();
```

## Depends

* \>= PHP 7.1
* Composer for install package

## Additional adapters

This package also add a new following adapters:

*  `Microparts\PaginateFormatter\Adapters\BasePdoAdapter.php`
*  `Microparts\PaginateFormatter\Adapters\FluentPdoAdapter.php`
*  `Microparts\PaginateFormatter\Adapters\PaginatePdoAdapter.php`

## Output format

```json
{
  "data": [{"foo": "bar"}],
  "meta": {
    "pagination": {
      "total": 6,
      "per_page": 1,
      "current_page": 1,
      "total_pages": 6,
      "prev_page": null,
      "next_page": 2
    }
  }
}
```

## License

GNU GPL v3
