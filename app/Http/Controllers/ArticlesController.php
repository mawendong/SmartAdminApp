<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;  
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Types;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        /* 
        //路由形式的代码
        //articles/keyword/{keyword}
        //articles/category/{category}
        //articles/user/{user}
        $keyword = $request -> keyword;    //关键字     
        $category = $request -> category;  //分类ID
        $user = $request -> user;          //用户ID 
        $articles = DB::table('articles')  
        ->select('articles.*', 'types.title as types_title')  
        ->leftJoin('types', 'articles.types_id', '=', 'types.id')  
        ->when($category, function ($query) use ($category) {  
            $query->where('articles.types_id', $category);  
        })  
        ->when($keyword, function ($query) use ($keyword) {  
            $query->where('articles.title', 'like', '%'.$keyword.'%');  
        })  
        ->when($user, function ($query) use ($user) {  
            $query->where('articles.users_id', $user);  
        })  
        ->orderBy('articles.id', 'desc')
        ->paginate(10);
        return view('manage-articles', compact('articles', 'keyword', 'category', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5); //分页显示 
        */

        //参数形式的代码
        //?keyword=xxx&category=xxx&user=xxx
        $keyword = $request -> input('keyword', '');    //关键字     
        $category = $request -> input('category', '');  //分类ID
        $user = $request -> input('user', '');          //用户ID 
        $articles = DB::table('articles')  
        ->select('articles.*', 'types.title as types_title')  
        ->leftJoin('types', 'articles.types_id', '=', 'types.id')
        ->whereNull('articles.deleted_at') // 排除软删除的记录
        ->when($category, function ($query) use ($category) {  
            $query->where('articles.types_id', $category);  
        })  
        ->when($keyword, function ($query) use ($keyword) {  
            $query->where('articles.title', 'like', '%'.$keyword.'%');  
        })  
        ->when($user, function ($query) use ($user) {  
            $query->where('articles.users_id', $user);  
        })  
        ->orderBy('articles.id', 'desc')
        ->paginate(10)->appends(['keyword' => $keyword, 'category' => $category, 'user' => $user]);
        return view('manage-articles',  compact('articles', 'keyword', 'category', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5); //分页显示 
    }

    public function softindex(Request $request)
    {
        //?keyword=xxx&category=xxx&user=xxx
        $keyword = $request -> input('keyword', '');    //关键字     
        $category = $request -> input('category', '');  //分类ID
        $user = $request -> input('user', '');          //用户ID 
        $articles = DB::table('articles')  
        ->select('articles.*', 'types.title as types_title')  
        ->leftJoin('types', 'articles.types_id', '=', 'types.id')
        ->whereNotNull('articles.deleted_at') // 仅显示软删除的记录
        ->when($category, function ($query) use ($category) {
            $query->where('articles.types_id', $category);  
        })  
        ->when($keyword, function ($query) use ($keyword) {  
            $query->where('articles.title', 'like', '%'.$keyword.'%');  
        })  
        ->when($user, function ($query) use ($user) {  
            $query->where('articles.users_id', $user);  
        })  
        ->orderBy('articles.id', 'desc')
        ->paginate(10)->appends(['keyword' => $keyword, 'category' => $category, 'user' => $user]);
        return view('manage-articles-softindex', compact('articles', 'keyword', 'category', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5); //分页显示 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $primaryTypes = types::where('parent_id', 2)->with('children')->get(); 
        return view('manage-articles-create',compact('primaryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:articles|max:200',
            'title' => 'required|max:200',
            'types_id' => 'required',
            'users_id' => 'required',
            'keywords' => 'nullable|max:200',
            'description' => 'nullable|max:500',
            'content' => 'required',
            'author' => 'nullable|max:200',
            'source' => 'nullable|max:200',
            'cover' => 'nullable|max:200',
            'status' => 'nullable',
            'views' => 'nullable',
            'likes' => 'nullable',
        ]);
        articles::create($request->all());
        return redirect()->route('articles.index')
            ->with('success','创建操作成功！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article)
    {
        //
        $primaryTypes = types::where('parent_id', 2)->with('children')->get(); 
        return view('manage-articles-show',compact('article','primaryTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        //
        $primaryTypes = types::where('parent_id', 2)->with('children')->get(); 
        return view('manage-articles-edit',compact('article','primaryTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        //
        $request->validate([
            'slug' => [  
                'required','string',
                Rule::unique('articles')->ignore($article),  
            ],  
            'title' => 'required|max:200',
            'types_id' => 'required',
            //'users_id' => 'required',
            'keywords' => 'nullable|max:200',
            'description' => 'nullable|max:500',
            'content' => 'required',
            'author' => 'nullable|max:200',
            'source' => 'nullable|max:200',
            'cover' => 'nullable|max:200',
            'status' => 'nullable',
            'views' => 'nullable',
            'likes' => 'nullable',
        ]);
        $article->update($request->all());
        return redirect()->route('articles.index')
            ->with('success','编辑操作成功！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Articles $article)
    {
        //真删除,如果请求中有 'force' 参数，则进行真删除
        if ($request->has('force')) { 
            $article->forceDelete();  
                return redirect()->route('articles.index')
                ->with('success','删除操作成功！');
        }
        
        //软删除  
        $article->delete();
            return redirect()->route('articles.index')
                ->with('success','删除操作成功！');
    }

    // 软删除文章 
    // 由于使用了SoftDeletes trait，这将执行软删除  
    public function softDelete(Articles $article)  
    {  
        $article->delete();  
        return redirect()->route('articles.index')
            ->with('success','删除操作成功！');
    }  
    
    // 真删除（强制删除）文章  
    // 这将绕过软删除并执行真删除  
    public function forceDelete(Articles $article)  
    {  
        $article->forceDelete(); 
        return redirect()->route('articles.softindex')
            ->with('success','永久删除操作成功！');
    }  
}
