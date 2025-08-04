@extends('layouts.app')

@section('title', 'Category management')

@section('content')

    <h1>Users Management</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <table class="table table-hover">
                    <thead>
                        <th>#ID</th>
                        <th></th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Tools</th>
                    </thead>
                    <tbody>
                        @forelse ($all_users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    @if ($user->profpic)
                                        <img src="{{ $user->profpic }}" alt="{{ $user->name }}" class="image-md">
                                    @else
                                        <i class="fa-regular fa-image icon-md"></i>
                                    @endif
                                </td>
                                <td>
                                    <h5>{{ $user->name }}</h5>
                                    <p class="text-secondary small">{{ $user->email }}</p>
                                </td>
                                <td>
                                    @if ($user->user_type === 1)
                                        Admin
                                    @elseif ($user->user_type === 2)
                                        User
                                    @else
                                        Seller
                                    @endif
                                </td>

                                <td>
                                    @if (Auth::user()->id !== $user->id)
                                        <div class="dropdown">
                                            <button type="button" data-bs-toggle="dropdown"
                                                class="btn btm-sm text-primary">
                                                Change user role
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- @if ($user->user_type === \App\Models\User::ADMIN_USER_TYPE) --}}
                                                @if ($user->user_type === 1)
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#buyer-{{ $user->id }}">
                                                        to Buyer
                                                    </button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#seller-{{ $user->id }}">
                                                        to Seller
                                                    </button>
                                                @elseif($user->user_type === 2)
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#admin-{{ $user->id }}">
                                                        to Admin
                                                    </button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#seller-{{ $user->id }}">
                                                        to Seller
                                                    </button>
                                                @else
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#admin-{{ $user->id }}">
                                                        to Admin
                                                    </button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#buyer-{{ $user->id }}">
                                                        to Buyer
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" data-bs-toggle="dropdown" data-bs-target="#">

                                                </button>
                                            </div>

                                            @if ($user->trashed())
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#activate-user-{{ $user->id }}">
                                                    <i class="fa-solid fa-square-check"></i> Activate
                                                    {{ $user->name }}
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#disable-{{ $user->id }}">
                                                    <i class="fa-solid fa-circle-xmark"></i> Deactivate
                                                    {{ $user->name }}
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @include('admin.users.modals.activation')
                            @include('admin.users.modals.user-type')
                        @empty
                            <tr class="text-center">
                                <td colspan="5">
                                    <h3 class="text-secondary">
                                        No Users yet
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $all_users->links() }}
            </div>
        </div>
    </div>
@endsection
