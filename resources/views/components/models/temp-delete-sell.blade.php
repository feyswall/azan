<!-- default mode -->
<!-- Button trigger modal -->
<button style="display: none" >
    Launch demo modal
  </button>

<div id="tempSellModel" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="tempSellModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header" style="display: none;">
            <h5 class="modal-title" id="">Modal title</h5>
            <button id="tempSellModelClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    <div class="row justify-content-start">
      <div class="col-md-7">
              <form class="p-5 user" id="sell-product-form" method="POST" action="{{ route('sales.delete.fromto') }}">
                @csrf
                <h3>Delete Sell Records</h3>
                <div class="form-group">
                    <label for="from_date">{{ __('Name') }}</label>
                   <input type="date" name="from_date" class="form-control @error('from_date') is-invalid @enderror">
                     @error('from_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                     @enderror
                </div> 
                 <div class="form-group">
                  <label for="to_date">To</label>
                   <input type="date" name="to_date" class="form-control @error('to_date') is-invalid @enderror">
                       @error('to_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                     @enderror
                </div> 
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
             
      </div>
    </div>
    </div>
  </div>
</div>

