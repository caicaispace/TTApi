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
        'App\Controllers' => DOCROOT . 'app/controllers/',
        'App\Models'      => DOCROOT . 'app/models/',
        'App\Plugins'     => DOCROOT . 'app/plugins/',
        'App\Logics'      => DOCROOT . 'app/logics/',
        'App\Listeners'   => DOCROOT . 'app/listeners/',
        'Library'         => DOCROOT . 'library/',
    ]
);

$loader->register();
