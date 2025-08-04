@extends('layouts.app')

@section('title', 'Register New Product')

@section('content')
    <style>
        .scroll {
            overflow-y: scroll;
        }
    </style>

    <form action="{{ route('seller.save.product') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="h1 mb-4">Register New Product</h3>
        <div class="col-10">
            <div class="mt-2 row">
                <div class="col-6">
                    <label for="cover_art" class="form-label fw-bold d-block">Cover Art</label>
                    <input type="file" name="cover_art" id="cover_art">
                    <div class="form-text">
                        Acceptable formats are jpeg, jpg, png, and gif <br>
                        Max file size is 1048kb
                    </div>
                    @error('cover_art')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="category" class="form-label fw-bold">Categories</label>
                    <div class="scroll" style="height: 150px">
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <input type="checkbox" name="category[]" id="{{ $category->id }}"
                                    value="{{ $category->id }}" class="form-check-input">
                                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('category')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2 row">
                <div class="col-6">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @error('title')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                    @error('price')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-2 row">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="0" rows="3" class="form-control"></textarea>
                @error('description')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary mt-4 w-100">Register Product</button>

        </div>
    </form>

@endsection
