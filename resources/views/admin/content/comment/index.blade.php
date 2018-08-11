@extends('admin.main')

@section('title', 'Manage Comment')
@section('content')
@if(empty($commment))
    <h1 class="text-center">Manage Comments</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>Comment</td>
                    <td>Item Name</td>
                    <td>User Name</td>
                    <td>Status</td>
                    <td>Added Date</td>
                    <td>Control</td>
                </tr>

                @foreach($comments as $comment)
                    <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->item->name }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>@if($comment->status == 1) Active @elseif($comment->status == 0) Disactive @endif</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                                <a href='/admin/comment/{{ $comment->id }}/edit' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                <a href='comments.php?do=Delete&comid=' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>
                        @if ($comment->status == 0)
                            <a href='comment/{{$comment->id}}/active' class='btn btn-info activate'>
                                                        <i class='fa fa-check'></i> Approve</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@else
            <div class="container">
                <div class="nice-message">There\'s No Comments To Show</div>
            </div>
@endif
@endsection