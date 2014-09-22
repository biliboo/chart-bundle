## Renderers

The chart renderers are converting a standard chart into the given library. To do so,
the you can use twig engine to generate the JavaScript, HTML or other...

Add a new chart library
-----------------------

### Renderer

Libraries often provide several type of chart, you will need to create a chart for each of those types extending `AbstractChart`.
You then need a renderer extending `AbstractRenderer`, you can get some inspiration from `HighchartRenderer`. This class will handle the different Chart class you will provide and their rendering logic.

### Twig

When you need to generate some JavaScript / HTML, you can use twig and some helpers provided by this bundle. You can have a look at Highchart library.

### Register

```xml
<!-- src/Acme/ChartBundle/Resources/config/services.xml -->

<!-- Parameters -->
    <!-- Series -->
    <parameter key="acme_chart.renderer.super_chart.class">Acme\ChartBundle\Renderer\SuperChart</parameter>

<!-- Services -->
    <!-- Series -->
    <service id="acme_chart.renderer.super_chart" class="%acme_chart.renderer.super_chart.class%">
        <tag name="chart.renderer" alias="super_chart" />
    </service>
```

### Add custom formatters if needed.

If your chart library require some specific transformation, you can add the necessary formatter. Keep in mind that it's better to keep Chart library no-dependant.

Done
----
If you're happy about your renderer, don't hesitate to share it, it will be added to the supported libraries.