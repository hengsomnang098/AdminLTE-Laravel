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
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(document).ready(function(){
        var table = $('#tblroles').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false,
            ajax:"{{route('users.roles.index')}}",
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'users_count', name:'users_count', className:"text-center"},
                {data:'permissions_count', name:'permissions_count', className:"text-center"},
                {data:'action', name:'action', bSortable:false, className:"text-center"},
            ],
            order:[[0, "desc"]],
            bDestory:true,
        });
        $('body').on('click', '#btnDel', function(){
            //confirmation
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete Data "+id+"?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.isConfirmed)
                {
                    var route = "{{route('users.roles.destroy', ':id')}}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url:route,
                        type:"delete",
                        success:function(res){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                            $("#tblroles").DataTable().ajax.reload();
                        },
                        error:function(res){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: res.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                }else{
                    //do nothing
                }
            });
        });


    });
</script>

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

