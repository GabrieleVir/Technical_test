<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
/** $connectionParams is set in this file. This file is ignored by git.
 * Format of the $connectionsParams
 * $connectionParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => "database_user",
        'password' => "database_password",
        'dbname'   => "database_name",
        );
 */
require_once "database-config.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Entity/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
