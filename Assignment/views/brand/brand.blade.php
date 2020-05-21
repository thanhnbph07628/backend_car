@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 style="margin-top: -45px; margin-bottom: 50px; font-size: 25px;">DANH SÁCH THƯƠNG HIỆU</h1>
    <div style="margin-left: -295px; margin-bottom: 23px;">
    <form class="form-inline ml-3" method="get" action="{{BASE_URL . 'brand/search'}}" enctype="multipart/form-data">
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
            <th width="170">Logo</th>
            <th>Country</th>
            <th>
                <a href="<?= BASE_URL . "brands/add-brand"?>" class="btn btn-sm btn-success">Thêm thương hiệu</a>
            </th>
        </thead>
        <tbody>
        <?php $stt = 1; foreach($brands as $bra):?>
            <tr>
                <td><?php echo $stt; ?></td>
                <td><?php echo $bra->brand_name ?></td>
                <td>
                    <img src="<?= BASE_URL . $bra->logo?>" width = "140px;" style="margin-left: -20px;">
                </td>
                <td><?php echo $bra->country ?></td>
                <td>
                    <a href="<?= BASE_URL . "brands/edit-brand/$bra->id"?>" class="btn btn-sm btn btn-primary">Sửa</a> &nbsp;
                    <a href="<?= BASE_URL . "brands/remove/$bra->id"?>" class="dele btn btn-sm btn-danger btn-remove" style="margin-left: 35px;">Xóa</a>
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
                    text: "Bạn chắc chắn muốn xóa thương hiệu này?",
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