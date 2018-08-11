@extends('front-end.main')
@section('title', 'category')

@section('content')
<div class="container">
    <h1 class="text-center">Show Category Items</h1>
    <div class="row">
        {{--@if(!empty($items))--}}
        @if ($items->count() > 0)
            @foreach ($items as $item)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail item-box">
                    <span class="price-tag">{{ $item->price }}</span>
                    <img class="img-responsive" src="{{ asset('image/item/img.png') }}" alt="" />
                        <div class="caption">
                        <h3><a href="/item/{{ $item->id }}">{{ $item->name }}</a></h3>
                        <p>{{ $item->description }}</p>
                        <div class="date">{{ $item->created_at }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else

            <div class="alert alert-info fade in">

                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <strong></strong> This Category Is Empty.

            </div>
        @endif
    </div>
</div>
@endsection