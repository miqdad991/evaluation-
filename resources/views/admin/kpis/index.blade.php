@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>📋 KPIs for: {{ $position->title }}</h4>

                @if ($kpis->isEmpty())
                    <a href="{{ route('admin.positions.kpis.create', $position) }}" class="btn btn-success">
                        ➕ Create KPIs
                    </a>
                @else
                    <a href="{{ url('admin/positions/' . $position->id . '/kpis/edit') }}" class="btn btn-primary">
                        ✏️ Edit KPIs
                    </a>
                @endif
            </div>

            <div class="card-body">
                @if ($kpis->isEmpty())
                    <div class="alert alert-info">No KPIs found for this position.</div>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>How to Measure</th>
                            <th>Target</th>
                            <th>Weight (%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kpis as $kpi)
                            <tr>
                                <td>{{ $kpi->name }}</td>
                                <td>{{ $kpi->how_to_measure }}</td>
                                <td>{{ $kpi->target }}</td>
                                <td>{{ $kpi->weight }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
