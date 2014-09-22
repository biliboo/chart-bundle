<?php

namespace Biliboo\ChartBundle\Lib\Chart\Highchart;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Chart\Type\AbstractChart;

/**
 * Description of Highchart
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class Highchart extends AbstractChart
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'title' => [
                'text'  => null
            ],
            'renderer'  => 'highchart',
            'credits' => [
                'enabled' => false
            ]
        ]);
    }
}
