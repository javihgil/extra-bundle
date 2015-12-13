<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Testing\Unitary;

use \Mockery as m;

/**
 * Class MockeryUtils
 */
class MockeryUtils
{
    /**
     * @return m\MockInterface
     */
    public static function mockKernel()
    {
        $kernelMock = m::mock('Symfony\Component\HttpKernel\Kernel');

        return $kernelMock;
    }

    /**
     * @return m\MockInterface
     */
    public static function mockContainer($parameters = null)
    {
        $containerMock = m::mock('\Symfony\Component\DependencyInjection\Container');

        if ($parameters) {
            $containerMock->shouldReceive('getParameter')->andReturnUsing(
                function ($parameter) use ($parameters) {
                    return $parameters[$parameter];
                }
            );
        }

        return $containerMock;
    }

    /**
     * @return m\MockInterface
     */
    public static function mockContainerInterface()
    {
        $containerMock = m::mock('\Symfony\Component\DependencyInjection\ContainerInterface');

        return $containerMock;
    }

    /**
     * @return m\MockInterface|\Doctrine\ORM\EntityManagerInterface
     */
    public static function mockDoctrineEntityManager()
    {
        $entityManagerMock = m::mock('\Doctrine\ORM\EntityManagerInterface');

        return $entityManagerMock;
    }

}
