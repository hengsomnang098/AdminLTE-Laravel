@extends('adminlte::page')

@section('title', 'Create Roles | Dashboard')

@section('content_header')
    <h1>Create Roles</h1>
@stop

@section('content')
   <div class="container-fluid">
        <form action="{{route('users.roles.store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <x-adminlte-input name="name" type="text" placeholder="EFor e.g. Manager" value="{{old('name')}}"/>
                    <!--DataTable-->
                    <div class="table-responsive">
                        <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="all_permission" name="all_permission">
                                        {{-- <x-adminlte-input type="checkbox"  name="all_permission" id="all_permission" label="All Permissions"/> --}}
                                    </th>
                                    <th>Name</th>
                                    <th>Guard</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Role</button>
                    {{-- <x-adminlte-button class="bg-gradient-info" type="submit" label="Save Role" icon="fas fa-lg fa-save"/> --}}
                </div>
            </div>
        </form>
   </div>
@endsection

@section('js')

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(document).ready(function(){
        //check uncheck all function
        $('[name="all_permission"]').on('click', function(){
            if($(this).is(":checked"))
            {
                $.each($('.permission'), function(){
                    if($(this).val()!="dashboard")
                    {
                        $(this).prop('checked', true);
                    }
                });
            }else{
                $.each($('.permission'), function(){
                    if($(this).val()!="dashboard")
                    {
                        $(this).prop('checked', false);
                    }
                });
            }
        });
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false, bPaginate:false, bFilter:false,
            ajax:"{{route('users.permissions.index')}}",
            columns:[
                {data:'chkBox', name:'chkBox', orderable:false, searchable:false, className:'text-center'},
                {data:'name', name:'name'},
                {data:'guard_name', name:'guard_name'},
            ],
            order:[[0, "desc"]]
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
