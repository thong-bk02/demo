<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $profile = Profile::getProfile(Auth::user()->id);
            return view('profile', compact('profile'));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email']
        ];
        $profile = [
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday']
        ];
        try {
            Profile::upd($user, $profile, Auth::user()->id);
            return redirect()->route('profile')->with('success', 'Cập nhật thành công');
        } catch (Exception $ex) {
            return redirect()->route('profile')->with('failed', 'Lỗi sửa thông tin nhân viên !');
        }
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(ProfileRequest $request)
    {
        # Validation
        $request->validated();

        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("failed", "Mật khẩu cũ không khớp!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Mật khẩu đã thay đổi thành công!");
    }
}
