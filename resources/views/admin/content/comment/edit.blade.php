@extends('admin.main')

@section('title', 'Manage Comment')
@section('content')

<h1 class="text-center">Edit Comment</h1>
<div class="container">

    <form class="form-horizontal" action="{{ route('comment.update', $comment->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">
        <!-- Start Comment Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-10 col-md-6">
                <textarea class="form-control" name="comment">{{ $comment->comment }}</textarea>
            </div>
        </div>
        <!-- End Comment Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Save" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>

@endsection