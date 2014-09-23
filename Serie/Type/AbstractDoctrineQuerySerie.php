<?php

namespace Biliboo\ChartBundle\Serie\Type;

use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineSerie;

/**
 * Description of DoctrineQuerySerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractDoctrineQuerySerie extends AbstractDoctrineSerie
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
        $cursor = $this->getQuery($data, $options)->getArrayResult();
        $data   = [];

        foreach($cursor as $row) {
            $data[] = $this->parseValues($row);
        }

        return $data;
    }

    /**
     * @param mixed $data
     * @param array $options
     * @return \Doctrine\ORM\Query
     */
    abstract public function getQuery($data, array $options);
}
