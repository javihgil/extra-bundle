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
 * Class ExtraTestCase
 */
abstract class ExtraTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @param object $object
     * @param string $field
     * @param mixed $value
     * @param mixed $expetedValue
     */
    protected function assertSetterGetter($object, $field, $value, $expetedValue)
    {
        $setterMethod = 'set' . ucfirst($field);
        $getterMethod = 'get' . ucfirst($field);

        $object->$setterMethod($value);
        $this->assertEquals($expetedValue, $object->$getterMethod());
    }

}