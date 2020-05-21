<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Brand extends Model{
    protected $table = 'brands';
 	protected $fillable = ['brand_name', 'country'];
    protected $attributes = [
        'logo' => "public/images/default-image.jpg",
    ];
    public $timestamps = false;
}


?>