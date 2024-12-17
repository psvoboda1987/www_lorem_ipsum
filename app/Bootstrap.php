<?php

declare(strict_types = 1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(): Configurator
    {
        define('ROOT_DIR', dirname(__DIR__));
        define('ENV_PRODUCTION', ($_SERVER['REMOTE_ADDR'] ?? null) !== '127.0.0.1'
            || ($_SERVER['SERVER_NAME'] ?? null) !== 'localhost');

        $configurator = new Configurator();

        $configurator->setTimeZone('Europe/Prague');
        $configurator->setTempDirectory(ROOT_DIR . '/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig(ROOT_DIR . '/config/common.neon');
        $configurator->addConfig(ROOT_DIR . '/config/services.neon');

        if (ENV_PRODUCTION) {
            $configurator->addConfig(ROOT_DIR . '/config/prod.neon');
            $configurator->enableTracy(ROOT_DIR . '/log', 'psvoboda1987@gmail.com');
            $configurator->setDebugMode('secret@213.29.74.133'); // enable for your remote IP

            if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
                \Sentry\init(['dsn' => 'https://749134a2caa642f086bb80aadd2371de@o1233979.ingest.sentry.io/4504237518422016']);
            }

            return $configurator;
        }

        $configurator->addConfig(ROOT_DIR . '/config/local.neon');
        $configurator->enableTracy(ROOT_DIR . '/log');
        return $configurator;
    }
}
