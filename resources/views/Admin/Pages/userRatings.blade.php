@extends('Admin.Layouts.Master')

@section('main-content')
    <title>User Reviews</title>
    <style>
        /* Style the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        /* Style table header */
        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: left;
        }
        
        /* Style table data */
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Menu Name</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews->sortByDesc('created_at') as $review)
                    <tr>
                        <td>
                            @php
                                $user = \App\Models\User::find($review->user_id);
                                echo $user ? $user->name : 'Unknown User';
                            @endphp
                        </td>
                        <td>
                            @php
                                $menu = \App\Models\Menu::find($review->menu_id);
                                echo $menu ? $menu->name : 'Unknown Menu';
                            @endphp
                        </td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
