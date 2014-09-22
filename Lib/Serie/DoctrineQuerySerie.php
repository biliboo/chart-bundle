<?php

namespace Biliboo\ChartBundle\Lib\Serie;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineQuerySerie;
use Biliboo\ChartBundle\Exception\LogicException;
use Doctrine\ORM\Query;

/**
 * Description of AbstractDoctrineQuerySerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class DoctrineQuerySerie extends AbstractDoctrineQuerySerie
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'query' => null
        ]);

        $resolver->setAllowedTypes([
            'query' => [
                'Doctrine\ORM\Query',
                'callable',
            ]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuery($data, array $options)
    {
        $q = $options['query'];

        if (is_callable($q)) {
            $q = call_user_func($q, $this->em, $data);

            if (is_string($q)) {
                $q = $this->em->createQuery($q);
            }

            if ( ! $q instanceof Query) {
                throw new LogicException(sprintf('The serie\'s "q" option should return a "Doctrine\ORM\Query", "%s" given.', is_object($q) ? get_class($q) : gettype($q)));
            }
        }

        return $q;
    }
}
