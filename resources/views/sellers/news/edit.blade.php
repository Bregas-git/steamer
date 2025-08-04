@extends('layouts.app')

@section('title', 'News Manager')

@section('content')

    <form action="{{ route('seller.news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-auto mb-4">
                <h1>Edit News</h1>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-5">
                    <label for="headline" class="form-label">Headline</label>
                    <input type="text" name="headline" id="headline" class="form-control"
                        placeholder="write the headline...">
                    @error('headline')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-5">
                    <label for="product_id" class="form-label">News type</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option value="">Announcement</option>
                        @foreach ($seller_products as $product)
                            <option value="{{ $product->id }}">{{ $product->title }} related</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-9">
                <input type="file" name="image" id="image" class="form-control">
                <div class="form-text small">Acceptable formats: jpeg, jpg, gif, png</div>
                @error('image')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <textarea name="content" id="content" cols="0" rows="10" class="form-control"
                        placeholder="your content here..."></textarea>
                    @error('content')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-10 mt-4 text-end">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">cancel</a>
                <button type="submit" class="btn btn-success w-25">
                    Submit
                </button>
            </div>
        </div>
    </form>



@endsection
