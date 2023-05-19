<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => "pgsql",
    "host" => "postgres",
    "database" => "project",
    "username" => "postgres",
    "password" => "postgres"
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();