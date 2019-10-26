@extends('layouts.main')
@section('title','Danh sách thể loại')
@section('content')
    <style type="text/css">
        .btn{
            margin-left: 10px;
        }
    </style>
        <div class="row px-5 mb-4">
            <div class="col-sm-6 px-0">
                <h3>List Category</h3>
            </div>
            <div class="col-sm-4">
                <form action="{{ route('productype.search') }}" method="get">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="search" name="keyword" value="{{ $keyword }}">
                        <span class="input-group-btn">
                             <button type="submit" class="btn btn-success">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-sm-2 px-0">
                <a class="btn btn-sm btn-primary float-right" href="{{route('productype.create')}}">Create new Category</a>
            </div>
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row px-5">
            <table class="table table-bordered " style="text-align: center;">
                <tr class="bg-light">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image_path</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                @foreach($productypes as $productype)
                    <tr>
                        <td class="align-middle">{{$productype->id}}</td>
                        <td class="align-middle">{{$productype->name}}</td>
                        <td class="align-middle">{{$productype->description}}</td>
                        <td class="align-middle">
                            @if(!empty($productype['image']))
                                <img src="{{ asset('uploads/' . $productype['image']) }}" width="80px"/>
                            @endif
                        </td>
                        <?php $category = ''?>
                        @foreach(config('dev.category') as $key => $value)
                            @if($key == $productype->category)
                                <?php $category = $value ?>
                            @endif
                            @endforeach
                        <td class="align-middle">{{$category}}</td>
                        <td class="align-middle">
                            <form action="#"  method="post">
                                <a class="btn btn-sm btn-success" href="{{route('productype.show',$productype->id)}}"><i class="fas fa-info-circle"></i> Show</a>
                                <a class="btn btn-sm btn-warning" href="{{route('productype.edit',$productype->id)}}"><i class="far fa-edit"></i> Edit</a>
                                <a class="btn btn-sm btn-danger" href="{{route('productype.delete',$productype->id)}}"><i class="fas fa-trash"></i> Delete</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {!! $productypes->links() !!}
        </div>
    @endsection
