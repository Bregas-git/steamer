@extends('layouts.app')

@section('title', 'View Product')

@section('content')

    <div class="col-10">
        <div class="row">
            <div class="col-3">
                <img src="{{ $product->cover_art }}" alt="{{ $product->name }}" class="img-fluid d-block">
            </div>
            <div class="col-8">
                <h1 class="display-5 d-inline">{{ $product->title }}</h1>

                <p class="text-small text-secondary">release date: {{ $product->created_at->toDateString() }}</p>
                <h3><span class="text-muted">Price: </span>{{ $product->price }}</h3>

                <div>
                    {{ $product->description }}
                </div>
            </div>
        </div>
        <hr>
        @can('admin')
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-danger fw-bold" data-bs-toggle="modal"
                    data-bs-target="#product-reject-{{ $product->id }}">
                    <i class="fa-regular fa-rectangle-xmark"></i> Reject
                </button>
                <button type="submit" class="btn btn-success fw-bold ms-2" data-bs-toggle="modal"
                    data-bs-target="#product-approve-{{ $product->id }}">
                    <i class="fa-regular fa-square-check"></i> Approve
                </button>
            </div>
            @include('admin.products.modals.approval')
        @endcan
        @can('seller')
            <a href="{{ route('seller.edit.product', $product->id) }}" class="btn btn-primary btn-sm w-25 float-end">
                Edit Product
            </a>
        @endcan
        @if (Auth::user()->user_type == 2)
            <div class="float-end">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">back</a>
                <button data-bs-toggle="modal" data-bs-target="#buy-product-{{ $product->id }}"
                    class="btn btn-primary">Buy</button>
                @include('modals.buy')
            </div>
        @endif

    @endsection
