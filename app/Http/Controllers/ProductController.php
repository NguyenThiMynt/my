<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create($id)
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2024',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'description' => 'required|max:255',
        ],
            [
                'name.required' => 'Name không được để trống',
                'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'image.required' => 'ảnh không được để trống',
                'image.image' => 'upload ảnh phải đứng định dạng',
                'image.mimes' => 'chỉ chấp nhận ảnh với đuôi .jpeg .png .jpg .gif',
                'image.max' => 'ảnh upload dung lượng không > 2M ',
                'price.required' => 'Nhập giá sản phẩm',
                'price.numeric'=>'giá được nhập phải là số',
                'quantity.required' => 'Nhập số luwongj sản phẩm',
                'description.required'=>'Mô tả sản phẩm không được để trống'
            ]);
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName =  time() . '_' .$image->getClientOriginalName();
            $image->move(public_path('uploads/product'), $imageName);
        }
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->price_sale=$request->sale;
        $product->save();

        return redirect('products/create')->with('message', 'Thêm sản phẩm thành công');

    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products/detail',compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products/edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate($request,[
            'name' => 'required|min:2|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2024',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'description' => 'required|max:255',
        ],
            [
                'name.required' => 'Name không được để trống',
                'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'image.required' => 'ảnh không được để trống',
                'image.image' => 'upload ảnh phải đứng định dạng',
                'image.mimes' => 'chỉ chấp nhận ảnh với đuôi .jpeg .png .jpg .gif',
                'image.max' => 'ảnh upload dung lượng không > 2M ',
                'price.required' => 'Nhập giá sản phẩm',
                'price.numeric'=>'giá được nhập phải là số',
                'quantity.required' => 'Nhập số luwongj sản phẩm',
                'description.required'=>'Mô tả sản phẩm không được để trống'
            ]);
        $imageName  = $product->image;
        if ($request->hasFile('image')) {
            @unlink(public_path('uploads/product' .  $imageName ));
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product'),  $imageName );
        }
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->price_sale=$request->sale;
        $product->save();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('products/list')->with('message', 'Xóa thành công');
    }
}
