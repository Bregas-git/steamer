@extends('layouts.app')

@section('title', 'My Cart')

@section('content')

    <div class="col-10">
        <h1> <i class="fa-solid fa-cart-shopping"></i> My Cart</h1>
        <div class="col-auto text-end mt-2">
            <h2 class="text-end text-secondary mb-0">Balance: $ {{ Auth::user()->wallet->balance ?? '0' }}</h2>
            <button data-bs-toggle="modal" data-bs-target="#add-balance-{{ Auth::user()->id }}"
                class="btn btn-border-0 text-primary">
                Add balance
            </button>
        </div>
    </div>
    <div class="row my-3 justify-content-center">
        <div class="col-10">
            <form action="{{ route('cart.pay') }}" method="post">
                @csrf
                @method('PATCH')

                <table class="table table-hover align-middle mt-3">
                    <div style="products-scroll" style="height: 800px">
                        <thead>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <h5 class="text-secondary">QTY</h5>
                            </th>
                            <th>
                                <h5 class="text-secondary">total</h5>
                            </th>
                        </thead>
                        <tbody>
                            @forelse ($all_transactions as $transaction)
                                @if ($transaction->pay_status === 1 && $transaction->buyer_id === Auth::user()->id)
                                    <tr>
                                        <td>
                                            <a href="{{ route('seller.show.product', $transaction->product->id) }}">
                                                <img src="{{ $transaction->product->cover_art }}"
                                                    alt="{{ $transaction->product->name }}" class="image-lg">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('seller.show.product', $transaction->product->id) }}"
                                                class="text-decoration-none d-inline-block text-truncate"
                                                style="max-width: 500px">
                                                <h5 class="h2">{{ $transaction->product->title }}</h5>
                                            </a>
                                            <div class="col">
                                                @forelse ($transaction->product->categoryProduct as $category_product)
                                                    <div class="badge bg-primary pt-1 bg-opacity-75">
                                                        {{ $category_product->category->name }}
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                            <div class="form-text text-muted">
                                                <span class="d-inline-block text-truncate" style="max-width: 500px">
                                                    <p>{{ $transaction->product->description }}</p>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="h5 text-muted">$ {{ $transaction->product->price }}</p>
                                        </td>
                                        <td class="text-center">
                                            <h5> {{ $transaction->amount }} </h5>
                                        </td>
                                        <td class="text-center">
                                            <h5>$ {{ $transaction->total_price }}</h5>
                                        </td>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <h3 class="text-center text-secondary">Your cart is empty</h3>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </div>
                </table>
                <div class="text-end">
                    <h3 class="text-secondary">
                        Total Price : <span class="text-white"> $ {{ $total_price }} </span>
                    </h3>
                    @if ($total_price > (Auth::user()->wallet->balance ?? '0'))
                        <p class="text-danger xsmall">not enough balance!</p>
                    @endif
                </div>
                <div class="text-end">
                    <a href="{{ route('index') }}" class="btn btn-outline-secondary">Back</a>
                    @if ($total_price > (Auth::user()->wallet->balance ?? '0'))
                        <button class="btn btn-secondary"><i class="fa-solid fa-cash-register" disabled></i>
                            Make Payment
                        </button>
                    @else
                        <button class="btn btn-success"><i class="fa-solid fa-cash-register"></i>
                            Make Payment
                        </button>
                    @endif
                </div>
        </div>
    </div>
    </form>
    {{-- {{ $products->links() }} --}}
    @include('modals.add-balance')
@endsection
