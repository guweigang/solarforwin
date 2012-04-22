<?php
/**
 * all config values go in this array, which will be returned at the end of
 * this script. vendor configs should modify this array directly.
 */
$config = array();

/**
 * system directory
 */
$system = dirname(__FILE__);
$config['Solar']['system'] = $system;

/**
 * default configs for each vendor
 */
include "$system/source/solar/config/default.php";

/**
 * project overrides
 */

// front controller
$config['Solar_Controller_Front'] = array(
    'classes' => array('Acme_App', 'Solar_App'),
    'disable' => array(),
    'default' => 'hello',
    'rewrite' => array(),
    'routing' => array(),
    'explain' => true,
);

// model catalog
$config['Solar_Sql_Model_Catalog']['classes'] = array();

// model catalog
$config['Solar_Sql_Model_Catalog']['classes'] = array("Acme_Model");

$config['Solar_Sql']['adapter'] = 'Solar_Sql_Adapter_Mysql';

// configure the SQL adapter class
$config['Solar_Sql_Adapter_Mysql'] = array(
    'host' => 'localhost', // the database server host
    'name' => 'pzblog',  // the database name
    'user' => 'root',  // authenticate as this user
    'pass' => '',  // authenticate with this password
    'charset' => 'utf8',
);
/**
 * done!
 */
return $config;
