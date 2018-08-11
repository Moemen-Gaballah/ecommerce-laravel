@extends('admin.main')

@section('title', 'Mange Categories')
@section('content')
<h1 class="text-center">Edit Category</h1>
<div class="container">
    <form class="form-horizontal" action="{{ route('category.update', $category->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" name="name" class="form-control" required="required" placeholder="Name Of The Category" value="{{ $category->name }}" />
            </div>
        </div>
        <!-- End Name Field -->
        <!-- Start Description Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" name="description" class="form-control" placeholder="Describe The Category" value="{{ $category->description }}" />
            </div>
        </div>
        <!-- End Description Field -->
        <!-- Start Ordering Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10 col-md-6">
                <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories" value="{{ $category->parent }}" />
            </div>
        </div>
        <!-- End Ordering Field -->
        <!-- Start Category Type -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Parent?</label>
            <div class="col-sm-10 col-md-6">
                <select name="parent">
                    <option value="0" @if($category->parent == 0) selected @endif> None</option>
                    @foreach($allCategories as $Cat)
                        <option value='{{ $Cat->id }}'
                        @if ($category->parent == $Cat->id) selected @endif >{{ $Cat->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- End Category Type -->
        <!-- Start Visibility Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10 col-md-6">
                <div>
                    <input id="vis-yes" type="radio" name="visibility" value="0"  @if ($category->visibility == 0) checked @endif  />
                    <label for="vis-yes">Yes</label>
                </div>
                <div>
                    <input id="vis-no" type="radio" name="visibility" value="1" @if ($category->visibility == 1) checked @endif />
                    <label for="vis-no">No</label>
                </div>
            </div>
        </div>
        <!-- End Visibility Field -->
        <!-- Start Commenting Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-6">
                <div>
                    <input id="com-yes" type="radio" name="commenting" value="0" @if ($category->allow_comment == 0) checked @endif />
                    <label for="com-yes">Yes</label>
                </div>
                <div>
                    <input id="com-no" type="radio" name="commenting" value="1" @if ($category->allow_comment == 1) checked @endif  />
                    <label for="com-no">No</label>
                </div>
            </div>
        </div>
        <!-- End Commenting Field -->
        <!-- Start Ads Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-6">
                <div>
                    <input id="ads-yes" type="radio" name="ads" value="0" @if ($category->allow_ads == 0) checked @endif  />
                    <label for="ads-yes">Yes</label>
                </div>
                <div>
                    <input id="ads-no" type="radio" name="ads" value="1" @if ($category->allow_ads == 1) checked @endif />
                    <label for="ads-no">No</label>
                </div>
            </div>
        </div>
        <!-- End Ads Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Save" class="btn btn-primary btn-lg" />
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>
@endsection