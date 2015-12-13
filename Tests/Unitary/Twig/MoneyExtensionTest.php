<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Tests\Unitary\Twig;

use Jhg\ExtraBundle\Twig\MoneyExtension;
use \Mockery as m;

/**
 * Class MoneyExtensionTest
 */
class MoneyExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    protected $translatorMock;

    /**
     *
     */
    public function setup()
    {
        $this->translatorMock = m::mock('Symfony\Component\Translation\TranslatorInterface');
    }


    public function testGetName()
    {
        $extension = new MoneyExtension($this->translatorMock);
        $this->assertEquals('money_extension', $extension->getName());
    }

    public function testGetGlobals()
    {
        $extension = new MoneyExtension($this->translatorMock);

        $filters = $extension->getFilters();

        $this->assertEquals(1, sizeof($filters), "getFilters must return 1 element");

        $this->assertArrayHasKey('money', $filters, "getFilters must return money");
        $this->assertTrue($filters['money'] instanceof \Twig_SimpleFilter);
    }

    public function testMoney()
    {
        $this->translatorMock->shouldReceive('trans')->andReturnUsing(
            function ($currency, $params) {
                return "{$currency}_{$params['%amount%']}";
            }
        );
        $extension = new MoneyExtension($this->translatorMock);

        $this->assertEquals('currency_EUR_100,00', $extension->money(100,'EUR'));
        $this->assertEquals('currency_USD_1,00', $extension->money(1,'USD'));
    }
}
 