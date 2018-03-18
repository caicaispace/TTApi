<?php
/**
 * We're a registering a set of directories taken from the configuration file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Loader;

$loader = new Loader;

$loader->registerNamespaces(
    [
        'TTDemo\Controllers' => DOCROOT . $config->get('application')->controllersDir,
        'TTDemo\Models'      => DOCROOT . $config->get('application')->modelsDir,
        'TTDemo\Plugins'     => DOCROOT . $config->get('application')->pluginsDir,
        'TTDemo\Library'     => DOCROOT . $config->get('application')->libraryDir,
    ]
);

$loader->register();
