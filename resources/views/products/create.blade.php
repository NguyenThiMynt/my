@extends('layouts.main')
@section('title','Thêm sản phẩm')
@section('content')
    <style type="text/css">
        form{
            width: 100%;
            font-family: "Times New Roman";
        }
        .btn{
            padding: 10px 23px;
            margin-top: 10px;
            margin-left: 15px;
        }
    </style>
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center;">Add New Product</h3>
            </div>
            <div class="col-md-12">
                @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Lỗi</strong> Đã có lỗi xảy ra vui lòng kiểm tra <br>
                        <ul>
                            @foreach($errors->all() as $errors)
                                <li style="color: red;">{{ $errors}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <label>Name:</label>
                    <input class="form-control" type="text" name="name" placeholder="Please enter name">
                </div>
                <div class="col-md-12">
                    <label>Image_path:</label>
                    <input class="form-control" type="file" name="image" placeholder="Please enter image">
                </div>
                <div class="col-md-12">
                    <label>Price:</label>
                    <input class="form-control" type="number" name="price" placeholder="Please enter price">
                </div>
                <div class="col-md-12">
                    <label>Quantity:</label>
                    <input class="form-control" type="number" name="quantity" min="0" max="200" placeholder="Please enter quantity">
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control ckeditor" type="text" name="description" placeholder=""></textarea>
                </div>
                <div class="col-md-12">
                    <label>Price_Sale:</label>
                    <input class="form-control" name="sale" type="text" placeholder="Please enter sale price if available">
                </div>
                <div class="col-md-12">
                    <label>Product category</label>

                </div>
                <button class="btn btn-sm btn-success" type="submit">Add New</button>
                <button class="btn btn-sm btn-danger" >Cancel</button>
            </form>
        </div>
    @endsection
