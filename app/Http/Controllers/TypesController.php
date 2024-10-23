<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Types;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 获取所有一级菜单项  
        $primaryTypes = types::where('parent_id', 1)->with('children')->orderBy('sort', 'asc')->get();
        $category = $request -> input('category', '');  //分类ID
        $searchTypes = types::orderBy('parent_id', 'asc','sort', 'asc')->get();
        /*
        $types = DB::table('types')
        ->select('types.*', 'types.title as types_title')  
        //->leftJoin('types', 'types.parent_id', '=', 'types.id')  
        ->when($category, function ($query) use ($category) {  
            $query->where('types.parent_id', $category);
        })  
        ->orderBy('types.sort', 'asc','types.parent_id', 'asc')
        ->paginate();
        */
        if($category){
            $types = types::where('parent_id', $category)->orderBy('parent_id', 'asc','sort', 'asc')->paginate();
        }else{
            $types = types::where('parent_id',1)->orderBy('sort', 'asc','parent_id', 'asc')->paginate();
        } 
        return view('manage-types', compact('types', 'primaryTypes', 'searchTypes', 'category'))
            ->with('i', (request()->input('page', 1) - 1) * 5); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return view('manage-types-create');
        $primaryTypes = types::where('parent_id', 1)->with('children')->get(); 
        $types = types::oldest('sort')->paginate(100);
        return view('manage-types-create',compact('types','primaryTypes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'parent_id' => 'required|numeric',
            'sort' => 'required|numeric',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|max:500',
        ]);
        /* $path = null;  
        if ($request->hasFile('icon')) {  
            $file = $request->file('icon');  
            $path = $file->store('types', 'public'); // 存储文件并获取路径  
        }  */ 
        $path = $request->file('icon') ? $request->file('icon')->store('types', 'public') : null;
        $updateData = $validatedData;  
        if ($path === null) {  
            unset($updateData['icon']); // 或者你可以简单地不执行这行代码，因为 'icon' 可能根本不在 $request->all() 中  
            // 但由于我们是从 $validatedData 开始的，它总是包含 'icon' 键（值为 null），所以我们需要 unset 它  
        } else {  
            // 如果 $path 不是 null，则我们已经有了正确的 $updateData['icon'] 值  
            $updateData['icon'] = $path;  
        }  
        types::create($updateData); // 这将包含 'icon' 如果它有值，否则将忽略它（因为 'icon' 是 nullable 的） 
        return redirect()->route('types.index')
            ->with('success','创建操作成功！');
    }

    /**
     * Display the specified resource.
     */
    public function show(types $type)
    {
        //
        $primaryTypes = types::where('parent_id', 1)->with('children')->get(); 
        return view('manage-types-show',compact('type','primaryTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(types $type)
    {
        //
        $primaryTypes = types::where('parent_id', 1)->with('children')->get(); 
        return view('manage-types-edit',compact('type','primaryTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,types $type)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'parent_id' => 'required|numeric',
            'sort' => 'required|numeric',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
        ]);
        /* 
        $file = $request->file('icon');  
        if ($file) {  
            // 如果文件存在，则存储文件并获取存储路径  
            $path = $file->store('types', 'public');
        } else {  
            // 如果没有文件上传，则 $path 为 null  
            $path = null;  
        }
        */
        $path = $request->file('icon') ? $request->file('icon')->store('types', 'public') : null;
        $updateData = $validatedData;  
        if ($path === null) {  
            unset($updateData['icon']); // 或者你可以简单地不执行这行代码，因为 'icon' 可能根本不在 $request->all() 中  
            // 但由于我们是从 $validatedData 开始的，它总是包含 'icon' 键（值为 null），所以我们需要 unset 它  
        } else {  
            // 如果 $path 不是 null，则我们已经有了正确的 $updateData['icon'] 值  
            $updateData['icon'] = $path;  
        }  
        $type->update($updateData); // 这将包含 'icon' 如果它有值，否则将忽略它（因为 'icon' 是 nullable 的） 
        return redirect()->route('types.index')
            ->with('success','编辑操作成功！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(types $type)
    {
        //
        $type->delete();
        return redirect()->route('types.index')
            ->with('success','删除操作成功！');
    }
}
