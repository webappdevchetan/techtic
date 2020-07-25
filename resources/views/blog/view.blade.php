@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blog Details</div>
                
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (Session::has('flash_error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('flash_error') }}
                </div>
                @endif
               
                <div class="card-body">
                    <h1>{{$blog->title}}</h1>
                    <p>{{$blog->description}}</p>
                    <img src="{{asset('/Blogs/'.$blog->image)}}" alt="{{$blog->title}}" width="400px"
                        class="pull-left img-responsive thumb margin10 img-thumbnail">
                    @if (\Auth::user())
                        <form action="{{url('blog/comment')}}" method="post" enctype="multipart/form-data" class="group">
                            {{ csrf_field() }}
                            <input type="hidden" name="blog_id" value="{{$blog->id}}" />
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
                <div class="card-footer">
                    @foreach ($blog->comment as $comment)
                        <div class="col=md-12">
                            <p>{{$comment->comment}}</p>
                            <label>By: {{$comment->user->name}}</label>
                            @if (\Auth::user() && $comment->user_id === \Auth::user()->id)
                                <button data-comment-id="{{$comment->id}}" class="btn btn-danger delete-comment">Delete</button>    
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            
            var url = "{{url('comment/delete')}}"
            $(".delete-comment").click(function(){
                var confirmation = confirm("Are you sure to delete");
                if(confirmation){
                    event.preventDefault();
                    var newForm = jQuery('<form>', {
                    'action': url+'/'+$(this).attr('data-comment-id'),
                    'method': "post",
                    });
                    newForm.append('@method("delete")')
                    newForm.append('@csrf')
                    newForm.appendTo('body')
                    newForm.submit();
                }
            })
                
        })
    </script>
@endpush
