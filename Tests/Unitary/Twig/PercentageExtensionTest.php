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

use Jhg\ExtraBundle\Twig\PercentageExtension;
use \Mockery as m;

/**
 * Class PercentageExtensionTest
 */
class PercentageExtensionTest extends \PHPUnit_Framework_TestCase
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
        $extension = new PercentageExtension($this->translatorMock);
        $this->assertEquals('percentage_extension', $extension->getName());
    }

    public function testGetGlobals()
    {
        $extension = new PercentageExtension($this->translatorMock);

        $filters = $extension->getFilters();

        $this->assertEquals(1, sizeof($filters), "getFilters must return 1 element");

        $this->assertArrayHasKey('percentage', $filters, "getFilters must return percentage");
        $this->assertTrue($filters['percentage'] instanceof \Twig_SimpleFilter);
    }

    public function testPercentage()
    {
        $this->translatorMock->shouldReceive('trans')->andReturnUsing(
            function ($currency, $params) {
                return "{$currency}_{$params['%amount%']}";
            }
        );
        $extension = new PercentageExtension($this->translatorMock);

        $this->assertEquals('100,00 %', $extension->percentage(100));
        $this->assertEquals('1,00 %', $extension->percentage(1));
    }
}
