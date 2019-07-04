@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
    
    </div>
    <div class="col-12">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Staff Id</th>
                        <th colspan="3" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->firstname}} {{ ' ' }} {{$user->lastname}}</td>
                            <td>{{$user->staff_id}}</td>
                            <td class="text-center"><a href="{{ route('users.edit', ['user'=>$user]) }}" class="btn btn-primary btn-circle"><i class="fas fa-edit" style="font-size:24px"></i></a></td>         
                            <td class="text-center">
                                <form action="{{ route('users.destroy', ['user'=>$user]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash" style="font-size:18px;color:white;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('users.update', ['user'=>$user]) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-circle">
                                        <input type="hidden" name="password" value="password">
                                        <i class="fas fa-cogs" style="font-size:18px;color:white;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->render() }}
        </div>
    </div>
            
@endsection