<?php

// Include Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use Equip\Project\Domain;

Equip\Application::build()
->setConfiguration([
    Equip\Configuration\AurynConfiguration::class,
    Equip\Configuration\DiactorosConfiguration::class,
    Equip\Configuration\PayloadConfiguration::class,
    Equip\Configuration\RelayConfiguration::class,
    Equip\Configuration\WhoopsConfiguration::class,
])
->setMiddleware([
    Relay\Middleware\ResponseSender::class,
    Equip\Handler\ExceptionHandler::class,
    Equip\Handler\DispatchHandler::class,
    Equip\Handler\JsonContentHandler::class,
    Equip\Handler\FormContentHandler::class,
    Equip\Handler\ActionHandler::class,
])
->setRouting(function (Equip\Directory $directory) {
    return $directory
        ->get('/employees/{id:\d+}/shifts', Domain\EmployeeShifts::class) // List shifts for employee {id}
        ->get('/employees', Domain\Employees::class) // List employees (with filters in query string)
    ->get('/hello[/{name}]', Domain\Hello::class)
    ->post('/hello[/{name}]', Domain\Hello::class)
    ; // End of routing
})
->run();
