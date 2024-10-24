@extends('adminlte::page')

@section('title', 'Permissions | Dashboard')

@section('content_header')
    <h1>Edit Permissions</h1>
@stop


@section('content')
   <div class="container-fluid">
    <div class="row">
        <div id="errorBox"></div>
        <div class="col">
            <form method="POST" action="{{route('users.permissions.update',$permission->id)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Add New</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-adminlte-input id="name" name="name" type="text" placeholder="Enter Permission Name" value="{{$permission->name}}" />
                    </div>
                    <div class="card-footer">
                        <x-adminlte-button class=" bg-gradient-info" type="submit" label="update" icon="fas fa-lg fa-save"/>

                        <a href="{{route('users.permissions.index')}}">
                            <x-adminlte-button theme="warning" label="Cancel" icon="fas fa-lg fa-times" />
                        </a>
                    </div>
                </div>
            </form>
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

    {{-- <!-- Trigger SweetAlert2 for delete message -->
    @if(session('delete'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('delele') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif --}}
@stop




