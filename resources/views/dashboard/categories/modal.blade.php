<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="categoryForm">
            @csrf
            <input type="hidden" id="category_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="category_name"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="category_status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const modal = new bootstrap.Modal(document.getElementById('categoryModal'));

$('#addCategoryBtn').click(function () {
    $('#categoryForm').attr('action', "{{ route('admin.categories.store') }}");
    $('#categoryForm').find('input[name=_method]').remove();
    $('#category_name').val('');
    $('#category_status').val(1);
    modal.show();
});

$(document).on('click', '.edit-category', function () {
    let id = $(this).data('id');

    $('#categoryForm').attr(
        'action',
        "{{ url('admin/categories') }}/" + id
    );

    $('#categoryForm').append(
        '<input type="hidden" name="_method" value="PUT">'
    );

    $('#category_name').val($(this).data('name'));
    $('#category_status').val($(this).data('status'));

    modal.show();
});
</script>
@endpush
