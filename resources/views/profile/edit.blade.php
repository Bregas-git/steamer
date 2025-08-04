@extends('layouts.app')

@section('title', 'Category management')

@section('content')
    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="row">
                    <div class="col-3 text-center">
                        @if ($user->profpic)
                            <img src="{{ $user->profpic }}" alt="{{ $user->name }}" class="image-lg">
                        @else
                            <i class="fa-regular fa-image icon-lg"></i>
                        @endif
                        <input type="file" name="profpic" id="profpic" class="form-control">
                        <div class="form-text">
                            Accepted formats: jpg, jpeg, png, gif
                        </div>
                        @error('profpic')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-9">
                        <div class="col-auto mb-2">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $user->name }}">
                            @error('name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-auto mb-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $user->email }}">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="float-end">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
