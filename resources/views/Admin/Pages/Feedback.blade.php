@extends('Admin.Layouts.Master')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->comment }}</td>
                            <td>{{ $feedback->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No feedbacks available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="back-btn">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .table-container {
                overflow-y: auto;
            }
        </style>
    @endpush
@endsection
