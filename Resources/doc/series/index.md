How series work?
================

The series can have multiple sources like a database, a file or redis... As in a form, you can define default options (OptionResolver component) to format and pass settings to your series. The data sent to the chart are also sent to the series.

Raw series
----------

```php
<?php
// src Acme\ChartBundle\Serie\BasicSerie.php

use Acme\ChartBundle\Serie;
use Biliboo\ChartBundle\Serie\Type\AbstractDoctrineQueryBuiderSerie;

class BasicSerie extends AbstractSerie
{
    public function buildSerie($data, array $options)
    {
        return [
            [123932, 3],
            [134343, 7],
            [179232, 2],
        ];
    }
}
```

Provide a series as a service
-----------------------------

```xml
<!-- src/Acme/ChartBundle/Resources/config/services.xml -->

<!-- Parameters -->
    <!-- Series -->
    <parameter key="acme_chart.series.basic.class">Acme\ChartBundle\Serie\BasicSerie</parameter>

<!-- Services -->
    <!-- Series -->
    <service id="acme_chart.series.basic" class="%acme_chart.series.basic.class%">
        <tag name="chart.series" alias="basic_series" />
    </service>
```

You can now use the serie like the following:

```php
<?php
// src Acme\ChartBundle\Chart\BasicChart.php

use Acme\ChartBundle\Chart;
use Biliboo\ChartBundle\Lib\Chart\Highchart\Highchart;
use Biliboo\ChartBundle\Serie\SerieBuilderInterface;

class BasicChart extends Highchart
{
    public function buildSeries(SerieBuilderInterface $builder, array $options)
    {
        $builder
            ->add('basic_series')
        ;
    }
}
```