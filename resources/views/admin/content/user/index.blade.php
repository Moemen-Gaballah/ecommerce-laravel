@extends('admin.main')

@section('title', 'Manage Memeber')
@section('content')

@if(!empty($users))
<h1 class="text-center">Manage Members</h1>
    <div class="table-responsive">
        <table class="main-table manage-members text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Avater</td>
                <td>Username</td>
                <td>Email</td>
                <td>Full Name</td>
                <td>Registered Date</td>
                <td>Control</td>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        @if (empty($user->image))
                                No Image
                        @else
                                <img src="{{ asset('image/user/'.$user->image) }}" alt='' />
                        @endif
                    </td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href='/admin/member/{{ $user->id }}/edit' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>

                        <form class="form-horizontal" action="{{ route('member.destroy', $user->id) }}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <input class="btn btn-danger confirm" type="submit" value="Delete">
                        </form>

                        @if ($user->regstatus == 0)
                            <a href='/admin/member/{{ $user->id }}/active' class='btn btn-info activate'>
                                <i class='fa fa-check'></i> Activate</a>
                        @endif
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
    <a href="/admin/member/create" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Member
    </a>
</div>
@else
    <div class="container">
        <div class="nice-message">There\'s No Members To Show</div>
        <a href="/admin/member/create" class="btn btn-primary">
                <i class="fa fa-plus"></i> New Member
        </a>
    </div>
@endif
@endsection