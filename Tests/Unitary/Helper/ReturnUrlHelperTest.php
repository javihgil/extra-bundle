<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Tests\Unitary\Helper;

use Jhg\ExtraBundle\Helper\ReturnUrlHelper;
use \Mockery as m;
use Jhg\ExtraBundle\Testing\Unitary\MockeryUtils as mu;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReturnUrlHelperTest
 */
class ReturnUrlHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var m\MockInterface
     */
    protected $containerMock;

    public function setup()
    {
        $this->containerMock = mu::mockContainerInterface();
    }


    public function requestsProvider()
    {
        return array(
            array(
                new Request(array('ru' => 'L3Rlc3Rz'), array(), array(), array(), array(), array('REQUEST_URI' => '/')),
                '/',
                'Lw==',
                '/tests',
                'L3Rlc3Rz'
            ),
            array(
                new Request(array(), array(), array(), array(), array(), array('REQUEST_URI' => '/tests')),
                '/tests',
                'L3Rlc3Rz',
                '/',
                ''
            ),
        );
    }


    /**
     * @dataProvider requestsProvider
     */
    public function testCurrent($request, $expected, $_2, $_3, $_4)
    {
        $requestStackMock = m::mock('Symfony\Component\HttpFoundation\RequestStack');
        $requestStackMock->shouldReceive('getCurrentRequest')->andReturn($request);

        $this->containerMock->shouldReceive('has')->with('request_stack')->andReturn(true);
        $this->containerMock->shouldReceive('get')->with('request_stack')->andReturn($requestStackMock);
        $returnUrlHelper = new ReturnUrlHelper($this->containerMock);
        $value = $returnUrlHelper->current();
        $this->assertEquals($expected, $value);
    }


    /**
     * @dataProvider requestsProvider
     */
    public function testCurrent64($request, $_1, $expected, $_3, $_4)
    {
        $requestStackMock = m::mock('Symfony\Component\HttpFoundation\RequestStack');
        $requestStackMock->shouldReceive('getCurrentRequest')->andReturn($request);

        $this->containerMock->shouldReceive('has')->with('request_stack')->andReturn(true);
        $this->containerMock->shouldReceive('get')->with('request_stack')->andReturn($requestStackMock);
        $returnUrlHelper = new ReturnUrlHelper($this->containerMock);
        $value = $returnUrlHelper->current64();
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider requestsProvider
     */
    public function testLast($request, $_1, $_2, $expected, $_4)
    {
        $requestStackMock = m::mock('Symfony\Component\HttpFoundation\RequestStack');
        $requestStackMock->shouldReceive('getCurrentRequest')->andReturn($request);

        $this->containerMock->shouldReceive('has')->with('request_stack')->andReturn(true);
        $this->containerMock->shouldReceive('get')->with('request_stack')->andReturn($requestStackMock);
        $returnUrlHelper = new ReturnUrlHelper($this->containerMock);
        $value = $returnUrlHelper->last();
        $this->assertEquals($expected, $value);
    }


    /**
     * @dataProvider requestsProvider
     */
    public function testLast64($request, $_1, $_2, $_3, $expected)
    {
        $requestStackMock = m::mock('Symfony\Component\HttpFoundation\RequestStack');
        $requestStackMock->shouldReceive('getCurrentRequest')->andReturn($request);

        $this->containerMock->shouldReceive('has')->with('request_stack')->andReturn(true);
        $this->containerMock->shouldReceive('get')->with('request_stack')->andReturn($requestStackMock);
        $returnUrlHelper = new ReturnUrlHelper($this->containerMock);
        $value = $returnUrlHelper->last64();
        $this->assertEquals($expected, $value);
    }


} 