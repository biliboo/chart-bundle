Formatters
==========

The formatters are working either on a series data, after they are retrieved, one by one or a whole set. It allows you to perform some extra processes.

How to create a formatter?
--------------------------

```php
<?php
// src Acme\ChartBundle\Formatter\SomeFormatter.php

use Biliboo\ChartBundle\Formatter\AbstractFormatter;
use Biliboo\ChartBundle\Serie\SerieInterface;

class SomeFormatter extends AbstractFormatter
{
    public function format(array $data, array $options, SerieInterface $serie)
    {
        // Work on $data

        return $data;
    }

    /**
     * @return integer
     */
    public function getScope()
    {
        return self::SCOPE_ALL;
    }
}
```

We now register the formatter

```xml
<!-- src/Acme/ChartBundle/Resources/config/services.xml -->

<!-- Parameters -->
    <!-- Series -->
    <parameter key="acme_chart.some.custom.class">Acme\ChartBundle\Formatter\SomeFormatter</parameter>

<!-- Services -->
    <!-- Series -->
    <service id="acme_chart.some.custom" class="%acme_chart.some.custom.class%">
        <tag name="chart.formatter" alias="some_formatter" />
    </service>
```

Use a formatter
---------------

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
            ->add('basic_series', [
                'formatters' => [
                    'some_formatter'
                ]
            ])
        ;
    }
}
```

If you need to send options, the way is the following:

```php
<?php
    ->add('basic_series', [
        'formatters' => [
            'some_formatter' => [
                // your options
            ]
        ]
    ])
```

### Registred formatters

Cumulative
----------

The `cumulative` formatter cumulate the second column of the data set.

DateUtc
-------

The `date_utc` formatter convert a timestamp in a JavaScript DateUtc format.

- An option `factor` can be added used for time sliced series. The factor multiply the "sliced" timestamp found in the first column.

MsTimestamp
-----------

The `ms_timestamp` formatter convert a timestamp in an ms timestamp. It multiplies the timestamp by 1000. For databases series, it's better to multiply directly by 1000 the returned timestamp (and add the factor manually if there is such).

- An option `factor` can be added used for time sliced series. The factor multiply the "sliced" timestamp found in the first column.

Translation
-----------

The `translation` formatter translate the first column.

- An option `prefix` can be added to add a prefix to the key.