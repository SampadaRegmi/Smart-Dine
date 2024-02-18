<div class="page-header">
    {{-- show segment 2 as the title of bread cumb --}}
    <h1>{{ Str::ucfirst(Request::segment(2)) }}</h1>
    <small>Home / {{ Str::ucfirst(Request::segment(2)) }}</small>
</div>
