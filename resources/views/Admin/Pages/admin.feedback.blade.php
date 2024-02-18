@extends('Admin.Layouts.master')
@section('main-content')
<h1>Feedbacks</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->name }}</td>
                    <td>{{ $feedback->email }}</td>
                    <td>{{ $feedback->text }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
