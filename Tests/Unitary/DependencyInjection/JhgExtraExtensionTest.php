<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Tests\Unitary\DependencyInjection;

use Jhg\ExtraBundle\DependencyInjection\JhgExtraExtension;
use Jhg\ExtraBundle\Testing\Unitary\TestCase\ExtensionTestCase;

/**
 * Class JhgExtraExtensionTest
 */
class JhgExtraExtensionTest extends ExtensionTestCase
{

    /**
     * Prepares the mocks
     */
    public function setup()
    {
        parent::setup();
    }

    public function testLoad()
    {
        $config = array();
        $extension = new JhgExtraExtension();
        $extension->load($config, $this->containerBuilderMock);

        // test default parameters

        // test service
        $this->assertContainerServiceDefined('jhg.extra.return_url_helper');
        $this->assertContainerAliasDefined('ru', 'jhg.extra.return_url_helper');
        $this->assertContainerServiceDefined('jhg.extra.twig.return_url_extension');
        $this->assertContainerServiceDefined('jhg.extra.twig.lipsum_extension');
    }
}
