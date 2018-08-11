@extends('admin.main')

@section('title', 'Manage Categories')
@section('content')

<h1 class="text-center">Manage Categories</h1>
@if(!empty($categories))
<div class="container categories">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-edit"></i> Manage Categories
            <div class="option pull-right">
                <i class="fa fa-sort"></i> Ordering: [
                <a class="" href="?sort=asc">Asc</a> |
                <a class="" href="?sort=desc">Desc</a> ]
                <i class="fa fa-eye"></i> View: [
                <span class="active" data-view="full">Full</span> |
                <span data-view="classic">Classic</span> ]
            </div>
        </div>
        <div class="panel-body">
            @foreach($categories as $category)
                <div class='cat'>
                <div class='hidden-buttons'>
                    <a href='/admin/category/{{ $category->id }}/edit' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>

                        <form class="form-horizontal" action="{{ route('category.destroy', $category->id) }}" method="POST">

                            <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}

                            <input class="btn btn-danger confirm" type="submit" value="Delete">
                        </form>

                </div>
                <h3> {{ $category->name }}</h3>
                <div class='full-view'>
                    <p>
                        @if($category->description == '') This category has no description @else {{ $category->description }} @endif
                    </p>
                    @if( $category->visibility == 1) <span class="visibility cat-span"><i class="fa fa-eye"></i> Hidden</span>@endif
                    @if($category->allow_comment == 1) <span class="commenting cat-span"><i class="fa fa-close"></i> Comment Disabled</span> @endif
                    @if($category->allow_ads == 1) <span class="advertises cat-span"><i class="fa fa-close"></i> Ads Disabled</span> @endif
                </div>
                    <h4 class='child-head'>Child Categories</h4>
                    <ul class='list-unstyled child-cats'>
                        @foreach($childcategories as $cat)
                        @if($category->id == $cat->parent)
                        <li class='child-link'>
                            <a href='/admin/category/{{$cat->id}}/edit'>{{ $cat->name }}</a>

                            <form class="form-horizontal" action="{{ route('category.destroy', $cat->id) }}" method="POST">

                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}

                                <input class="btn btn-danger confirm" type="submit" value="Delete">
                            </form>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    <a class="add-category btn btn-primary" href="/admin/category/create"><i class="fa fa-plus"></i> Add New Category</a>
</div>
        @else
        <div class="container">
            <div class="nice-message">There\'s No Categories To Show</div>
            <a href="/admin/category/create" class="btn btn-primary">
                <i class="fa fa-plus"></i> New Category
            </a>
        </div>
        @endif
@endsection