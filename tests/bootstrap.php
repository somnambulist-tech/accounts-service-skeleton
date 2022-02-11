<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

/*
 * Make sure Liip Fixtures doesn't error when using loadFixture and group annotations
 */
AnnotationReader::addGlobalIgnoredName('covers');
AnnotationReader::addGlobalIgnoredName('group');

if (!defined('AMQP_NOPARAM')) {
    define('AMQP_NOPARAM', 0);
}
