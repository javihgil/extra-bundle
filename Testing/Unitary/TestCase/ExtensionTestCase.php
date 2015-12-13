<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Testing\Unitary\TestCase;

use \Mockery as m;

/**
 * Class ExtensionTestCase
 */
abstract class ExtensionTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    protected $containerParameters;

    /**
     * @var array
     */
    protected $containerDefinitions;

    /**
     * @var array
     */
    protected $containerAliases;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $containerBuilderMock;

    /**
     * Indicates if class setup method was executed
     * @var bool
     */
    private $setup = false;

    /**
     * Prepares the mocks
     */
    public function setup()
    {
        $this->setup = true;

        $this->containerParameters = array();
        $containerParameters =& $this->containerParameters;

        $this->containerDefinitions = array();
        $containerDefinitions =& $this->containerDefinitions;

        $this->containerAliases = array();
        $containerAliases =& $this->containerAliases;

        $this->containerBuilderMock = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $this->containerBuilderMock->shouldReceive('addResource')->andReturn();
        $this->containerBuilderMock->shouldReceive('setParameter')->andReturnUsing(
            function ($key, $value) use (&$containerParameters) {
                $containerParameters[$key] = $value;
            }
        );
        $this->containerBuilderMock->shouldReceive('setDefinition')->andReturnUsing(
            function ($id, $definition) use (&$containerDefinitions) {
                $containerDefinitions[$id] = $definition;
            }
        );
        $this->containerBuilderMock->shouldReceive('setAlias')->andReturnUsing(
            function ($alias, $id) use (&$containerAliases) {
                $containerAliases[$alias] = $id;
            }
        );
    }

    /**
     * @throws \Exception
     */
    private function checkSetup()
    {
        if (!$this->setup) {
            throw new \Exception("You must call parent::setup() in your test class.");
        }
    }

    /**
     * @param string $parameter
     */
    protected function assertContainerParameterIsset($parameter)
    {
        $this->checkSetup();
        $this->assertArrayHasKey(
            $parameter,
            $this->containerParameters,
            "Parameter $parameter was not set in container parameters."
        );
    }

    /**
     * @param string $parameter
     * @param mixed $value
     */
    protected function assertContainerParameterValue($parameter, $value)
    {
        $this->checkSetup();
        $this->assertEquals(
            $value,
            $this->containerParameters[$parameter],
            "Parameter $parameter value is '{$this->containerParameters[$parameter]}', required value is '$value'."
        );
    }

    /**
     * @param string $serviceId
     */
    protected function assertContainerServiceDefined($serviceId)
    {
        $this->checkSetup();
        $this->assertArrayHasKey(
            $serviceId,
            $this->containerDefinitions,
            "Service $serviceId is not defined in container."
        );
    }

    protected function assertContainerAliasDefined($alias, $serviceId)
    {
        $this->checkSetup();
        $this->assertArrayHasKey($alias, $this->containerAliases, "Alias $alias is not defined in container.");
        $this->assertEquals($serviceId, $this->containerAliases[$alias]);
    }
}