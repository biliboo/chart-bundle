<?php

namespace Biliboo\ChartBundle\Lib\Serie;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineSerie;

/**
 * Description of DoctrineSerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class DoctrineSerie extends AbstractDoctrineSerie
{
    /**
     * {@inheritDoc}
     */
    public function buildSerie($data, array $options)
    {
        return call_user_func($options['get_data'], $this->em, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'data'     => null,
            'get_data' => null,
        ]);

        $resolver->setAllowedTypes([
            'get_data' => 'callable',
        ]);
    }
}
