@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
                
            @endif
            <div class="card">
                <div class="card-header">All Category</div>

                <div class="card-body">
                   {{-- @foreach ($cate as $item)
                       <p>{{$item->name}}</p>
                   @endforeach --}}
                   <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                    </thead>
                    <tbody>
                        @if (count($foods)>0)
                        @foreach($foods as $key=>$food)
                            <tr>
                            <td> <img src="{{asset('image')}}/{{$food->image}}" width="100"></td>
                            <td>{{$food->name}}</td>
                            <td>{{$food->description}}</td>
                            <td>{{$food->price}}</td>
                            <td>{{$food->category_id}}</td>
                            <td>
                                <a href="{{route('category.edit',[$food->id])}}"><button class="btn btn-outline-success">edit </button></a>
                            </td>
                            <td>
                                <a href="">
                                <form action="{{route('category.destroy',[$food->id])}}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-outline-danger">delete </button>
                                </form>
                            </a>
                            </td>
                        </tr>
                        @endforeach                            
                        @else
                            <td>tidak ada kategory yng dapat di tampilkan .</td>
                        @endif
                        
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
