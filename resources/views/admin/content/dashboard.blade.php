@extends('admin.main')

@section('title', 'dashboard')
@section('content')

    <div class="home-stats">
        <div class="container text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            Total Members
                            <span>
									<a href="/admin/member">{{ $users }}</a>
								</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        <i class="fa fa-user-plus"></i>
                        <div class="info">
                            Pending Members
                            <span>
									<a href="/admin/member/">
										{{ $usersNoActive }}
									</a>
								</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        <i class="fa fa-tag"></i>
                        <div class="info">
                            Total Items
                            <span>
									<a href="/admin/item"> {{ $items }}</a>
								</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        <i class="fa fa-comments"></i>
                        <div class="info">
                            Total Comments
                            <span>
									<a href="comments.php">{{ $comments }}</a>
								</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i>
                            Latest 6 Registerd Users
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled latest-users">

                                @if (! empty($usersLatest))
                                    @foreach ($usersLatest as $userLatest)
                                        <li>
                                            {{ $userLatest->name }}
                                            <a href="/admin/member/{{ $userLatest->id }}/edit">
                                            <span class="btn btn-success pull-right">
                                            <i class="fa fa-edit"></i> Edit
                                                {{--<a href='members.php?do=Activate&userid=" UserID"' class='btn btn-info pull-right activate'>--}}
                                                    {{--<i class='fa fa-check'></i> Activate</a>--}}
                                            </span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest 6 Items
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled latest-users">
                                @if (! empty($itemsLatest))
                                    @foreach ($itemsLatest as $itemLatest)
                                        <li>
                                            {{ $itemLatest->name }}
                                            <a href="/item/{{ $itemLatest->id }}/edit">
                                                <span class="btn btn-success pull-right">
                                                <i class="fa fa-edit"></i> Edit
        {{--//                                       /**/ if ($item['Approve'] == 0) {--}}
                                                    {{--<a href='items.php?do=Approve&itemid=" . $item['Item_ID'] . "'--}}
                                                                {{--class='btn btn-info pull-right activate'>--}}
                                                                {{--<i class='fa fa-check'></i> Approve</a>--}}
        {{--//                                        }--}}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Latest Comments -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments-o"></i>
                            Latest 6 Comments
                            <span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
                        </div>
                        <div class="panel-body">
                                @foreach ($commentsLatest as $commentLatest)
                                    <div class="comment-box">
                                        <span class="member-n">
                                                @php
                                                    $user = \App\User::where('id', '=', $commentLatest->user_id)->get();
                                                @endphp
                                                <a href="/admin/member/{{ $commentLatest->user_id }}/edit">
                                                        {{ $user[0]->name }}
                                                    </a></span>
                                    <p class="member-c">
                                        {{ $commentLatest->comment }}
                                    </p>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Latest Comments -->
        </div>
    </div>


@endsection