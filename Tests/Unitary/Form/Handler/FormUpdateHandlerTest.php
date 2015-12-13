<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unitary\Form\Handler;

use \Mockery as m;
use Jhg\ExtraBundle\Testing\Unitary\MockeryUtils as mu;
use Unitary\Form\Handler\helpers\TestFormUpdateHandler;

include 'helpers/TestFormUpdateHandler.php';

/**
 * Class FormUpdateHandlerTest
 */
class FormUpdateHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var m\MockInterface|\Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManagerMock;

    /**
     * @var m\MockInterface|\Symfony\Component\Form\Form
     */
    protected $formMock;

    /**
     * @var m\MockInterface|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * Configures the tests
     */
    public function setup()
    {
        $this->entityManagerMock = mu::mockDoctrineEntityManager();
        $this->formMock = m::mock('Symfony\Component\Form\Form');
        $this->requestMock = m::mock('Symfony\Component\HttpFoundation\Request');
    }

    /**
     * Test behaviour when request->isMethod(POST) returns false
     */
    public function testProcessNotPost()
    {
        $handler = new TestFormUpdateHandler($this->entityManagerMock);

        // mock method for test not POST request
        $this->requestMock->shouldReceive('isMethod')->andReturn(false);

        $this->assertFalse(
            $handler->process($this->formMock, $this->requestMock),
            'Process must return false for non POST requests'
        );
    }

    public function testProcessNotValid()
    {
        $handler = new TestFormUpdateHandler($this->entityManagerMock);

        $this->requestMock->shouldReceive('isMethod')->andReturn(true);
        $this->formMock->shouldReceive('submit');

        // mock method for test non valid form data
        $this->formMock->shouldReceive('isValid')->andReturn(false);

        $this->assertFalse(
            $handler->process($this->formMock, $this->requestMock),
            'Process must return false for not valid form data'
        );
    }

    public function testProcessValid()
    {
        $handler = new TestFormUpdateHandler($this->entityManagerMock);

        $this->requestMock->shouldReceive('isMethod')->andReturn(true);
        $this->formMock->shouldReceive('submit');
        $this->formMock->shouldReceive('isValid')->andReturn(true);
        $this->formMock->shouldReceive('getData');
        $this->entityManagerMock->shouldReceive('persist');
        $this->entityManagerMock->shouldReceive('flush');

        $this->assertTrue(
            $handler->process($this->formMock, $this->requestMock),
            'Process must return true for valid form data'
        );
    }
}
