<?php
// bootstrap.php
define ("ROOT",  dirname(__DIR__, 1));
/**
 * This will load all the classes needed
 */
require_once("vendor/autoload.php");

/** $connectionParams is set in this file. This file is ignored by git.
 * Format of the $connectionsParams
 * $connectionParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => "database_user",
    'password' => "database_password",
    'dbname'   => "database_name",
    'host'     => "database_host",
    'port'     => "database_port"
    );
 */
require_once "database-config.php";
// Doctrine EntityManager
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(ROOT . "/src/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$config->addEntityNamespace('Entity', 'src\Entity');

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
