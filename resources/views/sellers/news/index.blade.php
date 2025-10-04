@extends('layouts.app')

@section('title', 'News Manager')

@section('content')
    <form action="{{ route('seller.news.create') }}" method="get">
        @csrf
        <div class="row justify-content-center">
            <div class="col-auto">
                <h1>news</h1>
                <button type="submit" class="btn btn-outline-success">
                    Write News
                </button>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($seller_news as $news)
                            <tr>
                                <td>
                                    <div class="row">
                                    <div class="col-2">
                                        <img src="{{ $news->image }}" alt="{{ $news->headline }}" class="image-md">
                                    </div>
                                    <div class="col-7">
                                        <h3>{{ $news->headline }}</h3>
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('seller.news.edit', $news->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</form @endsection
