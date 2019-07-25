# Array To XML Converter
This package converts an array of data to XML.

## Installation
Install this package using [Composer](https://getcomposer.org/)
``` bash
composer require timkippdev/array-to-xml-converter
```

## Usage

```php
use TimKippDev\ArrayToXmlConverter\ArrayToXmlConverter;

...

$data = [
    'product-1' => [
        'title' => 'Product One',
        'price' => '$9.99'
    ],
    'product-2' => [
        'title' => 'Product Two',
        'price' => '$12.99'
    ]
];

$xml = ArrayToXmlConverter::convert($data);
```

The above example will generate the following result stored in the `$xml` variable.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <product-1>
    <title>Product One</title>
    <price>$9.99</price>
  </product-1>
  <product-2>
    <title>Product Two</title>
    <price>$12.99</price>
  </product-2>
</root>
```

### Conversion Options

There is an optional second parameter for the `convert` method that accepts an array of "options" to override.

```php
use TimKippDev\ArrayToXmlConverter\ArrayToXmlConverter;

... 

$data = [
    'foo' => 'bar'
];

$xml = ArrayToXmlConverter::convert($data, [
    'encoding' => 'ISO-8859-15', // default - "UTF-8"
    'formatOutput' => false, // default - true
    'rootName' => 'new-root', // default - "root"
    'version' => '2.0' // default - "1.0
]);
```

The above example will generate the following result stored in the `$xml` variable.

```xml
<?xml version="2.0" encoding="ISO-8859-15"?>
<new-root><foo>bar</foo></new-root>
```

## Running Tests
```bash
php vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.