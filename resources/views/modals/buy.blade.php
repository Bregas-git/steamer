<div class="modal fade" id="buy-product-{{ $product->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title border-0 text-secondary"> Adding <span class="text-white">"{{ $product->title }}"</span> to Cart </h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('buy.product', $product->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{ $product->cover_art }}" alt="{{ $product->name }}" class="image-sm">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                        <div class="col-auto">
                            {{ $product->title }}
                        </div>
                        <div class="col-auto">
                            $ {{ $product->price }}
                        </div>
                        <div class="col-auto">
                            <label for="amount" class="form-label">QTY</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="1"
                                style="width: 50px">
                        </div>
                    </div>

            </div>
            @error('amount')
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
                            Add to Cart
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
