@extends('layouts.app')

@section('title', 'Category management')

@section('content')

    <h1>Category Management</h1>
    <div class="container">
        <form action="{{ route('admin.categories.create') }}" method="post">
            @csrf
            <div class="input-group mb-3 w-50">
                <input type="text" name="name" id="name" class="form-control rounded-1"
                    placeholder="insert new category..." style="height: 50px">
                <div class="input-group-append">
                    <span class="input-group-text pt-2" style="height: 50px">
                        <button type="submit" class="btn">
                            <h5><i class="fa-solid fa-circle-plus"></i> Add new Category</h5>
                        </button>
                    </span>
                </div>
            </div>
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </form>
        <div class="row justify-content-center">
            <div class="col-8">
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Last Modified</th>
                        <th colspan="2" class="text-center">Tools</th>
                    </thead>
                    <tbody>
                        @forelse ($all_categories as $category)
                            <tr>
                                <td>
                                    <div class="badge bg-primary pt-2 bg-opacity-75 my-2 d-inline-block">
                                        <h5 class="">{{ $category->name }}</h5>
                                    </div>
                                    <div class="badge bg-secondary pt-2 bg-opacity-50 my-2">
                                        <h5>{{ $category->categoryProduct->count() }}</h5>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary">{{ $category->updated_at ?? '----' }}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#edit-category-{{ $category->id }}">
                                        <i class="fa-solid fa-pen icon-xsm text-primary"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#disable-category">
                                        <i class="fa-solid fa-circle-xmark icon-xsm text-danger"></i>
                                    </button>

                                </td>
                            </tr>
                            @include('admin.categories.modals.category-tools')
                        @empty
                            <h3 class="text-secondary">
                                No Category
                            </h3>
                        @endforelse
                    </tbody>
                </table>
                {{ $all_categories->links() }}
            </div>
        </div>
    </div>
@endsection
