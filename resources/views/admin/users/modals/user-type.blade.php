{{-- Admin --}}
<div class="modal fade" id="admin-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-secondary">Switch <span class="text-white">{{ $user->name }}</span> user type to <span
                        class="text-white">Admin?</span>
                </h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.to.admin', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto w-100">
                            <button type="button" class="btn btn-outline-primary fw-bold w-100"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-auto w-100">
                            <button type="submit" class="btn btn-primary w-100">
                                Switch to Admin
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Buyer --}}
<div class="modal fade" id="buyer-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-secondary">Switch <span class="text-white">{{ $user->name }}</span> user type to
                    <span class="text-white">Buyer?</span>
                </h5>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.to.buyer', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <button type="button" class="btn btn-outline-primary fw-bold w-100" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary w-100">
                            Switch to Buyer
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
