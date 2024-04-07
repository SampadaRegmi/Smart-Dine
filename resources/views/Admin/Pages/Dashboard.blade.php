@extends('Admin.Layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Generate Report
            </div>
            <div class="card-body">
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <select name="year" id="year" class="form-control">
                            @for ($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <select name="month" id="month" class="form-control">
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="capital">Capital:</label>
                        <input type="text" name="capital" class="form-control" id="capital" placeholder="Enter capital">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Display the generated reports in a table --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Generated Reports
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Total Users</th>
                            <th>Total Orders</th>
                            <th>Capital</th>
                            <th>Income</th>
                            <th>Profit or Loss</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn = 1 @endphp
                        @forelse ($reports as $report)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $report->year }}</td>
                            <td>{{ date('F', mktime(0, 0, 0, $report->month, 1)) }}</td>
                            <td>{{ $report->total_user}}</td>
                            <td>{{ $report->total_orders }}</td>
                            <td>{{ $report->capital }}</td>
                            <td>{{ $report->total_transaction }}</td>
                            <td>{{ $report->profit_or_loss }}</td>
                            <td>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No reports available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
