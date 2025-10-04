<?php
//BASE PATH
DEFINE("BASE_PATH",__DIR__."/../");

spl_autoload_register(function($class){
    $paths = [BASE_PATH . 'app/controller/', BASE_PATH . 'app/model/', BASE_PATH . 'app/config/'
    ];
    $exts = ['.php', '.controller.php', '.model.php'];
    foreach($paths as $path){
        foreach($exts as $ext){
            $fullpath = $path . strtolower($class) . $ext;
            if (file_exists($fullpath)) {
                try {
                    require_once $fullpath;
                    return;
                } catch (\Throwable $e) {
                    die("error loading class '$class' from file '$file':" . $e->getMessage());
                }
                
                
            }
        }
    }
    //throw new Exception("Autoload Error: Class '{$class}' not found. Checked paths: " . implode(', ', $paths));
});

Session::start();


