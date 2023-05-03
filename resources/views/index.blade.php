<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

</head>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleziona Carrello</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($carts->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>Nprod</th>
                        </tr>
                    </thead>
                    <br>
                    <div style="display: flex;align-items: center;justify-content: center;">
                        <i class="bi bi-cart" style="font-size:30px"></i>
                        <h3>Carrelli</h3>
                    </div>
                    <br>
                    <tbody>
                        @foreach ($carts as $cart)
                        <tr>
                            <td><input type="checkbox" class="checkbox" value="{{ $cart->id }}" id="prod_{{ $cart->id }}" name="prod_{{ $cart->id }}"></td>
                            <td>{{ $cart->id }}</td>
                            <td>{{ $cart->name }}</td>
                            <td>{{ $cart->products->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>non ci sono carrelli</p>
                <a href="{{ route('cart.create') }}" class="btn btn-light">crea carrello</a>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="confirmbuy">conferma acquisto</button>
            </div>
        </div>
    </div>
</div>

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
                    <td><button type="button" class="btn btn-warning buy" id="{{$product->id}}">compra</button></td>
                    @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

<script>


var cart = 0;
var product = 0;

    $(document).on('click', 'input[type="checkbox"]', function() {      
        $('input[type="checkbox"]').not(this).prop('checked', false);   
         cartId = $(this).val();
    });


    $('.buy').on('click', function() {

        $('.modal').show();
        productId = $(this).prop('id');

    });

    $('.close').on('click', function() {

        $('.modal').hide();

    });

    $("#confirmbuy").on('click', function(evt) {
        evt.preventDefault();

        $.ajax({
            type: 'POST',
            url: "{{ route('carts.addProduct') }}",
            data: {
                _token: "<?php echo csrf_token() ?>",
                cartId : cartId,
                productId : productId
            },

            success: function(data) {
                window.location.href = "{{ route('carts') }}";
            },
            error: function(data) {
               alert('errore durante l acquisto');
            },
        });

    });

</script>