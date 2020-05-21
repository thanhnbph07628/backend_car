<?php $__env->startSection('content'); ?>
<div class="row">
    <table class="table table-stripped">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Category name</th>
        <th width="100">Image</th>
        <th>Price</th>
        <th>Star</th>
        <th>
            <a href="<?= BASE_URL . "products/add-product"?>" class="btn btn-sm btn-success">Thêm</a>
        </th>
        </thead>
        <tbody>
        <?php foreach($products as $pro):?>
        <tr>
            <td><?php echo $pro->id ?></td>
            <td><?php echo $pro->name ?></td>
            <td><?php echo $pro->getCategoryName() ?></td>
            <td>
                <img src="<?= BASE_URL . $pro->image?> " class="img-fluid">
            </td>
            <td><?php echo $pro->price ?></td>
            <td><?php echo $pro->star ?></td>
            <td>
                <a href="<?= BASE_URL . "products/edit-product/$pro->id"?>" class="btn btn-sm btn-primary">Sửa</a> &nbsp;
                <a href="<?= BASE_URL . "products/remove/$pro->id"?>" class="btn btn-sm btn-danger btn-remove">Xóa</a>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $('.btn-remove').on('click', function(){
                Swal.fire({
                    title: 'Cảnh báo!',
                    text: "Bạn chắc chắn muốn xóa sản phẩm này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!'
                }).then((result) => {
                    if (result.value) {
                        var url = $(this).attr('href');
                        window.location.href = url;
                    }
                })
                return false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Assphp2_Thanhnbph07628\Assignment\views/product/index.blade.php ENDPATH**/ ?>