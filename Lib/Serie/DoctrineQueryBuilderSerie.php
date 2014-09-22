<?php

namespace Biliboo\ChartBundle\Lib\Serie;

use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineQueryBuiderSerie;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Exception\LogicException;
use Doctrine\ORM\QueryBuilder;

/**
 * Description of DoctrineQueryBuilderSerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class DoctrineQueryBuilderSerie extends AbstractDoctrineQueryBuiderSerie
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'qb' => null
        ]);

        $resolver->setAllowedTypes([
            'qb' => [
                'Doctrine\ORM\QueryBuilder',
                'callable',
            ]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getQueryBuilder($data, array $options)
    {
        $qb = $options['qb'];

        if (is_callable($qb)) {
            $qb = call_user_func($qb, $this->em, $data);

            if ( ! $qb instanceof QueryBuilder) {
                throw new LogicException(sprintf('The serie\'s "qb" option should return a "Doctrine\ORM\QueryBuilder", "%s" given.', is_object($qb) ? get_class($b) : gettype($qb)));
            }
        }

        return $qb;
    }
}
