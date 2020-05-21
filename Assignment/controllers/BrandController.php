<?php
namespace Controllers;
use Models\Brand;
class BrandController extends BaseController {
    public function brand(){
        // 1. Lấy toàn bộ thương hiệu
        $brands = Brand::all();
        $this->render('brand.brand', ['brands' => $brands]);
    }

    // tìm kiếm thương hiệu
    public function getSearch(){
        $proid = isset($_GET['key']) ? $_GET['key'] : -1;
        $brand = Brand::where('brand_name','like','%'. $proid.'%')->get();
        $this->render('brand.search', [
            'brand' => $brand
        ]);

    }

    public function remove($id){

        // lấy ra thương hiệu dựa vào id
        $brand = Brand::find($id);
        if($brand == null){
            header("location: " . BASE_URL . "brands?msg=id không tồn tại");
            die;
        }

        // xoá sản phẩm dựa vào id
        Brand::destroy($id);
        header("location: " . BASE_URL . "brands?msg=Xóa thành công!");
        die;
    }

    public function addForm(){
        $this->render('brand.add');
    }

    public function editForm($id){
        // lấy ra dữ liệu của thương hiệu theo id
        $brand = Brand::find($id);
        if(!$brand){
            header("location: " . BASE_URL . "brands?msg=id không tồn tại");
            die;
        }

        $this->render('brand.edit', ['brand' => $brand]);
    }

    public function saveAdd(){
        $model = new Brand();
        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['logo'];
        $filename = "";
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->logo = $filename;
        // lưu dữ liệu với csdl
        $model->save();
        header('location: ' . BASE_URL . 'brands');
        die;
    }

    public function saveEdit(){
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $model = Brand::find($id);
        if(!$model){
            header("location: " . BASE_URL . "brands?msg=id không tồn tại");
            die;
        }

        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['logo'];
        $filename = $model->logo;
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->logo = $filename;
        // lưu dữ liệu với csdl
        $model->save();
        header('location: ' . BASE_URL . 'brands');
        die;
    }

    public function checkNameExisted(){
        $name = $_POST['brand_name'];
        $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $queryData = Brand::where('brand_name', $name);

        if($id != -1){
            $queryData->where('id', '!=', $id);
        }
        $numberRecord = $queryData->count();

        echo $numberRecord == 0 ? "true" : "false";
    }
}
