<?php

namespace Biliboo\ChartBundle\Serie;

use Biliboo\ChartBundle\Serie\Type\AbstractSerieInterface;
use Biliboo\ChartBundle\Exception\SerieNotFoundException;

/**
 * Description of SerieResolver
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class SerieResolver
{
    /**
     * @var array
     */
    protected $series;

    /**
     * SerieResolver Constructor
     */
    public function __construct()
    {
        $this->series = [];
    }

    /**
     * @param AbstractSerieInterface $serie
     * @param string $alias
     */
    public function addSerie(AbstractSerieInterface $serie, $alias)
    {
        $this->series[$alias] = $serie;
    }

    /**
     * @param string $name
     * @return AbstractSerieInterface
     * @throws SerieNotFoundException
     */
    public function findByName($name)
    {
        // We check if the serie is registered
        if ( ! array_key_exists($name, $this->series)) {
            throw new SerieNotFoundException(sprintf(
                'The serie with name "%s" is not registered in series ["%s"]',
                $name,
                implode('", "', array_keys($this->series)))
            );
        }

        return $this->series[$name];
    }
}
