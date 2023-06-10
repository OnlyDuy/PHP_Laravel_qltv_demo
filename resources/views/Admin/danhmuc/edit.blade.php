@extends('admin.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nhập thông tin sách cần sửa</h3>
                    </div>

                    <form action="/admin/danhmuc/edit/{{$danhmuc->id}}" method="POST" id="quickForm" novalidate="novalidate">
                        <!-- Tạo session xong khi muốn hiện lỗi phải có @include('share.error') ở đây -->
                        @include('share.error')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã danh mục</label>
                                <input readonly type="text" name="MaDM" value="{{$danhmuc->MaDM}}" class="form-control" id="MaDM" placeholder="Mã danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="TenDM" value="{{$danhmuc->TenDM}}" class="form-control" id="TenDM" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <!-- <textarea type="text" name="MoTa" class="form-control" id="exampleInputDec"> </textarea> -->
                                <textarea name="MoTa" id="mota" rows="10" cols="80" class="form-control">
                                        {{$danhmuc->MoTa}}
                                </textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    CKEDITOR.replace('mota');
                                </script>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input type="text" value="{{$danhmuc->ViTri}}" name="ViTri" class="form-control" id="ViTri" placeholder="Vị trí">
                            </div>

                        </div>

                        <div class="card-footer d-flex">
                            <div id="btn_comback">
                                <a href="../listdanhmuc" class="btn btn-secondary">Quay lại</a>
                            </div>

                            <div class="ml-5">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>


            <div class="col-md-6">
            </div>

        </div>
    </div>
</section>
@endsection