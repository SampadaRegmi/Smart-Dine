<div class="page-header">
    {{-- Check if the current route name is 'admin.pages.feedback' and show the title accordingly --}}
    @if(request()->route()->getName() === 'admin.pages.feedback')
        <h1>Feedback</h1>
        <small>Home / Feedback</small>
    @else
        {{-- show segment 2 as the title of breadcrumb for other pages --}}
        <h1>{{ Str::ucfirst(Request::segment(2)) }}</h1>
        <small>Home / {{ Str::ucfirst(Request::segment(2)) }}</small>
    @endif
</div>
