
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#productAddSection" aria-expanded="false" aria-controls="productAddSection">
    <i class="fas fa-plus"></i>
    Add New Product
  </button>
</p>
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
    <label class="mb-0" for="cost">Product Cost (per - unit)</label>
    <input type="number" class="form-control" id="product-cost" name="product_cost" required="required">
</div>
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







 <div class="mb-4 shadow card border-left-primary">
<div class="col-md-9 col-sm-12 offset-md-0 offset-sm-0">
    <div class="card-body">
        <div class="card-body">
            <table id="all-user-table" class="display" style="width:100%">
                <thead>
                <tr>
                    <td>#</td>
                    <th>product: Name</th>
                    <th>Ingridients</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @for( $b=0; $b < $products->count(); $b++ )
             <tr>
                      <td>{{ $b }}</td>
                <td>{{ $products[$b]->product_name }} </td>
                <td>
                    <ul>
                    @foreach( $products[$b]->ingridients->pluck('ingridient_name') as $name )
                        <li>{{ $name }}</li>
                    @endforeach
                    </ul>
                </td>
                <td>{{ $products[$b]->product_cost }}</td>
                   <td>
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editIngridientModel-{{ $b }}">Edit</a>
            <button num="{{ $products[$b]->id }}" id="deleteIngridientButton-{{ $b }}" class="btn btn-sm btn-danger">Delete</button>
                    </td>
            </tr>
                    @endfor
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>

@endsection

@section('models')


@endsection

@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>

<script>

// $(document).ready(function() {
//     $("#add-product-form").validate({
//         rules: {
//             product_name : {
//                 required: true,
//             },
//         },
//            submitHandler: function(g) {

//            },
//     });
// });


  $(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
         var all_ingridients = $(".product-form").find( "input[name='all_ingridients']" ).val();
         all_ingridients = JSON.parse(all_ingridients);
        if(x < max_fields){ //max input box allowed
            x++; //text box incremen

               function optioning(){
                var noding = '';
                 for ( var i = 0; i < all_ingridients.length; i++ ) {
                    noding = noding + '<option value="'+all_ingridients[i].id+'">'+all_ingridients[i].ingridient_name+'</option>'
                    }
                    return noding;
               }
            var html = '  <div id="div-'+x+'" class="p-2 input-group"> '+
            ' <select name="ingridient[]" class="custom-select" id="inputGroupSelect01">' +
            optioning()+' </select>'+
 ' <input placeholder="weight in grams" name="amount[]" type="number" class="form-control" required="required" value="1">'+
'<a href="#" class="remove_field"> <i class="pl-2 fas fa-times-circle fa-2x text-danger"></i></a> </div>';
            $(wrapper).append(html); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove(); x--;
    });

        $(".product-form").on("submit", function(e){ //user click on remove text
            e.preventDefault();
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "The Data Will Be Saved!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, save it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      var input_groups = document.querySelectorAll('.input-group');
      var ingr = 0;
      var ingr_arr = [];
      var amount = 0;
      var ingr_amount = [];
      var product_name = $("input[name='product_name']").val();
      var product_cost = $("input[name='product_cost']").val();

      for (var i = 0; i < input_groups.length ; i++) {
       ingr =  $(input_groups[i]).find( "select[name*='ingridient']" ).val();
       amount =   $(input_groups[i]).find( "input[name*='amount']" ).val();
       ingr_amount.push({'ingridient':ingr, 'amount':amount});
       ingr_arr.push(ingr);
      }
             $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    type:'POST',
                        beforeSend: function(){
                         $("#defaultModelButton").click();
                    },
                    dataType : 'json',
                    url:"{{ route('product.store') }}",
                    data:{
                       ingr_amount:ingr_amount,
                       product_name:product_name,
                       ingr_arr:ingr_arr,
                       product_cost : product_cost,
                    },
                    success: function ( data ){
                         toastr.options = {
                            'closeButton': true,
                            'debug': false,
                            'newestOnTop': false,
                            'progressBar': false,
                            'positionClass': 'toast-top-right',
                            'preventDuplicates': false,
                            'showDuration': '1000',
                            'hideDuration': '1000',
                            'timeOut': '5000',
                            'extendedTimeOut': '1000',
                            'showEasing': 'swing',
                            'hideEasing': 'linear',
                            'showMethod': 'fadeIn',
                            'hideMethod': 'fadeOut',
                        }
                        if ( data.success ) {
                              Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your data has added',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function(){ location.reload(); }, 1000);
                        }else if ( data.error ) {
                            toastr.error( data.error[0] );
                            $('#defaultModelClose').click();
                        }else if ( data.test ) {
                             console.log( data.test )
                        }else{
                            $('#defaultModelClose').click();
                              toastr.warning('Something just went wrong please Try again');
                        }
                    }
                });

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {

  }
})


    });






});
</script>

     <script>
    $(document).ready(function() {
        var all_products = function (){
            $('#all-user-table').DataTable({
                responsive: true,
                autoWidth: true
            });
        }
        all_products();
});
         </script>


@endsection

