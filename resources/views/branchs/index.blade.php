@extends('layouts.master')
@section('cssCustom')
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
@endsection
@section('content')
    <div class="top-content">
        @if(isset($flash_massage))
            <div class="alert alert-success">
                <strong>{{$flash_massage}}</strong>
            </div>
        @endif
        <h2>DANH SÁCH CHI NHÁNH </h2>
        <h5><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">THÊM MỚI DỮ LIỆU</button></h5>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">THÊM MỚI DỮ LIỆU</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="photo-form" action="/HTTT_QuanLy/public/branchs/add-new-branch" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                                <label for="fname">Tên Chi Nhánh</label>
                                <input type="text" id="fname" name="txtBranchName" placeholder="Name branch...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Địa Chỉ</label>
                            <input type="text" id="fname" name="txtAddressBranch" placeholder="Address branch...">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>MÃ CN</th>
            <th>TÊN CHI NHÁNH</th>
            <th>ĐỊA CHỈ</th>
            <th>NGÀY TẠO</th>
            <th>NGÀY CẬP NHẬT</th>
            <th>THAO TÁC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $value){ ?>
            <tr>
                <td><?php echo $value['id']?></td>
                <td><?php echo $value['code']?></td>
                <td><?php echo $value['name']?></td>
                <td><?php echo $value['address']?></td>
                <td><?php echo $value['created_at']?></td>
                <td><?php echo $value['updated_at']?></td>
                <td>
{{--ACTION--EDIT--}}
                    <div class="modal fade modalEditClass" id="modalEdit{{$value['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold text-secondary ml-5">Sửa Chi Nhánh</h4>
                                    <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="photo-form" action="/HTTT_QuanLy/public/branchs/update-branch/{{$value['id']}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">TÊN CHI NHÁNH</label>
                                            <input type="text" id="txtBranchName" name="txtBranchName" class="form-control validate" value="{{$value['name']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">ĐỊA CHỈ</label>
                                            <input type="text" id="txtAddressBranch" name="txtAddressBranch" class="form-control validate" value="{{$value['address']}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{$value['id']}}">SỬA</button>
{{--END--EDIT--}}
{{--ACTION--DELETE--}}
                    <div class="modal fade" id="modalDelete{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalDelete"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold ml-5 text-danger">Delete</h4>
                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/HTTT_QuanLy/public/branchs/delete-branch/{{$value['id']}}" method="POST">
                                    @csrf
                                    <div class="modal-body mx-3">
                                        <p class="text-center h4">Bạn có muốn xóa {{$value['name']}} không?</p>

                                    </div>
                                    <div class="modal-footer d-flex justify-content-center deleteButtonsWrapper">
                                        <input type="submit" class="btn btn-danger" value="Đồng Ý">
                                        <button type="button" class="btn btn-primary btnNoClass" id="btnNo" data-dismiss="modal">Không Xóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete{{$value['id']}}">DELETE</button>
{{--END--DELETE--}}
                </td>
            </tr>
        <?php } ?>
    </table>
    {{$data->links()}}
@endsection
