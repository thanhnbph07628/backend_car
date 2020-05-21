<?php $__env->startSection('content'); ?>
<h1 style="margin-top: -45px; font-size: 25px;">THÊM THƯƠNG HIỆU</h1>
    <hr style="border: 1px solid #ccc;">
    <form id="add-brand-form" action="<?= BASE_URL . 'brands/save-add'?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên thương hiệu<span class="text-danger">*</span></label>
                        <input type="text" name="brand_name" class="form-control" placeholder="Nhập tên thương hiệu">
                    </div>
                     <div class="row">
                        <div class="col-md-6 ">
                            <label for="">Logo thương hiệu<span class="text-danger">*</span></label>
                            <img src="<?= DEFAULT_IMAGE ?>" class="img-fluid" id="img-preview">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="file" onchange="encodeImageFileAsURL(this)"  name="logo" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Quốc gia<span class="text-danger">*</span></label>
                        <input type="text" name="country" class="form-control" >
                    </div>
                </div>
                <div class="col-12 d-flex justify-left-end">
                    <button type="submit" class="btn btn-sm btn-primary">Tạo</button>&nbsp;
                    <a href="<?= BASE_URL . 'brands'?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
            </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
   <script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $("#img-preview").attr("src", "<?= DEFAULT_IMAGE ?>");
            return false;
        }
        var reader = new FileReader();
        reader.onloadend = function() {
            $("#img-preview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
    $(document).ready(function(){
        $('#add-brand-form').validate({
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
                            }
                        }
                    }
                },
                logo: {
                    required: true,
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
                    required: "Hãy chọn logo thương hiệu",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Thanhnbph07628_php2\Assignment\views/brand/add.blade.php ENDPATH**/ ?>