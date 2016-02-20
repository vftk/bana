<?php
include_once 'vendor/ekandreas/docker-bedrock/recipe.php';

set('docker.image', 'laravel52');

server('bana.dev', 'default')
    ->env('container', 'laravel')
    ->env('docker.image','laravel52')
    ->stage('development');
