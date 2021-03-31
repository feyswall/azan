<!-- default mode -->
<!-- Button trigger modal -->
<button style="display: none" >
    Launch demo modal
  </button>

<div id="sellModel" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="sellModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header" style="display: none;">
            <h5 class="modal-title" id="">Modal title</h5>
            <button id="sellModelClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    <div class="row justify-content-start">
      <div class="col-md-7">
              <form class="p-5 user" id="sell-product-form">
                <div class="form-group">
                  <label for="product"></label>
                    <select name="product" class="form-control" required>
                        <option selected='selected'> choose product...</option>
                        @foreach ( \App\Product::where('id', '>', '-2')->get() as $product )
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input name="total_amount" type="number" class="form-control form-control-user" id="total_amount"
                        placeholder="total product" required>
                </div>
                <div class="form-group">
                    <input name="received_amount" type="number" class="form-control form-control-user" id="receive_amount"
                        placeholder="paid product" required>
                </div>

                <div class="form-group">
                    <input name="who_buys" type="text" class="form-control form-control-user" id="who_buys"
                        placeholder="who buys" >
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    sold
                </button>
                <hr>
            </form>
      </div>
      <div class="col-md-4 mt-3">
        <h4>Your Stock Balance</h4>
        <ul>
          @foreach( App\Stock::all() as $stock )
                    @php
              $prod = App\Product::find( $stock->product_id );
                     @endphp
              <li>{{ $stock->amount }} - {{ $prod->product_name }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    </div>
  </div>
</div>

