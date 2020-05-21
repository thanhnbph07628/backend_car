<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 3/6/20
 * Time: 10:23
 */

namespace Controllers;

use Jenssegers\Blade\Blade;
class BaseController
{
    protected function render($viewPath, $dataArr = []){
        $blade = new Blade('views', 'storage');

        echo $blade->make($viewPath, $dataArr)->render();
    }

}

 