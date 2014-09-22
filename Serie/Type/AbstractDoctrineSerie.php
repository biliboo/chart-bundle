<?php

namespace Biliboo\ChartBundle\Serie\Type;

use Doctrine\ORM\EntityManager;

/**
 * Description of AbstractDoctrineSerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractDoctrineSerie extends AbstractSerie
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     * @param array $options
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}
