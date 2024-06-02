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
                <div class="card-header">All Category
                        <span class="float-right">
                            <a href="{{ route('category.create') }}">
                                <button class="btn btn-outline-secondary">add category</button>
                            </a>
                        </span>
                </div>

                <div class="card-body">
                   {{-- @foreach ($cate as $item)
                       <p>{{$item->name}}</p>
                   @endforeach --}}
                   <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">no</th>
                            <th scope="col">name</th>
                            <th scope="col">edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($cate)>0)
                        @foreach($cate as $key=>$category)
                            <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="{{route('category.edit',[$category->id])}}"><button class="btn btn-outline-success">edit </button></a>
                            </td>
                            <td>
                                <a href="">
                                <form action="{{route('category.destroy',[$category->id])}}" method="post">
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
                   {{$cate->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
