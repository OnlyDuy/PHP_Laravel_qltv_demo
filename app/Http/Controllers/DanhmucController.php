<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDanhMucRequest;
use App\Http\Service\DanhmucService;
use App\Models\Danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;

class DanhmucController extends Controller
{
    protected $danhmucService;

    //const _PER_PAGE = 4;

    // Class này sẽ kế thừa của class Controller
    // Có 1 biến là danhmucService và hàm khỡi tạo sẽ truyền 1 danh sách là DanhmucService với tham số 
        // truyền vào là $danhmucService
    public function __construct(DanhmucService $danhmucService) {
        $this->danhmucService = $danhmucService;
    }

    public function create()
    {
        return view('admin.danhmuc.add', [
            'title' => 'Thêm mới danh mục'
        ]);
    }

    // Phần thêm mới (NEW)
    public function store(CreateDanhMucRequest $request){
        //xử lý thêm mới danh mục
        //dd($request->input());

        // Thường thì code luôn trong Controllers nhưng t sẽ tạo 1 thư mục riêng gọi là Service
        
        // Lấy giá trị đã request
        $result = $this->danhmucService->create($request);
        return redirect()->back();
    }

    // Phần danh sách
    // public function index(){
    //     // Câu truy vấn lấy ra danh sách danh mục
    //     $title = 'Danh sách danh mục';
    //     $danhmuc = DB::select("SELECT * FROM danhmucs");

    //     return view('admin.danhmuc.listdanhmuc', compact('title','danhmuc'));
    // }
    public function listdanhmuc(Request $request){
        $filters = [];
        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
        // Xử lí logic sắp xếp
        //$sortBy = 'TenDM';
        $sortType = $request->input('sort-type');
        $sortBy = $request->input('sort-by');

        $allowSort = ['ASC', 'DESC'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'DESC'){
                $sortType = 'ASC';
            } else {
                $sortType = 'DESC';
            }
        } else {
            $sortType = 'ASC';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        return view('admin.danhmuc.listdanhmuc', [
            'title' => 'Danh sách danh mục',
            'danhmuc' => $this->danhmucService->getAll($filters, $keywords, $sortArr),
            'sortType'=> $sortType,
        ]);
    }

    public function setLimit(Request $request)
    {
        $limit = intval($request->setLimit);
        if ($limit == 0) {
          Session()->flash('error',gettype($limit));
        }
        else {
            Session()->put("pageLimit",$limit);
            Session()->flash("success","Cài đặt phân trang thành công: ".$limit);
        }
        return redirect()->back();
    }

    public function edit(Danhmuc $danhmuc){
        return view('admin.danhmuc.edit', [
            'title' => 'Sửa danh sách danh mục',
            // Đối tượng danh mục sẽ được khởi tạo ở đây để lấy ra các dữ liệu lên ô input
            'danhmuc' => $danhmuc
        ]);
    }

    public function postedit(CreateDanhMucRequest $request ,Danhmuc $danhmuc){
        // POSTEDIT này có trách nghiệm lưu thay đổi của người dùng vào trong database
        // request chứa các thông tin người dùng đã nhập sau khi sửa
        // danhmuc là chứa thông tin trước khi sửa
        $result = $this->danhmucService->edit($request, $danhmuc);
        return redirect()->back();
    }

    public function delete(Request $request){
        $result = $this->danhmucService->delete($request);
        if($result){
            // Kiểm tra nếu có dữ liệu thì không có lỗi, thông báo xóa thành công
            return response()->json([
               'error'=>'false',
               'message'=>'Xóa danh mục thành công'
            ]);
        }
        // Tại đây đưa ra lỗi (không có dữ liệu để xóa)
        return response()->json([
            'error'=>'true'
        ]);
    }

}
