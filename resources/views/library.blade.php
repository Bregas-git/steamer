@extends('layouts.app')

@section('title', 'Library')

@section('content')
    your purchased games here
    <div class="row">
        @forelse ($transactions as $transaction)
            <div class="col-3">
                <div class="card p-3 mb-4">
                    <h3>{{ $transaction[0]->product->title }}</h3>
                    {{-- [0] is reffering to the first item in the group --}}
                    {{-- cover art --}}
                    <img src="{{ $transaction[0]->product->cover_art }}"
                        alt="{{ $transaction[0]->product->title }}" class="image-lg">{{-- title --}}
                    {{-- items owned --}}

                    <p>Owned {{ $transaction->count() }}</p>
                    @if($transaction->count() > 1 )
                    <button class="btn btn-primary btn-sm">gift it</button>

                    @endif

                </div>
            </div>
        @empty
        @endforelse
    </div>


@endsection
