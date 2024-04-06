<div>
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #c6c2c2;
        }
    </style>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No.</th>
                <th>User</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
                <th>Fine</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $item)
            <tr class="text-center {{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'table-danger' : 'table-success') }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user ? $item->user->username : 'User Not Found' }}</td>
                <td>{{ $item->book ? $item->book->title : 'Book Not Found' }}</td>
                <td>{{ $item->rent_date }}</td>
                <td>{{ $item->return_date }}</td>
                <td>{{ $item->actual_return_date }}</td>
                <td>Rp.{{ number_format($item->calculateFine(), 0, ',', '.') }}</td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</div>
