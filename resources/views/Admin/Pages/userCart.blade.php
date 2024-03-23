@extends('Admin.Layouts.Master')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <table class="table table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Menu ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $cart)
                            <tr>
                                <td>{{ $cart->id }}</td>
                                <td>{{ $cart->user_id }}</td>
                                <td>{{ $cart->menu_id }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ $cart->price }}</td>
                                <td>{{ $cart->image }}</td>
                                <td>{{ $cart->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No items in carts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="back-btn">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-container {
            overflow-y: auto;
        }
    </style>
@endpush
