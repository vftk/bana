<?php
include_once 'vendor/ekandreas/docker-bedrock/recipe.php';

set('docker.image','laravel');

server('bana.dev', 'default')
    ->env('container', 'laravel')
    ->stage('development');
