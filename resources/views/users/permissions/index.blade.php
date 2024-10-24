@extends('adminlte::page')

@section('title', 'Permissions | Dashboard')

@section('content_header')
    <h1>Permissions</h1>
@stop



@section('content')
   <div class="container-fluid">
    <div class="row">
        <div id="errorBox"></div>
        <div class="col">
            <form method="POST" action="{{route('users.permissions.store')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Add New</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Permission Name" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div> --}}
                        <x-adminlte-input name="name" type="text" placeholder="Enter Permission Name" value="{{old('name')}}"/>
                    </div>
                    <div class="card-footer">
                        {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                        <x-adminlte-button class=" bg-gradient-info" type="submit" label="Save" icon="fas fa-lg fa-save"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>List</h5>
                    </div>
                </div>
                <div class="card-body">
                    <!--DataTable-->
                    <div class="table-responsive">
                        <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Guard</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection


@section('js')
    <!-- Include your custom JS file -->
    <script src="{{ URL::asset('/js/users/permissions/permissions.js') }}"></script>

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
@stop




