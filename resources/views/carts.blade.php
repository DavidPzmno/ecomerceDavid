<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Ecommerce</h2>
                </div>
                <a href="{{ route('index') }}" class="btn btn-primary">prodotti</a>
                <div style="display: flex;align-items: center;justify-content: center;">
                    <i class="bi bi-cart" style="font-size:30px"></i><h3>Carrelli</h3>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>NPROD</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carts as $cart)
                <tr>
                    <td>{{ $cart->id }}</td>
                    <td>{{ $cart->name }}</td>
                    <td>{{ $cart->products->count() }}</td>
                    <td> <a href="{{ route('cart.delete',['id'=>$cart->id ]) }}" class="btn btn-danger">elimina</a>
                        <a href="{{ route('carts.edit',['id'=>$cart->id ]) }}" class="btn btn-secondary">modifica</a>
                        <a href="{{ route('carts.show',['id'=>$cart->id ]) }}" class="btn btn-info">mostra</a>
                    </td>
                    @empty
                <tr>
                    <td colspan="4">non sono presenti carrelli</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('cart.create') }}" class="btn btn-light">crea carrello</a>
    </div>
</body>

</html>