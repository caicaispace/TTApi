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
        'TTApiDemo\Controllers' => DOCROOT . $config->get('application')->controllersDir,
        'TTApiDemo\Models'      => DOCROOT . $config->get('application')->modelsDir,
        'TTApiDemo\Plugins'     => DOCROOT . $config->get('application')->pluginsDir,
        'Library'               => DOCROOT . $config->get('application')->libraryDir,
    ]
);

$loader->register();
