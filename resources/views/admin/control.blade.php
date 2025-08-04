@extends('layouts.app')

@section('title', 'Control Panel')

@section('content')

    <div class="col-10">
        <div class="row justify-content-center">
            <div class="col-auto">
                <a href="{{ route('admin.users.index') }}" class="btn btn-success py-3">
                    <i class="fa-solid fa-users icon-md mb-2"></i>
                    <h5>User Management</h5>
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.index.product') }}" class="btn btn-primary py-3">
                    <i class="fa-solid fa-scroll icon-md mb-2"></i>
                    <h5>Products Management</h5>
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary py-3">
                    <i class="fa-solid fa-tags icon-md mb-2"></i>
                    <h5>Category Management</h5>
                </a>
            </div>
        </div>
    </div>

@endsection
