@extends('layouts.app')

@section('title', 'My Store')

@section('content')

    <div class="col-10">

            <h1>Product List</h1>

        @can('seller')
            <a href="{{ route('seller.create.product') }}" style="width: 250px" class="btn btn-primary float-end d-inline">Register
                Product</a>
        @endcan

        <table class="table table-hover align-middle mt-3">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody class="">
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('seller.show.product', $product->id) }}">
                                <img src="{{ $product->cover_art }}" alt="{{ $product->name }}" class="image-lg">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('seller.show.product', $product->id) }}"
                                class="text-decoration-none d-inline-block text-truncate" style="max-width: 300px">
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
                                <span class="d-inline-block text-truncate" style="max-width: 300px">
                                    {{ $product->description }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <p>$ {{ $product->price }}</p>
                        </td>
                        <td class="text-center">
                            @if ($product->approval === 1)
                                <h5 class="text-secondary">Waiting for Approval</h5>
                                @can('admin')
                                    <a href="{{ route('seller.show.product', $product->id) }} ">Inspect</a>
                                @endcan
                            @elseif($product->approval === 3)
                                <h5 class="text-danger">Rejected</h5>
                                @if (Auth::user()->user_type === 3)
                                    <a href="{{ route('seller.edit.product', $product->id) }}">Edit product</a>
                                @endif
                            @else
                                <h5 class="text-success">Accepted</h5>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <h3 class="text-secondary">No Products Yet</h3>
                            <a href="{{ route('seller.create.product') }}"
                                class="text-primary text-decoration-none">Register a
                                product</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@endsection
