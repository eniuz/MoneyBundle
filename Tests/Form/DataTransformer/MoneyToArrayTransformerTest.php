<?php
/**
 * This file is part of the Money library
 *
 * Copyright (c) 2011 Mathias Verraes
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money\MoneyBundle\Tests\Form\DataTransformer;

use PHPUnit_Framework_TestCase;
use Money\Money;
use Money\Currency;
use Money\MoneyBundle\Form\DataTransformer\MoneyToArrayTransformer;

/**
 * Test for the datatransformer that converts between Money instances and
 * arrays.
 *
 * @author Marijn Huizendveld <marijn@pink-tie.com>
 * @copyright Mathias Verraes (2011)
 */
final class MoneyToArrayTransformerTest extends PHPUnit_Framework_TestCase
{
    private $transformer;
    
    public function setUp()
    {
        $this->transformer = new MoneyToArrayTransformer();
    }

    /**
     * @dataProvider provideValidUnitsAndSymbols
     */
    public function testTransform($units, $currencySymbol)
    {
        $currency = new Currency($currencySymbol);

        $this->assertEquals(array('units' => $units, 'currency' => $currency), $this->transformer->transform(new Money($units, $currency)));
    }

    /**
     * @dataProvider provideValidUnitsAndSymbols
     */
    public function testReverseTransform($units, $currencySymbol)
    {
        $currency = new Currency($currencySymbol);

        $this->assertEquals(new Money($units, $currency), $this->transformer->reverseTransform(array('units' => $units, 'currency' => $currency)));
    }

    public function testTransformNullToNull()
    {
        $this->assertNull($this->transformer->transform(null));
    }
    
    /**
     * @expectedException Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function testTransformThrowsUnexpectedTypeExceptionForUnexpectedValueType()
    {
        $this->transformer->transform($this);
    }
    
    public function testReverseTransformNullToNull()
    {
        $this->assertNull($this->transformer->reverseTransform(null));
    }
    
    /**
     * @expectedException Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function testReverseTransformThrowsUnexpectedTypeExceptionForUnexpectedValueType()
    {
        $this->transformer->reverseTransform('error');
    }
    
    public function provideValidUnitsAndSymbols()
    {
        return array(
            array(0, "EUR")
        );
    }
}
