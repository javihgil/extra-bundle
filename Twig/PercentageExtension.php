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

use Jhg\ExtraBundle\Helper\MoneyHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class PercentageExtension
 */
class PercentageExtension extends \Twig_Extension
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'percentage' => new \Twig_Filter_Function('percentage', [$this, 'percentage']),
        );
    }

    /**
     * @param float   $amount
     * @param integer $decimals
     * @return string
     */
    public function percentage($amount, $decimals = 2)
    {
        $number = number_format($amount, $decimals, ',', '.');

        return "$number %";
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'percentage_extension';
    }
}
