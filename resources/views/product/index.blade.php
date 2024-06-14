<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('product.index') }}" class="mb-4">
        <div class="form-group">
            <label for="category">Filter by Category</label>
            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="MOBA">MOBA</option>
                <option value="FPS">FPS</option>
                <option value="RPG">RPG</option>
            </select>
        </div>
    </form>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Category: {{ $product->category }}</p>
                        <p class="card-text">
                            Price: ${{ number_format($product->price, 2) }}
                            @if($product->is_discounted)
                                <span class="badge badge-success float-right">{{ $product->discount_percentage }}% OFF</span>
                            @endif
                        </p>
                        <p class="card-text">Stock: {{ $product->stock }}</p>
                        <form action="{{ route('product.buy') }}" method="POST" class="mb-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Buy</button>
                        </form>
                        <form action="{{ route('product.wishlist') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-secondary">Add to Wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{ route('wallet.index') }}" class="btn btn-info">Top-up</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
