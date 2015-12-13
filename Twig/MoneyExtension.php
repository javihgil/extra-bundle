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
 * Class MoneyExtension
 */
class MoneyExtension extends \Twig_Extension
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
            'money' => new \Twig_SimpleFilter('money', [$this, 'money']),
        );
    }

    /**
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function money($amount, $currency = 'EUR')
    {
        $number = number_format($amount, 2, ',', '.');

        return $this->translator->trans("currency_$currency", ['%amount%' => $number], 'money');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'money_extension';
    }
}
