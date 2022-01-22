@extends('layouts.my')

@section('page-content')

  <div class="mb-4 shadow card">
                        <div class="row justify-content-start">
                            <div class="col-md-10 col-sm-12">
                                <div class="card-body">

  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#productAddSection" aria-expanded="false" aria-controls="productAddSection">
    <i class="fas fa-trash"></i>
    deleted Ingridients
  </button>
<div class="collapse" id="productAddSection">
  <div class="card card-body">
     <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="p-5 mb-4 shadow border-left-success">
                <div class="row justify-content-start">
                    <div class="col-md-12 col-sm-12">
                      <div class="alert alert-light" role="alert">
                        <span class="lead display-5 text-dark">Record Of Deleted Ingridients</span>
                      </div>
                        <table id='deletedIngredients' class="table" style="width: 100%;">
                          <thead>
                            <tr>
                              <th >#</th>
                              <th >Ingridint name</th>
                              <th >deleted_on</th>
                              <th >actin</th>
                            </tr>
                          </thead>
                          <tbody>

                              @foreach( $trashes as $trash )
                            <tr>
                              <td>{{ $trash->id }}</th>
                              <td>{{ $trash->ingridient_name }}</td>
                              <td>{{ $trash->deleted_at }}</td>
                              <td>
                          <button form="restore-{{ $trash->id }}" type="submit" class="btn btn-sm btn-success">
                           <i class="fas fa-undo-alt"></i>
                          </button>
                          <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                       <form id="restore-{{ $trash->id }}" method="GET" action='ingridient/retrieve/{{ $trash->id }}'>
                          @csrf
                          @method('GET')
                          
                       </form>

                              </td>
                            </tr>                                            
                            
                              @endforeach

                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>




                                    <div class="card-body">
                                      <div class="mb-3">
                                        <h3>Ingridients List</h3>
                                      </div>
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>ingr: Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for( $b=0; $b < $datas->count(); $b++ )
                                            <tr>
                                                <td>{{ $datas[$b]->id }}</td>
                                                <td>{{ $datas[$b]->ingridient_name }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editIngridientModel-{{ $b }}">Edit</a>
                                                    <button num="{{ $datas[$b]->id }}" id="deleteIngridientButton-{{ $b }}" class="btn btn-sm btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                            @endfor
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                   <button class="btn btn-primary" data-toggle="modal" data-target="#addIngridientModel">
                                                       <i class="fa fa-plus">Add Ingridient</i>
                                                   </button>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



@endsection

@section('models')
<!-- add ingrifient model -->
<x-models.add-ingridient></x-models.add-ingridient>
<!-- edit model -->
@for( $b=0; $b < $datas->count(); $b++ )
            <div class="modal fade" id="editIngridientModel-{{$b}}" tabindex="-1" role="dialog"
                 aria-labelledby="editIngridientModalLabel-{{$b}}"
                 aria-hidden="true">
                <div id="model-dialogue" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addIngridientModalLabel">Ready to Leave?</h5>
                            <button id="model-btn-{{$b}}" class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div id="edit-ing-model-{{$b}}" class="w-100" >
                              <!-- component -->
                              <div class="p-0 w-100">
                                  <form id="editIngridientForm-{{ $b }}" class="w-100">
                                      <div class="form-group">
                                          <label for="ingridient_name">ingridient name<span></span></label>
                                          <input value="{{ $datas[$b]->ingridient_name }}" name="ingridient_name" id="ingridient_name-{{$datas[$b]->id}}" class="form-control" placeholder="Enter Ingridient Name">
                                          <input type="hidden" value="{{ $datas[$b]->id }}" name="ingrId">
                                          <input type="hidden" value="{{ $b }}" name="formId">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                              </div>
                          </div>
                              <div class="row justify-content-center">
                                  <div class="col-md-12 col-sm-12">
                                      <div id="edit-ing-loader-{{ $b }}" style="display: none " class="text-center modal-body">
                                          <div class="loader1">
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endfor
    <!-- element counter very important -->
 <input type="hidden" value="{{ $datas->count() }}" id="allData">
@endsection

@section('customejs')
<script src="{{ asset("customejs/ingridient/add-ingridient.js") }}"></script>
<script src="{{ asset("customejs/ingridient/edit-ingridient.js") }}"></script>
<script src="{{ asset('customejs/ingridient/delete-ingridient.js') }}"></script>
<script>

    var allDataCountDelete = $('#allData').val();

    for ( var m=0; m < allDataCountDelete; m++ ){

        $('#deleteIngridientButton-'+m ).on('click', function (){
              console.log('here we go again')
        });
    }
</script>
     <script>
    $(document).ready(function() {
        $(function (){
            $('#example').DataTable({
                responsive: true,
                autoWidth: true
            });

             $('#deletedIngredients').DataTable({
                responsive: true,
                autoWidth: true
            });

        });
});
         </script>
@endsection

