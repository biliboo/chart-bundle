Basic usage
===========

You will see that the ChartBundle philosophie is deeply inspired from the Symfony Form component.

## Series

As a chart is composed of at least one serie, you first need to create the serie(s). You can have multiple type of serie. Here we will create a Doctrine based serie.

```php
<?php
// src Acme\ChartBundle\Serie\RegistrationSerie.php

use Acme\ChartBundle\Serie;
use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineQueryBuiderSerie;

class RegistrationSerie extends AbstractDoctrineQueryBuiderSerie
{
    public function getQueryBuilder($data, array $options)
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select(u.date, 'COUNT(u)')
            ->from('MyBundle:User', 'u')
            ->orderBy('u.date', 'ASC')
            ->groupBy('u.date')
        ;

        return $qb;
    }
}
```

In the above example, we assume `date` is a timestamp of a month.

Most of the time, a series has to return an array of couple "date" - "numeric" in order to be displayed on a graph. Depending of which library you're using and which kind of chart you want to display, you need to follow the recommended format. [More about series...](series/index.md)

## Charts

A chart contains the series and define the required chart library.

```php
<?php
// src Acme\ChartBundle\Chart\RegistrationChart.php

use Acme\ChartBundle\Chart;
use Acme\ChartBundle\Serie\RegistrationSerie;
use Biliboo\ChartBundle\Lib\Chart\Highchart\Highchart;
use Biliboo\ChartBundle\Serie\SerieBuilderInterface;

class RegistrationChart extends Highchart
{
    public function buildSeries(SerieBuilderInterface $builder, array $options)
    {
        $builder
            ->add(new RegistrationSerie())
        ;
    }
}
```

## Controller

You can render your chart from the controller or using `biliboo_chart.chart.factory`. Note that the data of the chart will be fetched only when required.

```php
<?php
// src Acme\ChartBundle\Controller\MyController.php

use Acme\ChartBundle\Chart\RegistrationChart;
use Acme\ChartBundle\Controller;
use Biliboo\ChartBundle\Controller\ChartControllerTrait;

class MyController extends Controller
{
    use ChartControllerTrait;

    public function indexAction()
    {
        return $this->render('AcmeChartBundle:Registration:index.html.twig', [
            'chart' => $this->createChart(new RegistrationChart())
        ]);
    }
}
```

Use the trait in order to use the `createChart` function.

## Template

In the `AcmeChartBundle:Registration:index.html.twig` file, render the chart like the following:

```twig
{{ chart(chart) }}
```

## Done

Go back to [the index](index.md).
