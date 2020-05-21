<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 2/25/20
 * Time: 10:16
 */

namespace Commons;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class Routing
{
    public static function index($url){


        $router = new RouteCollector();

        $router->get('/', ["Controllers\HomeController", "index"]);

        $router->get('cars', ["Controllers\CarController", "index"]);
        $router->get('cars/add-car', ["Controllers\CarController", "addForm"]);
        $router->get('cars/edit-car/{id}', ["Controllers\CarController", "editForm"]);
        $router->post('cars/save-add', ["Controllers\CarController", "saveAdd"]);
        $router->post('cars/save-edit', ["Controllers\CarController", "saveEdit"]);

        $router->get('brands', ["Controllers\BrandController", "brand"]);
        $router->get('brands/add-brand', ["Controllers\BrandController", "addForm"]);
        $router->get('brands/edit-brand/{id}', ["Controllers\BrandController", "editForm"]);
        $router->post('brands/save-add', ["Controllers\BrandController", "saveAdd"]);
        $router->post('brands/save-edit', ["Controllers\BrandController", "saveEdit"]);

        // {id} => tham số trên đường dẫn
        $router->get('cars/remove/{id}', ["Controllers\CarController", "remove"]);
        $router->post('cars/check-name', ["Controllers\CarController", "checkNameExisted"]);

        $router->get('brands/remove/{id}', ["Controllers\BrandController", "remove"]);
        $router->post('brands/check-name', ["Controllers\BrandController", "checkNameExisted"]);

        $router->get('admin', ["Controllers\HomeController", "dashboard"]);

        $router->get('brand/search', ["Controllers\BrandController", "getSearch"]);
        $router->get('car/search', ["Controllers\CarController", "getSearch"]);

        $dispatcher = new Dispatcher($router->getData());

        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url,
            PHP_URL_PATH));

        echo $response;
    }
}