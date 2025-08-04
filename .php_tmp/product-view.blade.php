@extends('layouts.app')

@section('title', 'View Product')

@section('content')

    <div class="col-10">
        <div class="row">
            <div class="col-auto">
                <img src="{{ $product->cover_art }}" alt="{{ $product->name }}" class="img-fluid d-block">
            </div>
            <div class="col-8">
                <h1 class="display-1 d-inline">{{ $product->title }}</h1>
                <a href="{{ route('seller.edit.product', $product->id) }}" class="btn btn-primary btn-sm mb-4">Edit Product</a>
                <p class="text-small text-secondary">release date: {{ $product->created_at->toDateString() }}</p>
                <h3><span class="text-muted">Price: </span>{{ $product->price }}</h3>

                <div>
                    {{ $product->description }}
                </div>
            </div>
        </div>


    @endsection
