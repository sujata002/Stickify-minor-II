<!DOCTYPE html>
<html>
<head>
    <title>Your Billing History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f7;
            padding: 30px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .table thead th {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Your Billing History</h2>

        @if ($payments->isEmpty())
            <div class="alert alert-warning text-center">You have no payment history yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr class="text-center align-middle">
                                <td>{{ $index + $payments->firstItem() }}</td>
                                <td>{{ $payment->created_at->format('Y-m-d h:i A') }}</td>
                                <td>${{ number_format($payment->amount / 100, 2) }}</td>
                                <td>
                                    <span class="badge {{ $payment->status === 'succeeded' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($payment->payment_method ?? 'N/A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $payments->links() }}
            </div>
        @endif
    </div>

</body>
</html>