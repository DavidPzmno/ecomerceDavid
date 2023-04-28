<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>



<div style="display: flex;align-items: center;justify-content: center;">
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form id="products-form">
            @csrf
            <div class="form-group">
                <a href="{{ route('carts') }}" class="btn btn-secondary">indietro</a>
                <div style="display: flex;align-items: center;justify-content: center;">
                    <i class="bi bi-cart" style="font-size:30px"></i>
                    <h3>Carrello {{ $cart->name }}</h3>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>NAME</th>
                        <th>PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td><input type="checkbox" class="checkbox" value="{{ $product->id }}" id="prod_{{ $product->id }}" name="prod_{{ $product->id }}"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-danger" id="buttonform">rimuovi prodotto/prodotti</button>
        </form>
    </div>
</div>

<script>

    $('#buttonform').css('display', 'none');


    $('.checkbox').on('click', function() {

        var showDelete = false;

        $(".checkbox").each(function() {

            if ($(this).prop('checked') == true){ 

                showDelete = true;
               
            }
         
            if (showDelete == true){

                $('#buttonform').css('display', 'block');
            }

            else{

                $('#buttonform').css('display', 'none');
            }

        });



    });


    $("form#products-form #buttonform").on('click', function(evt) {
        evt.preventDefault();

        var products = [];

        $("input:checked").each(function() {

            products.push($(this).val());

        });

        $.ajax({
            type: 'POST',
            url: "{{ route('cart.removeProducts') }}",
            data: {
                _token: "<?php echo csrf_token() ?>",
                products: products
            },

            success: function(data) {
                window.location.href = "{{ route('carts') }}";
            },
            error: function(data) {
               alert('errore durante la cancellazione');
            },
        });

    })
</script>