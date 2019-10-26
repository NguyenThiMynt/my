<?php

namespace App\Http\Controllers;
use App\Productype;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductypeController extends Controller
{
    public function index(Request $request)
    {
        $query = Productype::select('*');
        $keyword = $request->keyword;
        if(!empty($keyword)){
            $query->where('name','like','%'.$keyword.'%');
        }
        $productypes = $query->paginate(10);
        //phân trang
        return view('productype.index', ['productypes' => $productypes, 'keyword' => $keyword]);
    }

    public function create(Request $request)
    {
        $id = $request->id;
        $data = [];
        if(!empty($id)){
            $data = Productype::find($id);
        }
        return view('productype.create', ['data' => $data]);
    }
    public function store(CategoryRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $id = $request->id;
        $data =['name' => $name, 'description' => $description, 'category' => $category];
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName =  time() . '_' .$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
        }
        if(!empty($imageName)){
            $data['image'] = $imageName;
        }
        if(!empty($id)){
            Productype::where('id', $id)->update($data);
        }else{
            Productype::insert($data);
        }
        return redirect('productype/list')->with('message', 'Thêm thể loạ thành công');

    }
    public function show($id)
    {
        $productype = Productype::find($id);
        return view('productype.detail', compact('productype'));
    }
    public function delete($id)
    {
        $productype = Productype::find($id);
        $productype->delete();
        return redirect('productype/list')->with('message', 'Xóa thành công');
    }

}
