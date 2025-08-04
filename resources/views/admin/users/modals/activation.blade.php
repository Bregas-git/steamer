{{-- Activate --}}
<div class="modal fade" id="activate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Activate {{ $user->name }}'s profile?</h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.activate', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto w-100">
                            <button type="button" class="btn btn-outline-primary fw-bold w-100"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-auto w-100">
                            <button type="submit" class="btn btn-primary w-100">
                                Activate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Deactivate --}}
<div class="modal fade" id="disable-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Deactivate {{ $user->name }}'s profile?</h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.deactivate', $user->id) }}" method="post">
                    @csrf
                    @method('Delete')
                    <div class="row">
                        <button type="button" class="btn btn-outline-primary fw-bold w-100" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger w-100">
                            Deactivate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Seller --}}
<div class="modal fade" id="seller-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-secondary">Switch <span class="text-white">{{ $user->name }}</span> user type to
                    <span class="text-white">Seller?</span>
                </h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.to.seller', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto w-100">
                            <button type="button" class="btn btn-outline-primary fw-bold w-100"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col-auto w-100">
                            <button type="submit" class="btn btn-primary w-100">
                                Switch to Seller
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
