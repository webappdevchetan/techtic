@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($blogs as $blog)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{url('blog/detail').'/'.$blog->slug}}">
                        <h1>{{$blog->title}}</h1>
                        <img src="{{asset('/Blogs/'.$blog->image)}}" alt="{{$blog->title}}" width="100px"
                            class="pull-left img-responsive thumb margin10 img-thumbnail">
                    </a>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endsection