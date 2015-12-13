<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Tests\Unitary;

use Jhg\ExtraBundle\JhgExtraBundle;
use Jhg\ExtraBundle\Testing\Unitary\TestCase\BundleTestCase;

/**
 * Class JhgExtraBundleTest
 */
class JhgExtraBundleTest extends BundleTestCase
{

    /**
     * Prepares the mocks
     */
    public function setup()
    {
        parent::setup();
        $this->bundle = new JhgExtraBundle();
    }
}