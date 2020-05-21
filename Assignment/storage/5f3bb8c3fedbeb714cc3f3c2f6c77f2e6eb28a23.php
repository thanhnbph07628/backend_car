<?php $__env->startSection('content'); ?>
    <form id="add-product-form" action="<?= BASE_URL . 'products/save-add'?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tên sản phẩm<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="cate_id" class="form-control">
                        <?php foreach ($cates as $ca):?>
                        <option value="<?= $ca->id ?>"><?= $ca->cate_name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Số lượng views</label>
                    <input type="number" name="views" class="form-control" placeholder="Nhập số lượt xem sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea name="short_desc" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <img src="<?= DEFAULT_IMAGE ?>" class="img-fluid" id="img-preview">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ảnh sản phẩm<span class="text-danger">*</span></label>
                    <input type="file" onchange="encodeImageFileAsURL(this)"  name="image" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">Số sao</label>
                    <input type="number" step="0.1" name="star" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">Chi tiết</label>
                    <textarea name="detail" class="form-control" rows="7"></textarea>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-primary">Tạo</button>&nbsp;
                <a href="<?= BASE_URL ?>" class="btn btn-sm btn-danger">Hủy</a>
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
            // tên: bắt buộc nhập, tối thiểu 2 ký tự
            // giá: bắt buộc nhập, phải là số, không âm
            // views: ko bắt buộc nhập, phải là số, không âm
            // star: ko bắt buộc nhập, phải là số, không âm, nằm trong khoảng 0-5
            // ảnh sản phẩm: bắt buộc nhập, chỉ chấp nhận định dạng ảnh
            $('#add-product-form').validate({
                rules:{
                    name: {
                        required: true,
                        minlength: 2,
                        remote: {
                            url: "<?= BASE_URL . 'products/check-name'?>",
                            type: "post",
                            data: {
                                name: function() {
                                    return $( "input[name='name']" ).val();
                                }
                            }
                        }
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    views: {
                        number: true,
                        min: 0
                    },
                    star: {
                        number: true,
                        min: 0
                    },
                    image: {
                        required: true,
                        extension: "jpg|png|jpeg|gif"
                    }
                },
                messages:{
                    name: {
                        required: "Nhập tên sản phẩm",
                        minlength: "Tối thiểu 2 ký tự",
                        remote: "Tên sản phẩm đã tồn tại, vui lòng chọn tên khác"
                    },
                    price: {
                        required: "Nhập giá sản phẩm",
                        number: "Yêu cầu nhập số",
                        min: "Giá trị nhỏ nhất là 1"
                    },
                    views: {
                        number: "Yêu cầu nhập số",
                        min: "Không nhập số âm"
                    },
                    star: {
                        number: "Yêu cầu nhập số",
                        min: "Không nhập số âm"
                    },
                    image: {
                        required: "Hãy chọn ảnh sản phẩm",
                        extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Assphp2_Thanhnbph07628\Assignment\views/product/add.blade.php ENDPATH**/ ?>