<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$dir = __DIR__;

$config = array(
    'title' => 'Majolica Internal API',
    'build_dir' => $dir . '/web/docs/api',
    'cache_dir' => $dir . '/var/cache/sami',
    'default_opened_level' => 2,
    'include_parent_data' => true,
    'insert_todos' => true,
);

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('src')
;

return new Sami($iterator, $config);
