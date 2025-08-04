@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <style>
        .products-scroll {
            overflow-y: scroll;
        }
    </style>
    <div class="col-10">

        <h1>Welcome, {{ $user->name }}</h1>

        <div class="row">
            <div class="col-auto">
                @if ($user->profpic)
                    <img src="{{ $user->profpic }}" alt="{{ $user->name }}" class="image-lg rounded-circle">
                @else
                    <i class="fa-regular fa-image icon-lg"></i>
                @endif

            </div>
            <div class="col-auto text-end">
                <h4 class="text-end text-secondary mb-0">Balance: <span class="text-white">$
                        {{ $user->wallet->balance ?? '0' }}</span></h4>
                <button data-bs-toggle="modal" data-bs-target="#add-balance-{{ Auth::user()->id }}"
                    class="btn btn-border-0 text-primary">
                    Add balance
                </button>
            </div>
        </div>
        <hr>
        {{-- BUYER --}}
        @if ($user->user_type == 2)
            <div class="row my-3">
                <h2 class="fw-bold">New Releases</h2>
                <table class="table table-hover align-middle mt-3">
                    <div style="products-scroll" style="height: 800px">
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('seller.show.product', $product->id) }}">
                                            <img src="{{ $product->cover_art }}" alt="{{ $product->name }}"
                                                class="image-lg">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('seller.show.product', $product->id) }}"
                                            class="text-decoration-none d-inline-block text-truncate"
                                            style="max-width: 500px">
                                            <h5 class="h2">{{ $product->title }}</h5>
                                        </a>
                                        <div class="col">
                                            @forelse ($product->categoryProduct as $category_product)
                                                <div class="badge bg-primary pt-1 bg-opacity-75">
                                                    {{ $category_product->category->name }}
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <div class="form-text text-muted">
                                            <span class="d-inline-block text-truncate" style="max-width: 500px">
                                                <p>{{ $product->description }}</p>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="h5 text-muted">$ {{ $product->price }}</p>
                                    </td>
                                    @if ($product->approval === 1)
                                        <td class="text-center">
                                            Coming Soon!
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <div class="col mb-2">
                                                <a href="{{ route('seller.show.product', $product->id) }}"
                                                    class="btn btn-outline-primary">Check</a>
                                            </div>
                                            {{-- <div class="col">
                                                <button type="submit" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#buy-product-{{ $product->id }}">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </button>
                                            </div> --}}
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <h3 class="text-center text-secondary">
                                            No Products Yet
                                        </h3>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </div>
                </table>
                @include('modals.buy')
            </div>

            {{-- SELLER --}}
        @elseif ($user->user_type == 3)
            <div class="row my-3">
                <h2 class="fw-bold">Sales statistics</h2>

            </div>
        @else
            {{-- ADMIN --}}
            <div class="row my-3">
                <h2 class="fw-bold">Action Required</h2>

            </div>
        @endif

    </div>
    {{-- {{ $products->links() }} --}}
    @include('modals.add-balance')
@endsection
