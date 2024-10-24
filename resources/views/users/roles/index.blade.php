@extends('adminlte::page')

@section('title', 'Roles | Dashboard')

@section('content_header')
    <h1>Roles</h1>
@stop


@section('content')
   <div class="container-fluid">
       <div class="card">
           <div class="card-header">
               <div class="card-title">
                   <h5>List</h5>
               </div>
               <a class="float-right btn btn-primary btn-xs m-0" href="{{route('users.roles.create')}}"><i class="fas fa-plus"></i> Add</a>
           </div>
           <div class="card-body">
               <!--DataTable-->
               <div class="table-responsive">
                   <table id="tblroles" class="table table-bordered table-striped dataTable dtr-inline">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Name</th>
                               <th>Users</th>
                               <th>Permission</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                   </table>
               </div>
           </div>
       </div>
   </div>
@stop

@section('js')
<script src="{{ URL::asset('/js/users/roles/roles.js') }}"></script>

    <!-- Trigger SweetAlert2 for success message -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- Trigger SweetAlert2 for error message -->
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

@endsection
@section('plugins.Datatables', true)

