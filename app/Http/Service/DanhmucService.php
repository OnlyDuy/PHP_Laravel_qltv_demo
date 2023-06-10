<?php

namespace App\Http\Service;
// Cần sửu dụng use này để lấy được Trường dữ liệu
use App\Models\Danhmuc;
use PHPUnit\Exception;


class DanhmucService
{
    // Tạo 1 class như này
    public function create($request)
    {
        // Gọi sang Create của Model
        try {
            Danhmuc::create([
                // Truyền các tham số của Bảng
                'TenDM' => (string)$request->input('TenDM'),
                'MaDM' => (string)$request->input('MaDM'),
                'MoTa' => (string)$request->input('MoTa'),
                'ViTri' => (string)$request->input('ViTri'),
            ]);
            Session()->flash('success', 'Thêm mới thành công');
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());
            return false;
        }
        return true;
    }

    public function getAll($filters = [], $keywords = null, $sortByArr = null)
    {
        $orderBy = 'danhmucs.TenDM';
        $orderType = 'DESC';

        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $danhmuc = Danhmuc::orderBy($orderBy, $orderType);
        
        // Kiểm tra xem liệu có bộ lọc được cung cấp hay không
        if (!empty($filters)) {
            
            // Áp dụng bộ lọc vào truy vấn
            // Ví dụ: Danhmuc::where('column', 'value')->paginate($perPage);
            // Thay 'column' và 'value' bằng các tùy chọn thực tế của bạn
            $danhmuc->where($filters)->paginate(3);
        }
        
        // Kiểm tra xem liệu có từ khóa tìm kiếm được cung cấp hay không
        if (!empty($keywords)){
            $danhmuc->where('TenDM', 'like', '%' . $keywords . '%')->paginate(3);
        }
        // Lấy ra toàn bộ dữ liệu
        //return Danhmuc::get();

        // Lấy ra dữ liệu và phân trang: lấy ra 4 bản ghi trong 1 trang
        // Không có bộ lọc, trả về toàn bộ dữ liệu được phân trang\
        if (session()->has('pageLimit')) {
            $setLimit = session()->get('pageLimit');
            $setLimit = intval($setLimit);
            $danhmuc = $danhmuc->paginate($setLimit)->withQueryString();
            //    return Danhmuc::orderBy('id','desc')->paginate($setLimit);
        }
        else {
            $danhmuc = $danhmuc->paginate(3)->withQueryString();
        }
        

        return $danhmuc;
    }

    public function edit($request, $danhmuc)
    {
        try {
            $danhmuc->MaDM = $request->input('MaDM');
            $danhmuc->TenDM = $request->input('TenDM');
            $danhmuc->MoTa = $request->input('MoTa');
            $danhmuc->ViTri = $request->input('ViTri');
            $danhmuc->save();
            Session()->flash('success', 'Sửa thông tin danh mục thành công');
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        // Truyền dữ liệu (tham số 1) và lấy giá trị (tham số 2) của đối tượng id được gọi đến
        $danhmuc = Danhmuc::where('id', $request->input('id'))->first();
        // nếu đối tượng tồn tại thì xóa
        if ($danhmuc) {
            return $danhmuc->delete();
        }
    }
}
