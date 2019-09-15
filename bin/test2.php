<?php

if (isset($_SERVER['REQUEST_METHOD'])) {
    echo "Only CLI allowed. Script stopped.\n";
    exit (1);
}

/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/bootstrap.php';

$commands = $container->get('settings')['commands'];
$application = new \Symfony\Component\Console\Application();

foreach ($commands as $class) {
    echo "$class\n";
    $application->add($container->get($class));
}

echo "test2.php done\n";
