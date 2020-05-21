@extends('layouts.admin')
@section('content')
<h1 style="margin-top: -45px; font-size: 25px;">SỬA SẢN PHẨM</h1>
<hr style="border: 1px solid #ccc;">
        <form id="edit-car-form" action="<?= BASE_URL . 'cars/save-edit'?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $car->id?>">
            <input type="hidden" name="brand_id">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên sản phẩm<span class="text-danger">*</span></label>
                        <input type="text" name="model_name" class="form-control" value="<?= $car->model_name?>" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Thương hiệu</label>
                        <select name="brand_id" class="form-control">
                            <?php foreach ($brands as $value):?>
                            <option
                                    <?php if($value->id == $car->brand_id):?>
                                        selected
                                    <?php endif?>
                                    value="<?= $value->id ?>"><?= $value->brand_name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" value="<?= $car->price?>" placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Giá Sale</label>
                        <input type="number" name="sale_price" class="form-control" value="<?= $car->sale_price?>" placeholder="Nhập sale sản phẩm">
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <img src="<?= BASE_URL . $car->image ?>" class="img-fluid" id="img-preview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh sản phẩm<span class="text-danger">*</span></label>
                        <input type="file" onchange="encodeImageFileAsURL(this)"  name="image" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Định lượng</label>
                        <input type="number" name="quantity" value="<?= $car->quantity?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Chi tiết</label>
                        <textarea name="detail" class="form-control" rows="7"><?= $car->detail ?></textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>&nbsp;
                    <a href="<?= BASE_URL . 'cars'?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
            </div>
        </form>
@endsection
@section('js')
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $("#img-preview").attr("src", "<?= BASE_URL . $car->image ?>");
            return false;
        }
        var reader = new FileReader();
        reader.onloadend = function() {
            $("#img-preview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
    $(document).ready(function(){
        $('#edit-car-form').validate({
            rules:{
                model_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        url: "<?= BASE_URL . 'cars/check-name'?>",
                        type: "post",
                        data: {
                            model_name: function() {
                                return $( "input[name='model_name']" ).val();
                            },
                            id: function(){
                                return $( "input[name='id']" ).val();
                            }
                        }
                    }
                },
                price: {
                    required: true,
                    number: true,
                    min: 1
                },
                sale_price: {
                    required: true,
                    number: true,
                    min: 0
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 0
                },
                image: {
                    extension: "jpg|png|jpeg|gif"
                }
            },
            messages:{
                model_name: {
                    required: "Nhập tên sản phẩm",
                    minlength: "Tối thiểu 2 ký tự",
                    remote: "Tên sản phẩm đã tồn tại, vui lòng chọn tên khác"
                },
                price: {
                    required: "Nhập giá sản phẩm",
                    number: "Yêu cầu nhập số",
                    min: "Giá trị nhỏ nhất là 1"
                },
                sale_price: {
                    required: "Nhập giá sale",
                    number: "Yêu cầu nhập số",
                    min: "Giá trị nhỏ nhất là 1"
                },
                quantity: {
                    required: "Nhập định lượng",
                    number: "Yêu cầu nhập số",
                    min: "Không nhập số âm"
                },
                image: {
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                }
            }
        });
    });
</script>
@endsection