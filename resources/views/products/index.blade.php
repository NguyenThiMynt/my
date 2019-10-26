@extends('layouts.main')
@section('title','Danh sách sản phẩm')
@section('content')
    <style type="text/css">
        .searchbar{
            margin-bottom: auto;
            margin-top: auto;
            height: 40px;
            background-color: #b1dfbb;
            border-radius: 20px;
            padding: 10px;
        }

        .search_input{
            color: white;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 20px;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_input{
            padding: 0px 0px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
        }

        .search_icon{
            height: 40px;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:white;
        }
    </style>
        <div class="row px-5 mb-4">
            <div class="col-sm-6 px-0">
                <h3>List of products</h3>
            </div>
            <div class="container col-sm-4 px-5 h-100">
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                        <input class="search_input" type="text" name="" placeholder="Search...">
                        <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 px-0">
                <a class="btn btn-sm btn-primary float-right" href="#">Create new product</a>
            </div>
        </div>
        <div class="row px-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-light" style="text-align: center;">
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Đăng bán</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->quantity}}</td>
                    <td>{{$category->description}}</td>
                    <
                @endforeach
                </tbody>
            </table>
        </div>
    @endsection
