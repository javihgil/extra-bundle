<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Tests\Unitary\Testing;

use Jhg\ExtraBundle\Testing\Unitary\MockeryUtils;

/**
 * Class MockeryUtilsTest
 */
class MockeryUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testMockKernel()
    {
        $return = MockeryUtils::mockKernel();
        $this->assertInstanceOf('\Mockery\MockInterface', $return, 'Expected MockInterface object');
    }

    public function testMockContainer()
    {
        $return = MockeryUtils::mockContainer();
        $this->assertInstanceOf('\Mockery\MockInterface', $return, 'Expected MockInterface object');
    }

    public function testMockContainerInterface()
    {
        $return = MockeryUtils::mockContainerInterface();
        $this->assertInstanceOf('\Mockery\MockInterface', $return, 'Expected MockInterface object');
    }

    public function testMockDoctrineEntityManager()
    {
        $return = MockeryUtils::mockDoctrineEntityManager();
        $this->assertInstanceOf('\Mockery\MockInterface', $return, 'Expected MockInterface object');
    }
}
