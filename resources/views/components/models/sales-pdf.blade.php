
<!-- Modal -->
<div class="modal fade" id="sellPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pdf Sales Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="p-5 user" id="sell-product-form" method="POST" action="{{ route('sales.pdf.fromto') }}">
                @csrf
                <h3>Select Sell Records</h3>
                <div class="form-group">
                    <label for="from_date">{{ __('From') }}</label>
                   <input type="datetime-local" name="from_date" class="form-control @error('from_date') is-invalid @enderror">
                     @error('from_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                     @enderror
                </div> 
                 <div class="form-group">
                  <label for="to_date">To</label>
                   <input type="datetime-local" name="to_date" class="form-control @error('to_date') is-invalid @enderror">
                       @error('to_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                     @enderror
                </div> 
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>