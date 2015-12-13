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
 * Class FormTypeTestCase
 */
abstract class FormTypeTestCase extends \PHPUnit_Framework_TestCase {

    /**
     * Indicates if class setup method was executed
     * @var bool
     */
    private $setup = false;

    /**
     * @var \Symfony\Component\Form\AbstractType
     */
    protected $formType;

    /**
     * @var \Symfony\Component\Form\formBuilderMockInterface
     */
    protected $formBuilderMock;

    /**
     * @var array
     */
    protected $formBuilderMockData;

    /**
     * Prepares the mocks
     */
    public function setup() {
        $this->setup = true;

        $this->formBuilderMockData = array();
        $formBuilderMockData =& $this->formBuilderMockData;
        $this->formBuilderMock = m::mock('Symfony\Component\Form\FormBuilderInterface');
        $this->formBuilderMock->shouldReceive('add')->andReturnUsing(function($child, $type = null, array $options = array()) use (&$formBuilderMockData) {
            $formBuilderMockData["$child"] = [
                'name'=>$child,
                'type'=>$type,
                'options'=>$options,
            ];
        });
        $this->formBuilderMock->shouldReceive('has')->andReturnUsing(function($child) use (&$formBuilderMockData) {
            return isset($formBuilderMockData["$child"]);
        });
    }

    /**
     * @throws \Exception
     */
    private function checkSetup() {
        if(!$this->setup) {
            throw new \Exception("You must call parent::setup() in your test class.");
        }

        if(! $this->formType instanceof \Symfony\Component\Form\AbstractType) {
            throw new \Exception("You must instance formType AbstractType class.");
        }
    }

    public function assertTitle($expectedTitle) {
        $this->checkSetup();
        $this->assertEquals($expectedTitle,$this->formType->getName());
    }


    public function assertBuilderFieldExists($name) {
        $this->checkSetup();
        $this->assertTrue($this->formBuilderMock->has($name),"The builder has not a '$name' element");
    }

    public function assertBuilderFieldType($name,$type) {
        $this->checkSetup();
        if($type == null) {
            $this->assertNull($this->formBuilderMockData[$name]['type']);
        } else {
            $this->assertEquals($type,$this->formBuilderMockData[$name]['type']);
        }
    }
}
