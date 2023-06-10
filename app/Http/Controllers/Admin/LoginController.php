<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Resources\User as UserResource;
use Illuminate\Contracts\Session\Session;

class LoginController extends Controller
{
    //code here
    public function index()
    {
        return view('admin.login', [
            'title' => 'Trang đăng nhập'
        ]);
    }
    public function store(Request $request)
    {
        // Xử lý cho việc login
        // echo "Xử lý Login";

        //validation: bắt buộc phải nhập email, password
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        // Hiển thị lỗi

        // Xác thực email, password
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            //return view('admin.main');
            // echo "Đăng nhập thành công";
            // dd($request->input());
            return redirect()->route('admin');
        } {
            Session()->flash('error','Email hoặc mật khẩu không đúng');
            //echo "Đăng nhập thất bại";
            return redirect()->route('admin');
        }
    }
}
//echo "Đăng nhập thành công";
// Đầu tiến lấy được các cái input mà người dùng đã nhập
//dd($request->input());
// dừng tại vị trí câu lệnh này được gọi ra