<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;  
use Illuminate\Support\Facades\DB;  
use App\Models\User;  
use App\Models\Articles;

class DashboardController extends Controller  
{  
    public function index()  
    {  
        // 从缓存中获取数据，如果缓存不存在，则从数据库中获取并存储到缓存中  
        $totalUsers = Cache::remember('total_users', 60 * 24, function () {  
            return User::count();  
        });  
  
        $totalArticles = Cache::remember('total_articles', 60 * 24, function () {  
            return Articles::whereNull('deleted_at')->count();  
        });  
  
        /* 
        $totalDevices = Cache::remember('total_devices', 60 * 24, function () {  
            return Device::count();  
        });   
        */
  
        return view('manage-dashboard', [  
            'totalUsers' => $totalUsers,  
            'totalArticles' => $totalArticles,  
            #'totalDevices' => $totalDevices,  
        ]);  
    }  
}