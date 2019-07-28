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
        '_attributes' => [
            'key' => 'value'
        ], 
        'title' => 'Product One',
        'price' => [
            '_attributes' => [
                'locale' => 'us'
            ],
            '_value' => '$9.99'
        ]
    ],
    'product-2' => [
        'title' => 'Product Two',
        'price' => '$12.99'
    ]
];

$xml = ArrayToXmlConverter::convert($data);
```

The above example will generate the following result stored in the `$xml` variable. 

Notice that the `_attributes` property can be used to add property values to the current node. If you need to add `_attributes` for a node with a single value, like "price" in the "product-1" node, you need to use `_value` to specify the value of the node.

For adding properties to the root none, see below in "Conversion Options".

```xml
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <product-1 key="value">
    <title>Product One</title>
    <price locale="us">$9.99</price>
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
    'formatOutput' => true, // default - true
    'rootName' => 'new-root', // default - "root"
    'rootAttributes' => [
        'key' => 'value'
    ], // default - no attributes (empty array)
    'version' => '2.0' // default - "1.0"
]);
```

The above example will generate the following result stored in the `$xml` variable.

```xml
<?xml version="2.0" encoding="ISO-8859-15"?>
<new-root key="value">
  <foo>bar</foo>
</new-root>
```

## Running Tests
```bash
php vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.