<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Category;
use function Sodium\compare;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        //phân trang
        $categories = Category::latest()->paginate(10);
        return view('Category.index', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('Category.create');
    }

    public function store(CategoryRequest $request)
    {
        $parent_id = $request->has('parent_id') ? 1 : 0;
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->taxonomy = $request->taxonomy;
        $category->parent_id = $parent_id;
        $category->save();
        return redirect('Category.index')->with('messages', 'Thêm thể loại thành công');

    }

    public function show($id)
    {
        $category = Category::find($id);
        return redirect('Category.detail', compact('category'));
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Category.edit', compact('category'));
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $this->validate($request, [
            'name' => 'required|unique:categories,name|min:3|max:100',

        ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự'

        ]);
        $category->name = $request->name;
        $category->save();
        return redirect('Category.edit')->with('message', 'Sửa thành công') ;
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('Category.index')->with('message', 'Xóa thành công');
    }

}
