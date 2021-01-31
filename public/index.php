<?php
define('ROOT', dirname(__DIR__). DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR );
define('VIEW',ROOT . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR );
define('MODEL',ROOT . 'app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR );
define('CORE',ROOT . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR );
define('CONTROLLER',ROOT . 'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR );
if(isset($_GET["url"]))
define("URIROOT",str_replace($_GET["url"],"",$_SERVER['REQUEST_URI']));
else
define("URIROOT",$_SERVER['REQUEST_URI']);
define("HASH_KEY","hi");

if(isset($_SERVER['HTTP_REFERER'])) {
    define("BACKBUTTION",$_SERVER['HTTP_REFERER']);
}
// echo "<pre>servar <br>";

// echo str_replace($_GET["url"],"",$_SERVER['REQUEST_URI']);
// // var_dump($_SERVER);
// echo "</pre>";

$modules = [ROOT,APP,CORE,CONTROLLER];
//  var_dump(ROOT);

set_include_path(get_include_path().PATH_SEPARATOR . implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload',false);
// var_dump(get_include_path());
// print_r($modules);
// echo "<pre>";
// var_dump($_SERVER['REQUEST_URI']);
// var_dump($_SERVER);

new Application();

?>
