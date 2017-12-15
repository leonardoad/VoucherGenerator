<?php

// ============================================================================================
// ========================= INCLUDES For the PHPUnit Tests =====================================
// ============================================================================================
/**
 * EX: RAIZ_DIRETORY =  "var/www/". BASE;
 */
define('RAIZ_DIRETORY', $_SERVER['PWD'] . '/');
define('BASE', "voucher");
$bar = '/';
$pathSeparator = ';';
$applicationName = 'site/';
require_once RAIZ_DIRETORY . 'Libs/Constantes.php';
require_once RAIZ_DIRETORY . $applicationName . 'Application/Constantes.php';
$path = $pathSeparator . RAIZ_DIRETORY . 'Libs';
$path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'Models';
$path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'ModelsView';
$path .= $pathSeparator . RAIZ_DIRETORY . 'Libs' . $bar . 'Zend';
set_include_path($path);
//print'<pre>';die(print_r( $path ));
require_once('Loader/Autoloader.php');
require_once('Zend/Db/Table.php');
require_once('Zend/Config/Ini.php');
require_once('Db/Table.php');
require_once('Format/String.php');
require_once('DataHora.php');

// Configs of the DB connection
$dbconfig = 'local';
$config = new Zend_Config_Ini(RAIZ_DIRETORY . 'site/Application/Config.ini', $dbconfig);
$zend_db_config = $config->db->config->toArray();
$db = Zend_Db::factory($config->db->adapter, $zend_db_config);
Zend_Db_Table_Abstract::setDefaultAdapter($db);

// ============================================================================================
// ============================================================================================
//