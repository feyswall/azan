
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
<div class="mb-4 shadow card">
    <div class="row justify-content-start">
        <div class="col-md-8 col-sm-12">
            <div class="card-body">
                <div class="card-body">
                   <x-models.all-users-table :datas="$datas"></x-models.all-users-table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('models')
<!-- model of this is found on components/models/edit-user.blade.php -->
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

