<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function avatar(Request $request)
    {
        //
        return view('manage-user-avatar');
    }

    public function avatarUpdate(Request $request)
    {
        //
        //Storage::disk('public')->put('abc.txt', 'Contents'); //创建文件，测试写入。
        $request->validate([  
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $file = $request->file('image');
        if (empty($file)) {  
            return redirect()->route('user.avatar.edit')
                ->with('error','图片不能为空！');
        }
        if ($request->hasFile('image')) {
            $path = $file->store('avatars', 'public');// 使用 store 方法存储文件，并自动生成唯一文件名
        }  
        //$path = $request->file('image')->store('avatars'); //随机命名
        //$path = $file->storeAs('avatars', Auth::user()->id); //按用户id命名
        $old_avatar = Auth::user()->avatar; //获取旧头像
        $uid = Auth::user()->id; //获取用户id
        $res = DB::table('users')
            ->where('id', $uid)
            ->update(['avatar' => $path]);
        if ($res) {
            if (!empty($old_avatar)) {
                Storage::disk('public')->delete($old_avatar);
            }
            return redirect()->route('user.avatar.edit')
                ->with('success','头像更新成功！');
        } else {
            return redirect()->route('user.avatar.edit')
                ->with('error','头像更新失败！');
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('manage-user-profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
