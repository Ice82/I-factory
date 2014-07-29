<?php
//error_reporting(E_ALL);
ini_set('display_errors', '0');
session_start("taxinsieme");

spl_autoload_register('auto_load');

function auto_load($class_name)
{
    static $dtree;

    if(!isset($dtree) || !isset($dtree[$class_name]))
        $dtree = getDirectoryTree($_SERVER['DOCUMENT_ROOT'] . '/class');

    if(!file_exists(@$dtree[$class_name]))
    {
        echo "<pre>Enable load class: {$class_name}</pre>";
        exit;
    }
    require_once($dtree[$class_name]);
}

function getDirectoryTree($outerDir, $filters = array())
{
    static $files;

    $dirs = array_diff(scandir($outerDir), array_merge(Array(".", "..", ".svn"), $filters));
    $dir_array = Array();
    foreach($dirs as $d)
    {
        if(is_dir("{$outerDir}/{$d}"))
        {
            getDirectoryTree($outerDir . "/" . $d, $filters);
        } else
        {
            $class_name = str_replace('.php', '', $d);
            if(!isset($files[$class_name]))
                $files[$class_name] = $outerDir . "/" . $d;
        }
    }
    return $files;
}


$pagina = Helpers::getNomeFile();
$pagina = $pagina ? $pagina : "home.html";
$dominio = $_SERVER['SERVER_NAME'];
?>