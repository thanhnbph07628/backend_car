@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 style="margin-top: -45px; margin-bottom: 50px; font-size: 25px;">DANH SÁCH SẢN PHẨM</h1>
    <div style="margin-left: -252px; margin-bottom: 23px;">
    <form class="form-inline ml-3" method="get" action="{{BASE_URL . 'car/search'}}" enctype="multipart/form-data">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Tìm kiếm" aria-label="Search" name="key">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    </div>
    <table class="table table-stripped">
        <thead>
        <th>STT</th>
        <th>Name</th>
        <th>Brand name</th>
        <th width="170">Image</th>
        <th>Price</th>
        <th>Sale price</th>
        <th>Quantity</th>
        <th>
            <a href="<?= BASE_URL . "cars/add-car"?>" class="btn btn-sm btn-success">Thêm sản phẩm</a>
        </th>
        </thead>
        <tbody>
        <?php $stt = 1; foreach($cars as $car):?>
        <tr>
            <td><?php echo $stt; ?></td>
            <td><?php echo $car->model_name ?></td>
            <td><?php echo $car->getBrandName() ?></td>
            <td>
                <img src="<?= BASE_URL . $car->image?> " class="img-fluid">
            </td>
            <td><?php echo $car->price ?> VNĐ</td>
            <td><?php echo $car->sale_price ?> VNĐ</td>
            <td><?php echo $car->quantity ?></td>
            <td>
                <a href="<?= BASE_URL . "cars/edit-car/$car->id"?>" class="btn btn-sm btn-primary">Sửa</a> &nbsp;
                <a href="<?= BASE_URL . "cars/remove/$car->id"?>" class="btn btn-sm btn-danger btn-remove" style='margin-left: 23px;'>Xóa</a>
            </td>
        </tr>
        <?php $stt++; endforeach;?>
        </tbody>
    </table>
</div>

@endsection
@section('js')
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
@endsection