<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ExtraController
 */
abstract class ExtraController extends Controller
{
    /**
     * @param string      $persistentObjectName
     * @param string|null $persistentManagerName
     *
     * @return EntityRepository
     */
    protected function getRepository($persistentObjectName, $persistentManagerName = null)
    {
        return $this->getDoctrine()->getRepository($persistentObjectName, $persistentManagerName);
    }

    /**
     * @param string      $type
     * @param string      $message
     * @param array       $parameters
     * @param string|null $domain
     * @param string|null $locale
     */
    protected function addFlashTrans($type, $message, array $parameters = [], $domain = null, $locale = null)
    {
        $this->addFlash($type, $this->trans($message, $parameters, $domain, $locale));
    }

    /**
     * @param string      $message
     * @param array       $parameters
     * @param string|null $domain
     * @param string|null $locale
     *
     * @return string
     */
    protected function trans($message, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->get('translator')->trans($message, $parameters, $domain, $locale);
    }

    /**
     * @param string      $message
     * @param int         $number
     * @param array       $parameters
     * @param string|null $domain
     * @param string|null $locale
     *
     * @return string
     */
    protected function transChoice($message, $number, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->get('translator')->transChoice($message, $number, $parameters, $domain, $locale);
    }
}