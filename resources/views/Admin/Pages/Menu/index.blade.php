@extends('Admin.Layouts.Master')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <h2>Menu Table <a class="btn btn-success" href="{{ route('menu.create') }}">Create Menu</a></h2>
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th>Popular</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>FoodCategory </th>
                        <th>CourseCategory </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>{{ $menu->keywords }}</td>
                            <td>{{ $menu->status }}</td>
                            <td>{{ $menu->popular }}</td>
                            <td>
                                <img src="{{ asset($menu->image) }}" alt="Menu Image" height="50px">
                            </td>
                            <td>{{ $menu->price }}</td>
                            <td>{{ $menu->FoodCategory }}</td>
                            <td>{{ $menu->CourseCategory }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('menu.edit', $menu->id) }}" role="button">Edit</a>
                                <form action="{{ route('menu.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
