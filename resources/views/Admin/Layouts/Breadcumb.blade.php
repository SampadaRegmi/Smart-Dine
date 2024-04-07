<div class="page-header">
    {{-- Check if the current route has a name --}}
    @if(request()->route())
        {{-- Extract the page name from the route --}}
        @php
            $routeName = request()->route()->getName();
            $pageName = explode('.', $routeName);
            $pageTitle = ucfirst(end($pageName));
        @endphp
        <h1>{{ $pageTitle }}</h1>
        <small>Home / {{ $pageTitle }}</small>
    @else
        {{-- Default header if route name is not available --}}
        <h1>Page Not Found</h1>
        <small>Home / Page Not Found</small>
    @endif
</div>
