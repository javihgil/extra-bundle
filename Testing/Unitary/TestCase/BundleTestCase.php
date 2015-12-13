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
 * Class BundleTestCase
 */
abstract class BundleTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Indicates if class setup method was executed
     * @var bool
     */
    private $setup = false;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $containerBuilderMock;

    /**
     * @var \Symfony\Component\HttpKernel\Bundle\Bundle
     */
    protected $bundle;

    /**
     * Prepares the mocks
     */
    public function setup()
    {
        $this->setup = true;

        $this->containerBuilderMock = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
    }

    /**
     * @throws \Exception
     */
    private function checkSetup()
    {
        if (!$this->setup) {
            throw new \Exception("You must call parent::setup() in your test class.");
        }

        if (!$this->bundle) {
            throw new \Exception("You must init bundle object in setup.");
        }
    }

    /**
     * @throws \Exception
     */
    public function testBuild()
    {
        $this->checkSetup();
        $this->bundle->build($this->containerBuilderMock);
    }

    /**
     * Overwrite if bundle has a parent
     * @throws \Exception
     */
    public function testGetParent()
    {
        $this->checkSetup();
        $parent = $this->bundle->getParent();
        $this->assertNull($parent);
    }
}