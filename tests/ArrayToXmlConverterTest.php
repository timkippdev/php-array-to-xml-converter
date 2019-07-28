<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use TimKippDev\ArrayToXmlConverter\ArrayToXmlConverter;

class ArrayToXmlConverterTest extends TestCase {
    
    public function test_convert_simple() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => 'test'
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit>test</unit></root>', str_replace("\n", '', $response));
    }

    public function test_convert_simple_verifyInvalidKeyCharacters() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit/test' => 'test'
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit-test>test</unit-test></root>', str_replace("\n", '', $response));
    }

    public function test_convert_simple_withRootAttributes() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => 'test'
        ], [
            'formatOutput' => false,
            'rootAttributes' => [
                'key' => 'value'
            ]
        ]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root key="value"><unit>test</unit></root>', str_replace("\n", '', $response));
    }

    public function test_convert_simple_withElementAttributes() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => [
                '_attributes' => [
                    'key' => 'value'
                ],
                '_value' => 'test'
            ]
        ], [
            'formatOutput' => false,
        ]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit key="value">test</unit></root>', str_replace("\n", '', $response));
    }

    public function test_convert_verifyOptionOverrides() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => 'test'
        ], [
            'encoding' => 'ISO-8859-15',
            'formatOutput' => false, 
            'rootName' => 'new-root',
            'version' => '2.0'
        ]);

        $this->assertEquals('<?xml version="2.0" encoding="ISO-8859-15"?><new-root><unit>test</unit></new-root>', str_replace("\n", '', $response));
    }

    public function test_convert_sequentialArray() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit',
            'test'
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><item_1>unit</item_1><item_2>test</item_2></root>', str_replace("\n", '', $response));
    }

    public function test_convert_nestedArray() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => [
                'foo' => 'bar'
            ]
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit><foo>bar</foo></unit></root>', str_replace("\n", '', $response));
    }

    public function test_convert_nestedArraysInsideArray() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => [
                [ 'foo' => 'bar' ],
                [ 'biz' => 'baz' ]
            ]
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit><foo>bar</foo></unit><unit><biz>baz</biz></unit></root>', str_replace("\n", '', $response));
    }

    public function test_convert_nestedArraysInsideNestedArray() 
    {
        $response = ArrayToXmlConverter::convert([
            'unit' => [
                'foo' => [ 
                    'biz' => 'baz' 
                ],
                'test' => [ 
                    'happy' => 'sad' 
                ] 
            ]
        ], ['formatOutput' => false]);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><root><unit><foo><biz>baz</biz></foo><test><happy>sad</happy></test></unit></root>', str_replace("\n", '', $response));
    }

}