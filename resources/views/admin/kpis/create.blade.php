@extends('layouts.admin')

@section('content')
    <div class="col-md-10 p-4" style="background: #f4f5f7">
        <h3 class="mb-4">➕ Add KPIs for: <strong>{{ $position->title }}</strong></h3>

        @if ($errors->has('total_weight'))
            <div class="alert alert-danger">{{ $errors->first('total_weight') }}</div>
        @endif

        <form action="{{ route('admin.positions.kpis.store', $position) }}" method="POST">
            @csrf

            <table class="table table-bordered" id="kpi-table">
                <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>How to Measure</th>
                    <th>Target</th>
                    <th>Weight %</th>
                    <th>🗑</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input name="kpis[0][name]" class="form-control" required></td>
                    <td><input name="kpis[0][how_to_measure]" class="form-control" required></td>
                    <td><input name="kpis[0][target]" class="form-control" required></td>
                    <td><input type="number" name="kpis[0][weight]" class="form-control weight-field" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">✖</button></td>
                </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-outline-primary mb-3" id="add-row">➕ Add KPI</button>

            <div class="mb-3">
                <strong>Total Weight:</strong> <span id="total-weight">0</span>%
            </div>

            <button type="submit" class="btn btn-success">💾 Save KPIs</button>
        </form>
    </div>

    <script>
        let rowIndex = 1;

        document.getElementById('add-row').addEventListener('click', function () {
            const row = document.querySelector('#kpi-table tbody tr').cloneNode(true);
            row.querySelectorAll('input').forEach((input, i) => {
                const name = input.getAttribute('name');
                const newName = name.replace(/\[\d+\]/, `[${rowIndex}]`);
                input.setAttribute('name', newName);
                input.value = '';
            });
            document.querySelector('#kpi-table tbody').appendChild(row);
            rowIndex++;
            updateTotalWeight();
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = document.querySelectorAll('#kpi-table tbody tr');
                if (rows.length > 1) {
                    e.target.closest('tr').remove();
                    updateTotalWeight();
                }
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('weight-field')) {
                updateTotalWeight();
            }
        });

        function updateTotalWeight() {
            let total = 0;
            document.querySelectorAll('.weight-field').forEach(input => {
                const value = parseFloat(input.value) || 0;
                total += value;
            });
            document.getElementById('total-weight').textContent = total;
        }

        updateTotalWeight(); // initial call
    </script>
@endsection
