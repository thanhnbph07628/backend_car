@extends('layouts.admin')
@section('content')
<h1 style="margin-top: -45px; font-size: 25px;">SỬA THƯƠNG HIỆU</h1>
    <hr style="border: 1px solid #ccc;">
        <form id="edit-brand-form" action="<?= BASE_URL . 'brands/save-edit'?>" method="post" enctype="multipart/form-data">
           <input type="hidden" name="id" value="<?= $brand->id?>">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên thương hiệu<span class="text-danger">*</span></label>
                        <input type="text" name="brand_name" class="form-control" value="<?= $brand->brand_name?>" placeholder="Nhập tên thương hiệu">
                    </div>
                      <div class="row">
                        <div class="col-md-6 ">
                            <label for="">Logo thương hiệu<span class="text-danger">*</span></label>
                            <img src="<?= BASE_URL . $brand->logo ?>" class="img-fluid" id="img-preview">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="file" onchange="encodeImageFileAsURL(this)"  name="logo" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Quốc gia<span class="text-danger">*</span></label>
                        <input type="text" name="country" class="form-control" value="<?= $brand->country?>" placeholder="Nhập tên quốc gia">
                    </div>
                </div>
                <div class="col-12 d-flex justify-left-end">
                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>&nbsp;
                     <a href="<?= BASE_URL . 'brands'?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
                </div>
        </form>
@endsection
@section('js')
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $("#img-preview").attr("src", "<?= BASE_URL . $brand->logo ?>");
            return false;
        }
        var reader = new FileReader();
        reader.onloadend = function() {
            $("#img-preview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
    $(document).ready(function(){
        $('#edit-brand-form').validate({
            rules:{
                brand_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        url: "<?= BASE_URL . 'brands/check-name'?>",
                        type: "post",
                        data: {
                            brand_name: function() {
                                return $( "input[name='brand_name']" ).val();
                            },
                            id: function(){
                                return $( "input[name='id']" ).val();
                            }
                        }
                    }
                },
                logo: {
                    extension: "jpg|png|jpeg|gif"
                },
                country: {
                    required: true,
                    minlength: 2,
                }
            },
            messages:{
                brand_name: {
                    required: "Nhập tên thương hiệu",
                    minlength: "Tối thiểu 2 ký tự",
                    remote: "Tên thương hiệu đã tồn tại, vui lòng chọn tên khác"
                },
                logo: {
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                },
                country: {
                    required: "Nhập tên quốc gia",
                    minlength: "Tối thiểu 2 ký tự"
                }
            }
        });
    });
</script>
@endsection