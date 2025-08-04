{{-- Edit Category --}}
<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header ">
                <h2 class="modal-title"> Editing '{{ $category->name }}' </h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.edit', $category->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $category->name }}">
            </div>
            @error('name')
                <p class="text-danger form-text">{{ $message }}</p>
            @enderror
            <div class="modal-footer border-0">
                <div class="row">
                    <div class="col-auto">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
