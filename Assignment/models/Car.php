<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Car extends Model{
    protected $table = 'cars';
    protected $fillable = ['brand_id', 'model_name', 'price', 'sale_price',
                            'detail', 'quantity'];
    protected $attributes = [
        'image' => "public/images/default-image.jpg",
    ];

     public $timestamps = false;
    
    public function getBrandName(){
        $brand = Brand::find($this->brand_id);
        if($brand){
            return $brand->brand_name;
        }

        return null;
    }
}


?>