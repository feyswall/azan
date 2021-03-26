
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
<div class="mb-4 shadow  p-5">
    <div class="row justify-content-start">
        <div class="col-md-8 col-sm-12">
            <form method="" action="" class="product-form">
                @csrf
<input type="hidden" name="all_ingridients" value="{{ $ingridients }}">

<div id="div-0" class="input_fields_wrap">
    <button class="add_field_button btn btn-primary mb-2">Add More Fields</button>
       <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">First and last name</span>
  </div>
   <select  name="ingridient[]" class="custom-select" id="inputGroupSelect01">
    @foreach( $ingridients as $ingridient )
    <option value="{{ $ingridient->id }}">{{ $ingridient->ingridient_name }}</option>
    @endforeach
  </select>
  <input name="amount[]" type="number" class="form-control">
</div>
</div>
<button class="btn btn-primary mt-2" type="submit">submit</button>
            </form>
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
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
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
            var html = '  <div id="div-'+x+'" class="input-group p-2"> '+
            ' <div class="input-group-prepend"> '+
            '  <span class="input-group-text" id="">First and last name</span>' +
            ' </div>' +
            ' <select name="ingridient[]" class="custom-select" id="inputGroupSelect01">' +
            optioning()
    +
 ' </select>'+
 ' <input name="amount[]" type="number" class="form-control">'+
'<a href="#" class="remove_field"> <i class="fas fa-times-circle fa-2x text-danger pl-2"></i></a> </div>';
            $(wrapper).append(html); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').remove(); x--;
    });

        $(".product-form").on("submit", function(e){ //user click on remove text
        e.preventDefault(); 
      var input_groups = document.querySelectorAll('.input-group');
      var ingr = 0;
      var amount = 0;
      var ingr_amount = [];
      for (var i = 0; i < input_groups.length ; i++) {
       ingr =  $(input_groups[i]).find( "select[name*='ingridient']" ).val(); 
       amount =   $(input_groups[i]).find( "input[name*='amount']" ).val();
       ingr_amount.push({'ingridient':ingr, 'amount':amount});
      }
        console.log( ingr_amount[0] )
    });
});
</script>

     <script>
    $(document).ready(function() {
        var manageUsersTable = function (){
            $('#users-table').DataTable({
                responsive: true,
                autoWidth: true
            });
        }
        manageUsersTable();
});
         </script>


@endsection

