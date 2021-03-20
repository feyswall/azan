<div class="modal fade" id="addIngridientModel" tabindex="-1" role="dialog" aria-labelledby="addIngridientModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addIngridientModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- component -->
         <div class="p-3">
            <form method="POST" action="{{ route('ingridient.store') }}" id="addIngridientForm">
                @csrf
                <div class="form-group">
                    <label for="ingridient_name">Name <span></span></label>
                  <input name="ingridient_name" id="ingridient_name" class="form-control" placeholder="Enter email">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
         </div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div>

