@extends('admin.main')
@section('title', 'Edit Item')

@section('content')
<h1 class="text-center">Edit Item</h1>
<div class="container">
    <form class="form-horizontal" action="{{ route('item.update', $item->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-6">
                <input
                        type="text"
                        name="name"
                        class="form-control"
                        required="required"
                        placeholder="Name of The Item"
                        value="{{ $item->name }}" />
            </div>
        </div>
        <!-- End Name Field -->
        <!-- Start Description Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-6">
                <input
                        type="text"
                        name="description"
                        class="form-control"
                        required="required"
                        placeholder="Description of The Item"
                        value="{{ $item->description }}" />
            </div>
        </div>
        <!-- End Description Field -->
        <!-- Start Price Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10 col-md-6">
                <input
                        type="text"
                        name="price"
                        class="form-control"
                        required="required"
                        placeholder="Price of The Item"
                        value="{{ $item->price }}" />
            </div>
        </div>
        <!-- End Price Field -->
        <!-- Start Country Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-10 col-md-6">
                <input
                        type="text"
                        name="country"
                        class="form-control"
                        required="required"
                        placeholder="Country of Made"
                        value="{{ $item->country_made }}" />
            </div>
        </div>
        <!-- End Country Field -->
        <!-- Start Status Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10 col-md-6">
                <select name="status">
                    <option value="1" @if($item->status == 1) selected @endif> New</option>
                    <option value="2" @if($item->status == 2) selected @endif> Like New</option>
                    <option value="3" @if($item->status == 3) selected @endif> Used</option>
                    <option value="4" @if($item->status == 4) selected @endif>Very Old</option>
                </select>
            </div>
        </div>
        <!-- End Status Field -->
        <!-- Start Members Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Member</label>
            <div class="col-sm-10 col-md-6">
                <select name="member">

                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($item->member_id == $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <!-- End Members Field -->
        <!-- Start Categories Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10 col-md-6">
                <select name="category">
                    <option value="0">...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @foreach($childcategories as $childCategory)
                            @if($childCategory->parent == $category->id)
                                <option value="{{ $childCategory->id }}" @if($item->category_id == $childCategory->id) selected @endif >{{ $childCategory->name }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <!-- End Categories Field -->
        <!-- Start Tags Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10 col-md-6">
                <input
                        type="text"
                        name="tags"
                        class="form-control"
                        placeholder="Separate Tags With Comma (,)"
                        value="{{ $item->tags }}" />
            </div>
        </div>
        <!-- End Tags Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Save Item" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Submit Field -->
    </form>


{{--//    if (! empty($rows)) {--}}

    <h1 class="text-center">Manage Comments</h1>
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>Comment</td>
                <td>User Name</td>
                <td>Added Date</td>
                <td>Control</td>
            </tr>

{{--//            foreach(#comments as $comment) {--}}

                <tr>
                <td>comment</td>
                <td>Member</td>
                <td>comment_date</td>
                <td>
											<a href='comments.php?do=Edit&comid=' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
											<a href='comments.php?do=Delete&comid=' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>
{{--//                /**/if ($row['status'] == 0) --}}
                    <a href='comments.php?do=Approve&comid='class='btn btn-info activate'>
														<i class='fa fa-check'></i> Approve</a>
                </td>
                </tr>
            <tr>
        </table>
    </div>
</div>
			{{--// If There's No Such ID Show Error Message--}}
            <div class='container'>
				<div class="alert alert-danger">Theres No Such ID</div>
			</div>


@endsection