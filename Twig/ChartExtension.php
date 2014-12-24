<?php

namespace Biliboo\ChartBundle\Twig;

use Biliboo\ChartBundle\Chart\ChartView;
use Biliboo\ChartBundle\Util\Javascript;

/**
 * Description of ChartExtension
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class ChartExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('chart', array($this, 'chart'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('is_type', array($this, 'isTypeOf')),
            new \Twig_SimpleFunction('decode_serie_data', array($this, 'decodeSerieData')),
        );
    }

    /**
     * @param ChartView $view
     * @param array $options
     * @return string
     */
    public function chart(ChartView $view, array $options = [])
    {
        // We get the chart
        $chart         = $view->getChart();
        $abstractChart = $chart->getWrappedChart();

        // We compute the view
        $options = array_merge($view->vars['options'], $options);
        $abstractChart->buildView($view, $chart, $options);
        $view->vars['options'] = $options;

        // We compile the attributes
        $attr = [];
        foreach($options['attr'] as $key => $value) {
            $attr[] = sprintf('%s="%s"', $key, $value);
        }
        $view->vars['options']['attr'] = implode(' ', $attr);

        return $view->getRenderer()->render($view);
    }

    /**
     * @param type $value
     * @return type
     */
    public function isTypeOf($value, $type)
    {
        if ('numeric' === $type) {
            return is_numeric($value);
        } elseif ('contains_array' === $type) {
            return count($type) > 0 && is_numeric(array_keys($value)[0]);
        } else {
            return (is_object($value) ? get_class($value) === $type : gettype($value) === $type);
        }
    }

    /**
     * @param array $data
     */
    public function decodeSerieData($data)
    {
        return Javascript::parse(json_encode($data));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biliboo_chart_chart_extension';
    }
}