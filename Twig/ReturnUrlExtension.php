<?php

/*
 * This file is part of the extra-bundle package.
 *
 * (c) Javi H. Gil <https://github.com/javihgil>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jhg\ExtraBundle\Twig;

use Jhg\ExtraBundle\Helper\ReturnUrlHelper;

/**
 * Class ReturnUrlExtension
 */
class ReturnUrlExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

    /**
     * @var ReturnUrlHelper
     */
    protected $returnUrlHelper;

    /**
     * @param ReturnUrlHelper $returnUrlHelper
     */
    public function __construct(ReturnUrlHelper $returnUrlHelper)
    {
        $this->returnUrlHelper = $returnUrlHelper;
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'current_ru' => $this->returnUrlHelper->current(),
            'last_ru' => $this->returnUrlHelper->last(),
            'current_ru64' => $this->returnUrlHelper->current64(),
            'last_ru64' => $this->returnUrlHelper->last64(),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'return_url_extension';
    }
}