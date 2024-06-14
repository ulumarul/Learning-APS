<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Top-up</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Wallet</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('wallet.topup') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" name="user_name" id="user_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="amount">Top-up Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Top-up</button>
    </form>

    <h2>Wallet Balances</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wallets as $wallet)
                <tr>
                    <td>{{ $wallet->user_name }}</td>
                    <td>${{ number_format($wallet->balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to Products</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
