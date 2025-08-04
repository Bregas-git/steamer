@extends('layouts.app')

@section('title', 'Product list')

@section('content')

    <div class="col-10">

        <h1>All Products</h1>

        <table class="table table-hover align-middle mt-3">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody class="">
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <a href="">
                                <img src="{{ $product->cover_art }}" alt="{{ $product->name }}" class="image-lg">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('seller.show.product', $product->id) }}" class="text-decoration-none">
                                <h5 class="display-6">{{ $product->title }}</h5>
                            </a>
                            <div class="form-text text-muted">
                                <span class="d-inline-block text-truncate" style="max-width: 300px">
                                    {{ $product->description }}
                                </span>
                                @forelse ($product->categoryProduct as $category_product)
                                    <div class="badge bg-primary pt-1 bg-opacity-75">
                                        {{ $category_product->category->name }}
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </td>
                        <td>
                            <p>$ {{ $product->price }}</p>
                        </td>
                        <td>
                            @if ($product->approval === 1)
                                <h5 class="text-secondary text-center">Waiting for Approval</h5>
                                <a href="">inspect</a>
                            @else
                                <h5 class="text-success text-center">Accepted</h5>
                            @endif
                        </td>
                    </tr>
                @empty
                    <h3 class="text-center text-secondary">No Products Yet</h3>
                    <a href="{{ route('seller.create.product') }}" class="text-primary text-decoration-none">Register a
                        product</a>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@endsection
