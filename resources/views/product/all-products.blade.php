@extends('layouts.my')

@section('links')

@endsection


@section('page-content')

  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#productAddSection" aria-expanded="false" aria-controls="productAddSection">
    <i class="fas fa-plus"></i>
    Add New Product
  </button>

<div class="collapse" id="productAddSection">
  <div class="card card-body">
   <div class="row">
      <div class="col-sm-12 col-md-12">
          <div class="p-5 mb-4 shadow border-left-success">
    <div class="row justify-content-start">
        <div class="col-md-8 col-sm-12">
            <form id="add-product-form" action="{{ route('product.store') }}" method="POST" class="product-form">
@csrf
<input type="hidden" name="all_ingridients" value="{{ $ingridients }}">

<div class="p-2 mb-2">
    <label class="mb-0" for="product-name">Product Name</label>
    <input  class="form-control" id="product-name" name="product_name" required="required">
</div>
<div class="p-2 mb-2">
    <label class="mb-0" for="product-cost">Product Cost (per - unit)</label>
    <input type="number" class="form-control" id="product-cost" name="product_cost" required="required">
</div>
                <label for="ingridient">Choose Ingridients</label>
<div id="div-0" class="input_fields_wrap">
       <div class="input-group">
   <select  name="ingridient[]" class="custom-select" id="inputGroupSelect01" required="required">
    @foreach( $ingridients as $ingridient )
    <option value="{{ $ingridient->id }}">{{ $ingridient->ingridient_name }}</option>
    @endforeach
  </select>
  <input name="amount[]" type="number" placeholder="weight in grams" class="form-control" value="1" required="required">
</div>
</div>
    <button class="mt-2 add_field_button btn btn-primary">Add More Ingridient</button>
<button class="mt-2 btn btn-primary" type="submit">submit</button>
            </form>
        </div>
    </div>
</div>
      </div>
  </div>
  </div>
</div>






<!--  all products table sectiion -->
 <div class="mb-4 shadow card border-left-primary">
<div class="col-md-9 col-sm-12 offset-md-0 offset-sm-0">
    <div class="card-body">
        <div id="product-table-div" class="card-body">
<!-- table loaded with jquery -->       
<div class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div> 
        </div>
    </div>
</div>
</div>





@endsection

@section('models')
@section('models')
<!-- add ingrifient model -->
<x-models.add-ingridient></x-models.add-ingridient>
<!-- edit model -->
@for( $b=0; $b < $products->count(); $b++ )
            <div class="modal fade" id="editProductModlel-{{$b}}" tabindex="-1" role="dialog"
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
                                <div class="alert alert-success" style="display: none;"><span id="success-{{ $b }}"></span></div>
                                  <form name="myForm-{{ $b }}" action="{{ route('product.update', $products[$b] ) }}" method="POST" id="editProductForm-{{ $b }}" class="w-100">
                                      <div class="form-group">
                                          <label for="product_name">product name<span></span></label>
                                          <input value="{{ $products[$b]->product_name }}" name="product" id="product-{{ $b }}" class="form-control" placeholder="Enter Ingridient Name">      
                                            <span class="text-danger" id="product_span-{{ $b }}"></span>                    
                                          <input type="hidden" value="{{ $products[$b]->id }}" name="product_id">
                                          <input type="hidden" value="{{ $products[$b] }}" name="product_object">
                                      </div>
                                      <button id="btnForm-{{ $b }}" type="button" class="btn btn-primary">Submit</button>
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
 <input type="hidden" value="{{ $products->count() }}" id="allData">
@endsection

@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>

<script src="{{ asset('customejs/product/add-product.js') }}"></script>



<script>
  let product_table;
  $(document).ready(function() {


       product_table = () => {
          $.ajax({
           url: '/all_products_table',
           type: 'get',
           dataType: 'html',
           success: function( msg ){
              $("#product-table-div").html( msg );
              $('#all-user-table').DataTable({
                responsive: true,
                autoWidth: true
            });

              /* implement deleting in the table */
              del_product();
           }
         });
      }


      /* products table data comming from here*/
       product_table();



      /* select the input carrying total number of elements */
      var product_count = document.querySelector('#allData').value;

        // for multiple form submission
        for( let i = 0; i < product_count.length; i++ ){

          // prevent the enter key from submiting the form
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              myFormLoggic();
            }
          });


           $('#btnForm-'+i ).on('click', function(event){
              event.preventDefault();
           //    myFormLoggic();
           //      });

           // let myFormLoggic = () => {
              // saving the button
              let btn = $(this);
              btn.attr('disabled', 'disabled')

              /* detecting the action of then form */
            var btn_form = $(this).parent();

            /* form action */
            var form_action = btn_form.attr('action');

            /* form method */
            var form_method = btn_form.attr('method');

             /* gathering your form inputs values */
            var form_product_value = btn_form.find("input[name=product]").val();
            var form_product_id = btn_form.find("input[name=product_id]").val();
            var form_product_object = btn_form.find("input[name=product_object]").val();

            $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                    
                });


            /* sending the ajax request to a controller */
          $.ajax({
              url: form_action,
              type: 'PATCH',
              dataType: 'json',
              data: {
                product_object: form_product_object,
                product: form_product_value,
              },
              success: function(data){
                 // var response_var = JSON.parse( response );
             if(data.error == "none"){
                handleError( data );
            }else{
                handleSuccess( data );
             }
            },
          });

           var handleError = ( data ) => {
           var element_span = $('#editProductForm-'+i ).find("span[id=product_span-"+i+"]");
           element_span.text( data.response.product[0] );
           btn.removeAttr('disabled');                  
                  }

            var handleSuccess = ( data ) => {
              let success_msg = $("#success-"+ i);
                success_msg.text( data.success+ " from '"+ data.old+"' to '"+ data.new +"'" );
                success_msg.parent().css({
                  display: 'block',
                });
           btn.removeAttr('disabled'); 
           /* reload the products table*/
           product_table();
                  }


                });
           
        }

     
  });
</script>


<script>

  let del_product = () => {
        /* select the input carrying total number of elements */
      var product_count = document.querySelector('#allData').value;

      /* selecting the delete button */
      for (let i = 0; i < product_count.length; i++) {
        let del_btn = $( "#deleteProductButton-" + i );

        del_btn.click(function(event) {
          event.preventDefault();

          /* selectiong the form to get the path */
          let del_form = $(this).attr("form");
          let del_form_element = $( "#"+del_form );
          let del_form_action = del_form_element.attr('action');
          

          Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.isConfirmed) {
                       /* sending the ajax request */
                  $.ajax({
                    url: del_form_action,
                    type: 'delete',
                    dataType: 'json',
                  })
                  .done(function( data ) {
                    console.log( data );
                    product_table()
                  })
                  .fail(function( ) {
                    console.log( "something went wrong" );
                  })
          }
          });
  

        });
      }
  } 
</script>





@endsection
