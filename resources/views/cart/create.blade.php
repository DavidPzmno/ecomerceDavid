<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>



<div style="display: flex;align-items: center;justify-content: center;">
  <div>
    <h1>Crea carrello</h1>
    @if(count($errors))
    <div class="alert alert-danger">
      @foreach($errors->all() AS $error)
      <p>{{$error}}</p>
      @endforeach
    </div>
    @endif
    <div id="validation-errors">

    </div>
    <form id="cart-form">
      @csrf
      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Inserisci nome carrello">
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>SKU</th>
            <th>NAME</th>
            <th>PRICE</th>
            <th width="280px">Action</th>
          </tr>
        </thead>
        <br>
        <div style="display: flex;align-items: center;justify-content: center;">
                    <i class="bi bi-bag" style="font-size:30px"></i><h3>Prodotti</h3>
                </div>
                <br>
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
      <button type="button" class="btn btn-primary" id="buttonform">crea</button>
    </form>
  </div>
</div>

<script>
  $("form#cart-form #buttonform").on('click', function(evt) {
    evt.preventDefault();

    var products = [];

    $("input:checked").each(function() {

      products.push($(this).val());

    });

    $.ajax({
      type: 'POST',
      url: "{{ route('cart.store') }}",
      data: {
        _token: "<?php echo csrf_token() ?>",
        name: $('#name').val(),
        products: products
      },

      success: function(data) {
        window.location.href = "{{ route('carts') }}";
      },
      error: function(data) {
        $('#validation-errors').html('');
        $.each(data.responseJSON.errors, function(key, value) {
          $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
        });
      },
    });

  })
</script>