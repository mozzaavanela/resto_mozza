@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@if (Session::has('message'))
<div class="alert alert-succes">
    {{Session::get('message')}}
</div>
@endif
        <form action="{{route ('category.store')}}" method="post">
            @csrf
            <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Food Category</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>

                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-primary">submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
    </div>
</div>
@endsection
