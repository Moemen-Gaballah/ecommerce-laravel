@extends('admin.main')
@section('title', 'Manage Item')

@section('content')
@if(!empty($items))
    <h1 class="text-center">Manage Items</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
                <tr>
                    <td>#ID</td>
                    <td>Item Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Adding Date</td>
                    <td>Category</td>
                    <td>Username</td>
                    <td>Control</td>
                </tr>
                @foreach($items as $item)
                <tr>

                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->category['name'] }}</td>
                    <td>{{ App\User::find($item->member_id)->name }}</td>

                    <td>
										<a href='/admin/item/{{ $item->id }}/edit' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>


                        <form class="form-horizontal" action="{{ route('item.destroy', $item->id) }}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <input class="btn btn-danger confirm" type="submit" value="Delete">
                        </form>

                        {{--<a href='/admin/item/{{ $item->id }}/delete' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>--}}
                    @if ($item->approve == 0)
                        <a href='item/{{ $item->id }}/active'
													class='btn btn-info activate'>
													<i class='fa fa-check'></i> Approve</a>
                    @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="/admin/item/create" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> New Item
        </a>
    </div>
@else
    <div class="container">
        <div class="nice-message">There\'s No Items To Show</div>
        <a href="/admin/item/create" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> New Item
            </a>
    </div>
@endif
@endsection