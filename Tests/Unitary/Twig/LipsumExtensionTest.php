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

use Jhg\ExtraBundle\Twig\LipsumExtension;
use \Mockery as m;

/**
 * Class LipsumExtensionTest
 */
class LipsumExtensionTest extends \PHPUnit_Framework_TestCase
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
        $extension = new LipsumExtension($this->translatorMock);
        $this->assertEquals('lipsum_extension', $extension->getName());
    }

    public function testGetFunctions()
    {
        $extension = new LipsumExtension($this->translatorMock);

        $filters = $extension->getFunctions();

        $this->assertEquals(1, sizeof($filters), "getFunctions must return 1 element");

        $this->assertArrayHasKey('lipsum', $filters, "getFunctions must return percentage");
        $this->assertTrue($filters['lipsum'] instanceof \Twig_SimpleFunction);
    }

    public function lipsumProvider()
    {
        return [
            [2],
            [100],
            [200],
            [2000],
            [10000],
        ];
    }

    /**
     * @param $chars
     * @dataProvider lipsumProvider
     */
    public function testLipsum($chars)
    {
        $extension = new LipsumExtension($this->translatorMock);

        $returned = $extension->lipsum($chars);

        $this->assertEquals($chars, strlen($returned));
    }
}
 