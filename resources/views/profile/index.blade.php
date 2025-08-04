@extends('layouts.app')

@section('title', 'Category management')

@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="row">
                <div class="col-3 text-center">
                    @if ($user->profpic)
                        <img src="{{ $user->profpic }}" alt="{{ $user->name }}" class="rounded-circle image-lg">
                    @else
                        <i class="fa-regular fa-image icon-lg"></i>
                    @endif
                </div>
                <div class="col-9">
                    <h1 class="display-5 d-inline-block">{{ $user->name }}</h1>
                    @if ($user->user_type == 1)
                        <p class="text-secondary"><i class="fa-solid fa-user-tie"></i> admin</p>
                    @endif
                    <h5>E-mail : {{ $user->email }}</h5>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

@endsection
