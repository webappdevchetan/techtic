@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-12 justify-content-end">
            <span>
            <a href="{{url('/blog/add')}}" class="btn btn-primary">Add Blog</a>
            </span>
        </div>
        @foreach ($blogs as $blog)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <a href="{{url('blog/detail').'/'.$blog->slug}}">
                        <h1>{{$blog->title}}</h1>
                        <img src="{{asset('/Blogs/'.$blog->image)}}" alt="{{$blog->title}}" width="100px" class="pull-left img-responsive thumb margin10 img-thumbnail">
                    </a>
                    </div>
                </div>
            
            </div>    
        @endforeach
        
    </div>
</div>
@endsection
