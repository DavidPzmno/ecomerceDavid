<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Ecommerce</h2>
                </div>
                <a href="{{ route('carts') }}" class="btn btn-secondary">carrelli</a>
                <div style="display: flex;align-items: center;justify-content: center;">
                 <i class="bi bi-bag" style="font-size:30px"></i>
                 <h3>Prodotti</h3>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td><a href="{{ route('carts') }}" class="btn btn-warning">compra</a></td>
                    @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>