
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
<div class="mb-4 shadow card">

</div>
@endsection

@section('models')

@endsection

@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>

<script>
    var allDataCountDelete = $('#allData').val();
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

