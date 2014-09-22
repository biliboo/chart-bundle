Installation
============

## Get the bundle using composer

Add BilibooChartBundle by running this command from the terminal at the root of
your Symfony project:

```bash
php composer.phar require biliboo/chart-bundle '~1.0.0'
```

## Enable the bundle

To start using the bundle, register the bundle in your application's kernel class:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Biliboo\ChartBundle\BilibooChartBundle(),
        // ...
    );
)
```

## Done

You finished the installation, you can go now to the [usage](usage.md) or [the index](index.md).