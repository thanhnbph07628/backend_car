<?php
namespace Controllers;
use Models\Car;
use Models\User;
use Models\Brand;
class HomeController extends BaseController {


	public function index(){
		$cars = Car::all();
		include_once './views/home/index.php';
	}

	public function dashboard(){
        $totalBrand = Brand::count();
        $totalCar = Car::count();

	    $this->render('admin.dashboard', [
            'brandCount' => $totalBrand,
            'carCount' => $totalCar
        ]);
    }
}


 ?>