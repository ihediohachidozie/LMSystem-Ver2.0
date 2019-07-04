@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Catgeory</h1>
        <a href="{{route('category.create')}}" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
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
                            <th>Catgeory</th>
                            <th class="text-center">Approved Days</th>
                            <th class="text-center">Staff Count</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->category}}</td>
                                <td class="text-center">{{$category->days}}</td>
                                <td class="text-center">{{$category->users->count()}}</td>
                                <td class="text-center"><a href="{{ route('category.edit', ['category'=>$category]) }}"><i class="fas fa-edit" style="font-size:24px"></i></a></td>
                                <td class="text-center">
                                    <form action="{{ route('category.destroy', ['category'=>$category]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" {{ auth()->id() != 1 ? 'disabled' : ''}}>
                                        <i class="fas fa-trash" style="font-size:18px;color:red; border:0px;"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->render() }}
            </div>
        </div>
    </div>
        

@endsection