<?php

require_once __DIR__.'/vendor/autoload.php';

use Crada\Apidoc\Builder;
use Crada\Apidoc\Exception;

$classes = array(
    'atitude\app\Http\Controllers\AtitudeControllerProvider',
);

$output_dir  = __DIR__.'/web/apidocs';
$output_file = 'api.html'; // defaults to index.html

try {
    $builder = new Builder($classes, $output_dir, 'Api Atitude Vídeos', $output_file);
    $builder->generate();
} catch (Exception $e) {
    echo 'There was an error generating the documentation: ', $e->getMessage();
}