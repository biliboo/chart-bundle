<?php

namespace Biliboo\ChartBundle\Serie\Type;

use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineSerie;

/**
 * Description of DoctrineQueryBuiderSerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractDoctrineQueryBuiderSerie extends AbstractDoctrineSerie
{
    /**
     * @var array
     */
    protected $options;

    /**
     * {@inheritDoc}
     */
    public function buildSerie($data, array $options)
    {
        $cursor = $this->getQueryBuilder($data, $options)->getQuery()->getArrayResult();
        $data   = [];

        foreach($cursor as $row) {
            $data[] = array_values($row);
        }

        return $data;
    }

    /**
     * @param mixed $data
     * @param array $options
     * @return \Doctrine\ORM\QueryBuilder
     */
    abstract public function getQueryBuilder($data, array $options);
}
