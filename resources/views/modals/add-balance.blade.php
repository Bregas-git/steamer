<div class="modal fade" id="add-balance-{{ Auth::user()->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title border-0"> Add Balance </h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.balance') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="balance" id="balance" class="form-control"
                        placeholder="add balance...">
            </div>
            @error('balance')
                <p class="text-danger form-text">{{ $message }}</p>
            @enderror
            <div class="modal-footer border-0">

                <div class="row">
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-primary fw-bold" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            Add Balance
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
