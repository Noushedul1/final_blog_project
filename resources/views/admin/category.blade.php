@extends('admin.layouts.app')
@section('title')
    Category
@endsection
@php
    $page = 'Categories';
@endphp
@section('mainpart')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Category</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addcategoryModal">Add Category</button>
        </div>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> --}}
        <tbody>
            @foreach ($categories as $sl => $category )
            <tr>
                <td>{{ ++$sl }}</td>
                <td>{{ $category->name }}</td>
                <td>{!! $category->description !!}</td>
                <td>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#edit' .  $category->id . 'categoryModal' }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('category.destroy',['category'=>$category->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        {{-- <input type="submit" class="btn btn-sm btn-danger" value="delete"> --}}
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Edit Category Modal-->
            <div class="modal fade" id="{{ 'edit' . $category->id . 'categoryModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $category->name }}</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('category.update',['category'=>$category->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="modal-body">
                                <div class="form-group">
                                    <lable class="form-label">Category Name</lable>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Category Name" value="{{ $category->name }}">
                                    @error('name')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lable class="category_description">Category Description</lable>
                                    <textarea name="description" id="summernote1" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
                                    {{ $category->description}}
                                    </textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Update Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    <!-- Add Category Modal-->
    <div class="modal fade" id="addcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <lable class="form-label">Category Name</lable>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Category Name" value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <lable class="category_description">Category Description</lable>
                            <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
                            {{ old('description') }}
                            </textarea>
                            @error('description')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Add Category">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script_body')
    <script>
        @if (Session::has('createCategory'))
        toastr.options = {
            'progressBar' : true,
            'closeButton' : true
        }
        toastr.success("{{ Session::get('createCategory') }}",'Create',{timeOut:12000});
        @endif
        @if (Session::has('updateCategory'))
        toastr.options = {
            'progressBar' : true,
            'closeButton' : true
        }
        toastr.info("{{ Session::get('updateCategory') }}",'Update',{timeOut:12000 });
        @endif
        @if (Session::has('deleteCategory'))
        toastr.options = {
            'progressBar' : true,
            'closeButton' : true
        }
        toastr.error("{{ Session::get('deleteCategory') }}",'Delete',{ timeOut: 12000});
        @endif
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300
            });
            $('#summernote1').summernote({
                height: 300
            });
        });
    </script>
    @endpush
@endsection
