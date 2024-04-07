@extends('Admin.Layouts.Master')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <h2>Users Table <a class="btn btn-success" href="{{ route('user.create') }}">Create User</a></h2>
            <table class="table  table-striped table-inverse ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary pill" href="{{ route('user.edit', $user->id) }}"
                                    role="button">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
