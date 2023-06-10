@extends('admin.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Danh sách danh mục</h3>
                    </div> -->
                    <br>
                    <div class="container">
                        <form action="" method="get">
                            <div class="row">
                                <!-- <div class="col-2">
                                    <select class="form-control" name="ViTri">
                                        <option value="1" {{request()->ViTri=='1'?'selected':false}}>Giá sách 1</option>
                                        <option value="2" {{request()->ViTri=='2'?'selected':false}}>Giá sách 2</option>
                                        <option value="3" {{request()->ViTri=='3'?'selected':false}}>Giá sách 3</option>
                                    </select>   
                                </div> -->
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="keywords" value="{{request()->keywords}}">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-success" type="submit" value="Tìm kiếm">
                                </div>
                                <div class="col-md-3 ml-auto">
                                    <a class="btn btn-primary" href="./add" role="button" id="">Thêm danh mục</a>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3 mb-2">
                            <form action="/admin/danhmuc/list/setpage" method="post" id="quickForm">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="setLimit inline-block" class="col-form-label">Số dòng trên mỗi trang:</label>
                                        <input type="number" class="form-control  inline-block" id="setLimit" name="setLimit" min="1" step="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="số nguyên và lớn hơn 0" required>
                                    </div>
                                    <div class="d-flex justify-content-center w-25 p-3">
                                        <button type="submit" class="btn btn-outline-dark"> Save </button>
                                    </div>
                                    @csrf
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Mã danh mục</th>
                                <th scope="col" class="text-decoration-none"><a href="?sort-by=TenDM&sort-type={{$sortType}}">Tên danh mục</a></th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($danhmuc))
                            @foreach ($danhmuc as $key => $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->MaDM}}</td>
                                <td>{{$value->TenDM}}</td>
                                <td>{!!$value->MoTa!!}</td>
                                <td>{{$value->ViTri}}</td>
                                <td>
                                    <a class="btn btn-primary" href="/admin/danhmuc/edit/{{$value->id}}">
                                        <i class="fas fa-edit"> </i>
                                    </a>
                                    <!-- <a class="btn btn-danger" href="#" >
                                        <i class = "fas fa-trash"> </i>
                                    </a> -->
                                    <a class="btn btn-danger" href="#" onclick="Delete('{{$value->id}}', '/admin/danhmuc/delete')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Không có dữ liệu nào</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $danhmuc->links() }}
                </div>
            </div>



            <div class="col-md-6">
            </div>

        </div>
    </div>
</section>
@endsection