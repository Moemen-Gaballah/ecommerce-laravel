@include('admin.partials.header')
@include('admin.partials.navbar')
@include('admin.partials.messages')
<div class="container">
    @yield('content')
</div>

@include('admin.partials.footer')