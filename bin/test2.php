<?php

echo "test2.php-5\n";

if (isset($_SERVER['REQUEST_METHOD'])) {
    echo "Only CLI allowed. Script stopped.\n";
    exit (1);
}

echo "test2.php-1\n";

/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../config/bootstrap.php';

echo "test2.php-2\n";
$commands = $container->get('settings')['commands'];

echo "test2.php-3\n";

$application = new \Symfony\Component\Console\Application();

echo "test2.php-4\n";

foreach ($commands as $class) {
    echo "test2.php-5\n";
    echo $class . "\n";
    $application->add($container->get($class));
}

echo "test2.php-done\n";
