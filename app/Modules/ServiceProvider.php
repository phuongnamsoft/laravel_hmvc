<?php

namespace App\Modules;
use File;
use Illuminate\Support\Facades\Route;

class ServiceProvider extends  \Illuminate\Support\ServiceProvider {

    private $currentModule = '';

    public function autoloader($class) {
        if ($this->currentModule != '') {
            $namespacePrefix = $this->currentModule . "\\";
            $prefixLength = strlen($namespacePrefix);
            if (0 === strncmp($namespacePrefix, $class, $prefixLength)) {
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }
    }

    public function boot() {
        $listModule = array_map('basename', File::directories(__DIR__));
        foreach ($listModule as $module) {
            $this->currentModule = $module;
            $controllerNamespace = $module . '\\' . "Controllers";
            if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'routes.php')) {
                Route::namespace($controllerNamespace)->group(__DIR__. DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'routes.php');
            }
            if (is_dir(__DIR__. DIRECTORY_SEPARATOR . $module  . DIRECTORY_SEPARATOR . 'Views')) {
                $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Views', $module);
            }
            spl_autoload_register(array($this, 'autoloader'));
        }
    }

    public function register() {

    }
}