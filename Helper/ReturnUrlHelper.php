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
use Symfony\Component\HttpFoundation\Request;

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
     * This method provides compatibility with 2.x and 3.x Symfony versions
     *
     * @return null|Request
     */
    private function getRequest()
    {
        $request = null;

        if ($this->container->has('request_stack')) {
            $request = $this->container->get('request_stack')->getCurrentRequest();
        } elseif (method_exists($this->container, 'isScopeActive') && $this->container->isScopeActive('request')) {
            // BC for SF <2.4
            $request = $this->container->get('request');
        }

        return $request;
    }

    /**
     * @return string
     */
    public function current()
    {
        return $this->getRequest() ? $this->getRequest()->getRequestUri() : '';
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
        if ($this->getRequest() && $ru = $this->getRequest()->get('ru')) {
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
        if ($this->getRequest() && $ru = $this->getRequest()->get('ru')) {
            return $ru;
        } else {
            return base64_encode($default);
        }
    }
}