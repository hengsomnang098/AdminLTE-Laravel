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
                        <table id="tblPermissions" class="table table-bordered table-striped dataTable dtr-inline">
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
