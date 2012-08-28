<?php

namespace Money\MoneyBundle\Tests\Form\Type;

use Money\Currency;
use Money\Money;
use Money\MoneyBundle\Form\Type\CurrencyType;
use Symfony\Component\Form\Tests\FormIntegrationTestCase;

/**
 * Integration test for the CurrencyType that integrates the Currency object
 * with the Symfony form component.
 *
 * @author Marijn Huizendveld <marijn@pink-tie.com>
 * @copyright Pink Tie (2012)
 */
final class CurrencyTypeTest extends FormIntegrationTestCase
{
    /**
     * @dataProvider provideValidCurrencySymbols
     */
    public function testBindValid($symbol)
    {
        $form = $this->factory->create(new CurrencyType(), null, array());

        $form->bind($symbol);
        
        $this->assertEquals(new Currency($symbol), $form->getData());
    }

    /**
     * @dataProvider provideInvalidCurrencySymbols
     */    
    public function testBindInValid($symbol)
    {
        $form = $this->factory->create(new CurrencyType(), null, array());
    }

    public function provideValidCurrencySymbols()
    {
        return array(
            array('EUR'),
            array('USD'),
            array('GBP'),
            array('JPY')
        );
    }
    
    /**
     * These currency symbols are considered invalid, because they are not
     * implemented by the library.
     */
    public function provideInvalidCurrencySymbols()
    {
        return array(
            array('MGH'),
        );
    }
}
