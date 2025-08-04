{{-- Reject --}}
<div class="modal fade" id="product-reject-{{ $product->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-center">
                <h2 class="modal-title border-0"> Proceed to Rejection ? </h2>
            </div>
            <div class="modal-body">
                <h5>You are about to reject : {{ $product->title }} </h5>
                <p>Are you sure you want to proceed?</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.reject.product', $product->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto w-100">
                            <button type="button" class="btn btn-outline-primary fw-bold w-100"
                                data-bs-dismiss="modal">
                                No, Let me inspect again
                            </button>
                        </div>
                        <div class="col-auto w-100">
                            <button type="submit" class="btn btn-danger w-100">
                                Yes, proceed to reject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Approve --}}
<div class="modal fade" id="product-approve-{{ $product->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header bg-success text-center border-0">
                <h2 class="modal-title"> <i class="fa-regular fa-square-check"></i> Approval </h2>
            </div>
            <div class="modal-body">
                <h5>Approving product : {{ $product->title }} </h5>
                <p>Proceed?</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.approve.product', $product->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-primary fw-bold" data-bs-dismiss="modal">
                                No, Let me inspect again
                            </button>
                        </div>
                        <div class="col-auto w-100">
                            <button type="submit" class="btn btn-success">
                                Yes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
