<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LoginLog;

class LoginLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //参数形式的代码
        //?keyword=xxx&category=xxx&user=xxx
        $ip = $request -> input('ip', '');    //关键字
        $user = $request -> input('user', auth()->user()->id);//用户ID 
        $thirtyDaysAgo = now()->subDays(7); //30天前的时间
        $loginlogs = DB::table('login_logs')  
        ->select('login_logs.*', 'users.name as user_name')  
        ->leftJoin('users', 'login_logs.user_id', '=', 'users.id')
        ->where('login_logs.login_at', '>=', $thirtyDaysAgo)  
        ->when($ip, function ($query) use ($ip) {
            $query->where('login_logs.ip_address', 'like', '%'.$ip.'%');  
        })  
        ->when($user, function ($query) use ($user) {  
            $query->where('login_logs.user_id', $user);  
        })
        ->orderBy('login_logs.id', 'desc')
        ->take(50) //只获取最新的50条记录
        ->get();
        return view('manage-loginlogs',  compact('loginlogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, LoginLog $loginlog)
    {
        $loginlog->delete();
            return redirect()->route('user.loginlog.index')
                ->with('success','删除操作成功！');
    }
}
