@extends('layouts.app')

@section('title', 'Register New Product')

@section('content')
    <style>
        .scroll {
            overflow-y: scroll;
        }
    </style>

    <form action="{{ route('seller.update.product', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <h3 class="h1 mb-4">Edit Product</h3>
        <div class="col-10">
            <div class="mt-2 row">
                <div class="col-6">
                    <label for="cover_art" class="form-label fw-bold d-block">Cover Art</label>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="image-md">
                    <input type="file" name="cover_art" id="cover_art">
                    <div class="form-text">
                        Acceptable formats are jpeg, jpg, png, and gif <br>
                        Max file size is 1048kb
                    </div>
                    @error('cover_art')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6" style="height: 150px" class="scroll">
                    <label for="category" class="form-label fw-bold">Categories</label>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            @if (in_array($category->id, $selected_categories))
                                <input type="checkbox" name="category[]" id="{{ $category->id }}"
                                    value="{{ $category->id }}" class="form-check-input" checked>
                            @else
                                <input type="checkbox" name="category[]" id="{{ $category->id }}"
                                    value="{{ $category->id }}" class="form-check-input">
                            @endif
                            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('category')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2 row">
                <div class="col-6">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$product->title}}">
                    @error('title')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="number" name="price" id="price" class="form-control" value="{{$product->price}}">
                    </div>
                    @error('price')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-2 row">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="0" rows="3" class="form-control">{{$product->description}}</textarea>
                @error('description')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-4 w-100">Submit for Review</button>
        </div>
    </form>

@endsection

