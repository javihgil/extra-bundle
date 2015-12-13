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

use Jhg\ExtraBundle\Helper\ReturnUrlHelper;
use Jhg\ExtraBundle\Twig\ReturnUrlExtension;
use \Mockery as m;

/**
 * Class ReturnUrlExtensionTest
 */
class ReturnUrlExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ReturnUrlHelper
     */
    protected $returnUrlHelperMock;

    public function setup()
    {
        $this->returnUrlHelperMock = m::mock('Jhg\ExtraBundle\Helper\ReturnUrlHelper');
    }

    public function testGetName()
    {
        $extension = new ReturnUrlExtension($this->returnUrlHelperMock);
        $this->assertEquals('return_url_extension', $extension->getName());
    }

    public function testGetGlobals()
    {
        $this->returnUrlHelperMock->shouldReceive('current')->andReturn('current_ru');
        $this->returnUrlHelperMock->shouldReceive('last')->andReturn('last_ru');
        $this->returnUrlHelperMock->shouldReceive('current64')->andReturn('current_ru64');
        $this->returnUrlHelperMock->shouldReceive('last64')->andReturn('last_ru64');
        $extension = new ReturnUrlExtension($this->returnUrlHelperMock);

        $globals = $extension->getGlobals();

        $this->assertEquals(4, sizeof($globals), "getGlobals must return 4 elements");

        $this->assertArrayHasKey('current_ru', $globals, "getGlobals must return current_ru");
        $this->assertEquals('current_ru', $globals['current_ru']);

        $this->assertArrayHasKey('last_ru', $globals, "getGlobals must return last_ru");
        $this->assertEquals('last_ru', $globals['last_ru']);

        $this->assertArrayHasKey('current_ru64', $globals, "getGlobals must return current_ru64");
        $this->assertEquals('current_ru64', $globals['current_ru64']);

        $this->assertArrayHasKey('last_ru64', $globals, "getGlobals must return last_ru64");
        $this->assertEquals('last_ru64', $globals['last_ru64']);
    }

}
 