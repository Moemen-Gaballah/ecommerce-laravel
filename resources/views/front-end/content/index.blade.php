@extends('front-end.main')
@section('title', 'homepage')
@section('content')
    <div class="container">
        <div class="row">
        @foreach ($items as $item)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail item-box">
                    <span class="price-tag">{{ $item->price }}</span>
                    <img class="img-responsive" src="{{ asset('image/item/img.png') }}" alt="" />
                    <div class="caption">
                        <h3><a href="item/{{ $item->id }}">{{ $item->name }}</a></h3>
                        <p>{{ $item->description }}</p>
                        <div class="date">{{ $item->created_at }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection