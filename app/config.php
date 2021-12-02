<?php
/**
 * Inicialización de sesión de usuario
 */
session_start();

/**
 * URL constante
 */
define('PORT'     , '');
define('BASEPATH' , '/proyectos/sistema-ERP/');
define('URL'      , 'http://localhost:'.PORT.BASEPATH);

/**
 * Constantes para los paths de archivos
 */
define('DS'       , DIRECTORY_SEPARATOR);
define('ROOT'     , getcwd().DS);
define('APP'      , ROOT.'app'.DS);
define('INCLUDES' , ROOT.'includes'.DS);
define('VIEWS'    , ROOT.'views'.DS);
define('MODULES'  , ROOT.'views'.DS.'modules'.DS);

define('ASSETS'         , URL.'assets/');
define('CSS'            , ASSETS.'css/');
define('IMAGES'         , ASSETS.'images/');
define('JS'             , ASSETS.'js/');
define('PLUGINS'        , ASSETS.'plugins/');
define('UPLOADS'        , 'assets/uploads/');

/**
 * Constantes adicionales
 */
define('SALT'             , 'MadeWithLove');
define('SHIPPING_COST'    , 99.90);
define('COMPANY_NAME'     , ' C´sar<i style="font-size: 18px;" class="fas fa-cart-plus fa-2x text-gray-300"></i>_ERP');
define('COMPANY_EMAIL'    , 'noreplay@gmail.com');
define('RECORDS_PER_PAGE' , 4);

/**
 * Constantes de la conexión a la base de datos
 */
define('DB_ENGINE'  , 'mysql');
define('DB_HOST'    , 'localhost');
define('DB_NAME'    , 'erp');
define('DB_USER'    , 'root');
define('DB_PASS'    , '');
define('DB_CHARSET' , 'utf8');

/**
 * Incluir todas nuestras funciones personalizadas
 */
require_once APP.'db_functions.php';
require_once APP.'functions.php';