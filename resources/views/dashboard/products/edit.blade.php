@extends('layouts.dashboard')
@section('content')
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Projects</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Projects</li>
                        <li class="breadcrumb-item">Edit Product</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne">
                                <i class="feather-bar-chart"></i>
                            </a>
                            <div class="dropdown">
                                <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                    data-bs-auto-close="outside">
                                    <i class="feather-filter"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-primary rounded-circle d-inline-block me-3"></span>
                                        <span>Alls</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-indigo rounded-circle d-inline-block me-3"></span>
                                        <span>On Hold</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                        <span>Pending</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                        <span>Finished</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-danger rounded-circle d-inline-block me-3"></span>
                                        <span>Declined</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-teal rounded-circle d-inline-block me-3"></span>
                                        <span>In Progress</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                        <span>Not Started</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                        <span>My Projects</span>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                    data-bs-auto-close="outside">
                                    <i class="feather-paperclip"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-filetype-pdf me-3"></i>
                                        <span>PDF</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-filetype-csv me-3"></i>
                                        <span>CSV</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-filetype-xml me-3"></i>
                                        <span>XML</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-filetype-txt me-3"></i>
                                        <span>Text</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-filetype-exe me-3"></i>
                                        <span>Excel</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="bi bi-printer me-3"></i>
                                        <span>Print</span>
                                    </a>
                                </div>
                            </div>
                            <a href="projects-create.html" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Prject</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
                <div class="accordion-body pb-2">
                    <div class="row">
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Not Started</span>
                                        <span class="fs-24 fw-bolder d-block">04</span>
                                    </a>
                                    <div class="pt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">
                                                <span>Invoices Awaiting</span>
                                                <i class="feather-link-2 fs-10 ms-1"></i>
                                            </a>
                                            <div>
                                                <span class="fs-12 text-muted">$5,569</span>
                                                <span class="fs-11 text-muted">(56%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 56%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">In Progress</span>
                                        <span class="fs-24 fw-bolder d-block">06</span>
                                    </a>
                                    <div class="pt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">
                                                <span>Projects In Progress</span>
                                                <i class="feather-link-2 fs-10 ms-1"></i>
                                            </a>
                                            <div>
                                                <span class="fs-12 text-muted">16 Completed</span>
                                                <span class="fs-11 text-muted">(78%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 78%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Cancelled</span>
                                        <span class="fs-24 fw-bolder d-block">02</span>
                                    </a>
                                    <div class="pt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">
                                                <span>Converted Leads</span>
                                                <i class="feather-link-2 fs-10 ms-1"></i>
                                            </a>
                                            <div>
                                                <span class="fs-12 text-muted">52 Completed</span>
                                                <span class="fs-11 text-muted">(63%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 63%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Finished</span>
                                        <span class="fs-24 fw-bolder d-block">25</span>
                                    </a>
                                    <div class="pt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">
                                                <span>Conversion Rate</span>
                                                <i class="feather-link-2 fs-10 ms-1"></i>
                                            </a>
                                            <div>
                                                <span class="fs-12 text-muted">$2,254</span>
                                                <span class="fs-11 text-muted">(46%)</span>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 ht-3">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 46%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="p-4">
                                <div class="row gx-4">
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Edit Product</h5>
                                                <small class="text-muted">ID: {{ $product->id }}</small>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Price</label>
                                                            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="form-control @error('price') is-invalid @enderror" required>
                                                            @error('price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
                                                            @error('description')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Category</label>
                                                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                                                <option value="">Select a category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Stock</label>
                                                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control @error('stock') is-invalid @enderror" min="0">
                                                            @error('stock')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                            </div>
                                            <div class="card-footer d-flex justify-content-between align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="status" name="status" {{ old('status', $product->status) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status">Active</label>
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                                    <button class="btn btn-primary" type="submit">Save Product</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="mb-0">Product Images</h6>
                                                <small class="text-muted d-block">Drag to reorder</small>
                                            </div>
                                            <div class="card-body">
                                                <div id="imageSortable" class="d-flex flex-wrap gap-3 border p-2 rounded">
                                                    @foreach ($product->images->sortBy('position') as $image)
                                                        <div class="image-item" data-id="{{ $image->id }}">
                                                            <div class="position-relative">
                                                                <img src="{{ asset('storage/' . $image->image) }}" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover">

                                                                {{-- DELETE --}}
                                                                <button type="button" class="delete-btn" data-url="{{ route('admin.product-images.destroy', $image->id) }}" onclick="confirmImageDelete({{ $image->id }}, this)" aria-label="Delete image">&times;</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gx-4">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Product Variants</h5>

                                                <form method="POST" action="{{ route('admin.product-variants.store') }}" class="d-flex gap-2 ms-2">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <input type="text" name="size" class="form-control form-control-sm" placeholder="Size (S, M, L)" required>
                                                    <input type="text" name="color" class="form-control form-control-sm" placeholder="Color" required>
                                                    <input type="number" name="stock" class="form-control form-control-sm" placeholder="Stock" required>
                                                    <button class="btn btn-primary btn-sm">Add Variant</button>
                                                </form>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Size</th>
                                                                <th>Color</th>
                                                                <th>Stock</th>
                                                                <th width="80">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($product->variants as $variant)
                                                                <tr>
                                                                    <td>{{ $variant->size }}</td>
                                                                    <td>{{ $variant->color }}</td>
                                                                    <td>{{ $variant->stock }}</td>
                                                                    <td>
                                                                        <form method="POST" action="{{ route('admin.product-variants.destroy', $variant->id) }}" class="delete-variant-form d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="btn btn-sm btn-danger delete-variant-btn" data-id="{{ $variant->id }}">×</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center text-muted">No variants added</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="mb-0">Product Info</h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-2"><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</p>
                                                <p class="mb-2"><strong>Created:</strong> {{ optional($product->created_at)->format('Y-m-d') ?? '—' }}</p>
                                                <p class="mb-0"><strong>Updated:</strong> {{ optional($product->updated_at)->format('Y-m-d') ?? '—' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>

    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->

    {{-- js for images  --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Sortable === 'undefined') {
                    console.error('Sortable is not loaded');
                    return;
                }

                const el = document.getElementById('imageSortable');
                if (!el) return;

                const sortable = new Sortable(el, {
                    animation: 150,
                    onEnd: function() {
                        let order = [];

                        document.querySelectorAll('.image-item').forEach((el, index) => {
                            order.push({
                                id: el.dataset.id,
                                position: index
                            });
                        });

                        fetch('{{ route('admin.product-images.reorder') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    order
                                })
                            }).then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Order saved');
                                } else {
                                    console.error('Failed to save order', data);
                                }
                            }).catch(err => console.error('Reorder error', err));
                    }
                });

                // Image delete via AJAX (so we avoid nested form _method collisions)
                window.confirmImageDelete = function(id, btn) {
                    const url = btn.getAttribute('data-url');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This will permanently delete the image.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content');
                            fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json'
                                }
                            }).then(res => {
                                if (!res.ok) throw new Error('Network response was not ok');
                                return res.json();
                            }).then(data => {
                                if (data.success) {
                                    const item = document.querySelector('.image-item[data-id="' +
                                        id + '"]');
                                    if (item) item.remove();
                                    Swal.fire('Deleted!', 'Image deleted successfully.', 'success');
                                } else {
                                    Swal.fire('Error', 'Could not delete image', 'error');
                                }
                            }).catch(err => {
                                console.error('Delete error', err);
                                Swal.fire('Error', 'Could not delete image', 'error');
                            });
                        }
                    });
                }
                // Variant delete confirmation using SweetAlert2
                document.querySelectorAll('.delete-variant-btn').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This will delete the variant.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
