<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>@yield('title')</title>

		<link rel="stylesheet" href="{{ asset('front-end/layout/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('front-end/layout/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('front-end/layout/css/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ asset('front-end/layout/css/jquery.selectBoxIt.css') }}" />
		<link rel="stylesheet" href="{{ asset('front-end/layout/css/front.css') }}" />
	</head>
	<body>
	<div class="upper-bar">
		<div class="container">
			@if(Auth::check())
				<img class="my-image img-thumbnail img-circle" src="{{ asset('image/user/img.png') }}" alt="" />
				<div class="btn-group my-info">
					<span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						{{ Auth::user()->name }}
						<span class="caret"></span>
					</span>
					<ul class="dropdown-menu">
						<li><a href="/profile">My Profile</a></li>
						<li><a href="/newad">New Item</a></li>
						<li><a href="/profile">My Items</a></li>
						{{--<li><a href="/logout">Logout</a></li>--}}
						<li>
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</div>
			@else
				<a href="/register">
					<span class="pull-right">Login/Signup</span>
				</a>
			@endif
		</div>
	</div>
	<nav class="navbar navbar-inverse">
	  <div class="container">
	    <div class="navbar-header">
	      <button 
	      		type="button" 
	      		class="navbar-toggle collapsed" 
	      		data-toggle="collapse" 
	      		data-target="#app-nav" 
	      		aria-expanded="false">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">Homepage</a>
	    </div>
	    <div class="collapse navbar-collapse" id="app-nav">
	      <ul class="nav navbar-nav navbar-right">
			  @php $allCats = \App\Category::where('parent', '=', '0')->orderBy('id', 'DESC')->get() @endphp

				@foreach($allCats as $cat)
			 	 <li>
					<a href="/category/{{ $cat->id }}">
						{{ $cat->name }}
					</a>
				</li>
			  @endforeach
	      </ul>
	    </div>
	  </div>
	</nav>