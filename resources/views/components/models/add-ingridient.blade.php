<div class="modal fade" id="addIngridientModel" tabindex="-1" role="dialog" aria-labelledby="addIngridientModalLabel"
aria-hidden="true">
<div id="model-dialogue" class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addIngridientModalLabel">Ready to Leave?</h5>
            <button id="model-btn-add" class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div id="add-ing-model" class="modal-body">
            <!-- component -->
         <div class="p-3">
            <form method="POST" action="{{ route('ingridient.store') }}" id="addIngridientForm">
                <div class="form-group">
                    <label for="ingridient_name">Ingridient Name <span></span></label>
                  <input name="ingridient_name" id="ingridient_name" class="form-control" placeholder="Enter Ingrident Name">
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

