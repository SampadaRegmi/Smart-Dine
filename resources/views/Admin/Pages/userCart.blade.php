@extends('Admin.Layouts.Master')

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="table-container">
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>SN</th>
                        <th>User</th>
                        <th>Menu</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sn = 1; @endphp
                    @forelse ($cart as $item)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->menu->name}}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->sub_total }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No items in carts.</td>
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
