<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ReturnUrlHelper
 */
class ReturnUrlHelper
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function current()
    {
        return $this->container->get('request')->getRequestUri();
    }

    /**
     * @return string
     */
    public function current64()
    {
        return base64_encode($this->current());
    }

    /**
     * @param string $default
     * @return string
     */
    public function last($default = '/')
    {
        if ($ru = $this->container->get('request')->get('ru')) {
            return base64_decode($ru);
        } else {
            return $default;
        }
    }

    /**
     * @param string $default
     * @return string
     */
    public function last64($default = '')
    {
        if ($ru = $this->container->get('request')->get('ru')) {
            return $ru;
        } else {
            return base64_encode($default);
        }
    }
}