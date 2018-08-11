@extends('front-end.main')
@section('title', 'homepage')
@section('content')
<h1 class="text-center">My Profile</h1>
<div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Information</div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li>
                        <i class="fa fa-unlock-alt fa-fw"></i>
                        <span>Login Name</span> : {{ $user->name }}
                    </li>
                    <li>
                        <i class="fa fa-envelope-o fa-fw"></i>
                        <span>Email</span> : {{ $user->email }}
                    </li>
                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Full Name</span> : {{ $user->fullname }}
                    </li>
                    <li>
                        <i class="fa fa-calendar fa-fw"></i>
                        <span>Registered Date</span> : {{ $user->created_at }}
                    </li>
                    <li>
                        <i class="fa fa-tags fa-fw"></i>
                        <span>Fav Category</span> :
                    </li>
                </ul>
                <a href="#" class="btn btn-default">Edit Information</a>
            </div>
        </div>
    </div>
</div>
<div id="my-ads" class="my-ads block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Items</div>
            <div class="panel-body">

                @if (! empty($myItems)) {
                    <div class="row">
                    @foreach ($myItems as $item) {
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail item-box">
                            @if ($item->status == 0)
                               <span class="approve-status">Waiting Approval</span>
                            @endif
                            <span class="price-tag">{{ $item->price }}</span>
                            <img class="img-responsive" src="img.png" alt="" />
                                <div class="caption">
                                    <h3><a href="item/{{ $item->id }}">{{ $item->name }}</a></h3>
                                    <p>{{ $item->description }}</p>
                                    <div class="date">{{ $item->created_at }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @else {
                    Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="my-comments block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Latest Comments</div>
            <div class="panel-body">

                @if (! empty($myComments))
                    @foreach ($myComments as $comment)
                        <p>{{ $comment->comment }}</p>
                    @endforeach
                @else
                    There\'s No Comments to Show
                @endif
            </div>
        </div>
    </div>
</div>
@endsection