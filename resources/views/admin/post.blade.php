@extends('admin.layouts.app')
@section('title')
    Post
@endsection
@php
    $page = 'posts';
@endphp
@section('mainpart')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            {{-- @if (Session::has('createPost'))
            <h3 class="text-center text-success">
                {{ Session::get('createPost') }}
            </h3>
            @endif --}}
            <h4 class="card-title">Post</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addpostModal">Add post</button>
        </div>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Description</th>
                <th>Thumbnail</th>
                <th>Category Name</th>
                <th>Status</th>
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
            @foreach ($posts as $sl => $post )
            <tr>
                <td>{{ ++$sl }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->subtitle }}</td>
                <td>{!! $post->description !!}</td>
                <td>
                    <img src="{{ asset('images/post_thumbnails/'.$post->thumbnail) }}" alt="" height="100" width="100">
                </td>
                <td>
                    {{ $post->category->name }}
                </td>
                <td>
                    @if ($post->status == 1)
                    <span class="badge badge-success">
                        Active
                    </span>
                    @else
                    <span class="badge badge-danger">
                        Inactive
                    </span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#edit' .  $post->id . 'postModal' }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('post.destroy',['post'=>$post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Edit post Modal-->
            <div class="modal fade" id="{{ 'edit' . $post->id . 'postModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $post->title }}</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('post.update',['post'=>$post->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="modal-body">
                                <div class="form-group">
                                    <lable class="form-label">Post Title</lable>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter post Tile" value="{{ $post->title }}">
                                    @error('title')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lable class="form-label">Sub Title</lable>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" placeholder="Enter post subtitle" value="{{ $post->subtitle }}">
                                    @error('subtitle')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lable class="form-label category">Category</lable>
                                    <select name="category_id" id="" class="form-control">
                                        @foreach ($categories as $category)
                                        {{-- <option value="" selected disabled>Select Category</option> --}}
                                        <option value="{{ $category->id }}" @if ($category->id == $post->category_id)
                                            selected
                                        @endif>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lable class="post_description">Post Description</lable>
                                    <textarea name="description" id="summernote1" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">
                                    {{ $post->description}}
                                    </textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <lable class="form-label thumbnail">Thumbnail</lable>
                                    <input type="file" class="form-control" name="thumbnail">
                                    <input type="hidden" name="old_thumbnail" value="{{ $post->thumbnail }}">
                                    @error('thumbnail')
                                    <span class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="status" class="form-check-label">
                                    <input type="checkbox" name="status" value="1" id="status" @if ($post->status == 1)
                                    checked
                                    @endif>Status
                                </label>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Update post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    <!-- Add post Modal-->
    <div class="modal fade" id="addpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add post</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <lable class="form-label">Post Title</lable>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter post Tile" value="{{ old('title') }}">
                            @error('title')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <lable class="form-label">Sub Title</lable>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" placeholder="Enter post subtitle" value="{{ old('subtitle') }}">
                            @error('subtitle')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <lable class="form-label category">Category</lable>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                <option value="" selected disabled>Select Category</option>
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <lable class="form-label post_description">Post Description</lable>
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
                        <div class="form-group">
                            <lable class="form-label thumbnail">Thumbnail</lable>
                            <input type="file" class="form-control" name="thumbnail">
                            {{ old('thumbnail') }}
                            </textarea>
                            @error('thumbnail')
                            <span class="text-danger">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <label for="status" class="form-check-label">
                            <input type="checkbox" name="status" value="1" id="status">Status
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Add post">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script_body')
    <script>
        @if (Session::has('createPost'))
        toastr.options = {
            'progressBar': true,
            'closeButton': true
        }
        toastr.success("{{ Session::get('createPost') }}",'Create',{timeOut:12000});
        @endif
        @if (Session::has('updatePost'))
        toastr.options = {
            'progressBar' : true,
            'closeButton' : true
        }
        toastr.info("{{ Session::get('updatePost') }}",'Update',{timeOut: 12000});
        @endif
        @if (Session::has('deletePost'))
        toastr.options = {
            'progressBar' : true,
            'closeButtor' : true
        }
        toastr.error("{{ Session::get('deletePost') }}",'Delete',{timeOut:12000});
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
