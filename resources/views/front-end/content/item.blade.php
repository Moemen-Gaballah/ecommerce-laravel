@extends('front-end.main')
@section('title', 'item')

@section('content')
    @if(!empty($item))
<h1 class="text-center">{{ $item->name }}</h1>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive img-thumbnail center-block" src="{{ asset('image/item/img.png') }}" alt="" />
        </div>
        <div class="col-md-9 item-info">
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->description }}</p>
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-calendar fa-fw"></i>
                    <span>Added Date</span> : {{ $item->created_at }}
                </li>
                <li>
                    <i class="fa fa-money fa-fw"></i>
                    <span>Price</span> : {{ $item->price }}
                </li>
                <li>
                    <i class="fa fa-building fa-fw"></i>
                    <span>Made In</span> : {{ $item->country_made }}
                </li>
                <li>
                    <i class="fa fa-tags fa-fw"></i>
                    <span>Category</span> : <a href="/category">{{ $item->category['name'] }}</a>
                </li>
                <li>
                    <i class="fa fa-user fa-fw"></i>
                    <span>Added By</span> : <a href="#">{{ $item->user['name'] }}
                        @php $user = \App\User::find($item->member_id); @endphp
                        {{ $user->name }}

                    </a>
                </li>
                <li class="tags-items">
                    <i class="fa fa-user fa-fw"></i>
                    <span>Tags</span> :
                    @php
                    $allTags = explode(",", $item->tags);


                    foreach ($allTags as $tag){
                        $tag = str_replace(' ', '', $tag);
                        $lowertag = strtolower($tag);
                        if (!empty($tag)) {
                            echo "<a href='tags/'.$lowertag>" . $tag . '</a>';
                        }
                    }
                    @endphp
                </li>
            </ul>
        </div>
    </div>
    <hr class="custom-hr">
    @if(Auth::check())
<!-- Start Add Comment -->
    <div class="row">
        <div class="col-md-offset-3">
            <div class="add-comment">
                <h3>Add Your Comment</h3>
                <form class="form-horizontal" action="{{ route('comment.store') }}" method="POST">
                {{ csrf_field() }}
                    <textarea name="comment" required></textarea>
                    <input class="btn btn-primary" type="submit" value="Add Comment">
                    <input class="btn btn-primary" type="hidden" name="item_id" value="{{ $item->id }}">
                </form>
            </div>
        </div>
    </div>
    @else
    <!-- End Add Comment -->
        <a href="/register"> Register/Login </a> To Add Comment
    @endif
    <hr class="custom-hr">

    @foreach ($comments as $comment)
    <div class="comment-box">
        <div class="row">
            <div class="col-sm-2 text-center">
                <img class="img-responsive img-thumbnail img-circle center-block" src="{{ asset('image/user/img.png') }}" alt="" />
                {{ $comment->user->name }}
            </div>
            <div class="col-sm-10">
                <p class="lead">{{ $comment->comment }}</p>
            </div>
        </div>
    </div>
    <hr class="custom-hr">
    @endforeach
</div>
@else
    <div class="container">
        <div class="alert alert-danger">There\'s no Such ID Or This Item Is Waiting Approval</div>
    </div>
@endif
@endsection