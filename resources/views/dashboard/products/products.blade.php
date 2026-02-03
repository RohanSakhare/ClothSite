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
                        <h5 class="m-b-10">Products</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Products</li>
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
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Add Product</span>
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
                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover pt-3 pb-3" id="products-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

            <!-- Product preview modal -->
            <div class="modal fade" id="productShowModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productShowModalLabel">Product Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="productShowModalBody">Loading...</div>
                    </div>
                </div>
            </div>

        </div>
        @push('scripts')
            <script>
                // Initialize or reinitialize Fancybox for admin thumbnails
                function initAdminFancybox() {
                    try {
                        if (typeof Fancybox !== 'undefined' && Fancybox && typeof Fancybox.destroy === 'function') {
                            Fancybox.destroy();
                        }
                    } catch (e) {
                        // ignore
                    }

                    if (typeof Fancybox !== 'undefined' && Fancybox) {
                        Fancybox.bind('.admin-fancybox', {
                            dragToClose: false,
                            Thumbs: {
                                autoStart: true
                            },
                            Toolbar: {
                                display: ["counter", "close"]
                            },
                            Carousel: {
                                preloaded: 3,
                                center: true
                            }
                        });
                    }

                    // Simple in-modal image viewer state and helpers
                    window.productModalState = window.productModalState || {};

                    window.initProductModalViewer = function(id) {
                        const container = document.getElementById('product-viewer-' + id);
                        if (!container) return;
                        try {
                            const images = JSON.parse(container.getAttribute('data-images') || '[]');
                            window.productModalState[id] = { images: images, index: 0 };
                            const mainImg = document.getElementById('product-main-img-' + id);
                            if (mainImg && images.length) {
                                mainImg.src = images[0];
                            }
                        } catch (e) {
                            console.error('Failed to init viewer', e);
                        }
                    }

                    window.modalPrevImage = function(id) {
                        const state = window.productModalState[id];
                        if (!state || !state.images.length) return;
                        state.index = (state.index - 1 + state.images.length) % state.images.length;
                        const img = document.getElementById('product-main-img-' + id);
                        if (img) img.src = state.images[state.index];
                    }

                    window.modalNextImage = function(id) {
                        const state = window.productModalState[id];
                        if (!state || !state.images.length) return;
                        state.index = (state.index + 1) % state.images.length;
                        const img = document.getElementById('product-main-img-' + id);
                        if (img) img.src = state.images[state.index];
                    }
                }

                $(function() {
                    const table = $('#products-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('admin.products.data') }}",
                            error: function(xhr, status, error) {
                                console.error('DataTable ajax error:', xhr.responseText || error);
                                // show a simple message in table
                                const tableBody = $('#products-table tbody');
                                tableBody.html('<tr><td colspan="7" class="text-danger">Failed to load data. Check the server console.</td></tr>');
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false,
                                width: '40px'
                            },
                            {
                                data: 'image',
                                name: 'image',
                                orderable: false,
                                searchable: false,
                                width: '120px'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'price',
                                name: 'price',
                                width: '100px'
                            },
                            {
                                data: 'stock',
                                name: 'stock',
                                width: '80px'
                            },
                            {
                                data: 'status',
                                name: 'status',
                                orderable: false,
                                width: '90px'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false,
                                width: '160px'
                            }


                        ],
                        drawCallback: function(settings) {
                            // Re-bind Fancybox to dynamically loaded anchors
                            initAdminFancybox();
                        },
                        initComplete: function(settings, json) {
                            // Initial bind
                            initAdminFancybox();
                        }
                    });

                    // Re-init Fancybox when table is redrawn via API calls
                    table.on('xhr.dt', function(e, settings, json, xhr) {
                        initAdminFancybox();
                    });

                    // Show product details in a modal via AJAX
                    window.showProduct = function(id) {
                        const url = "{{ route('admin.products.show', ':id') }}".replace(':id', id);
                        fetch(url, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        }).then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.text();
                        }).then(html => {
                            document.getElementById('productShowModalBody').innerHTML = html;
                            document.getElementById('productShowModalLabel').innerText = 'Product Preview';

                            // Initialize in-modal viewer (arrow navigation)
                            initProductModalViewer(id);

                            const modalEl = document.getElementById('productShowModal');
                            const bsModal = new bootstrap.Modal(modalEl);
                            bsModal.show();

                            // Clean up state when modal is closed
                            const cleanup = () => {
                                try { delete window.productModalState[id]; } catch (e) {}
                                modalEl.removeEventListener('hidden.bs.modal', cleanup);
                            };
                            modalEl.addEventListener('hidden.bs.modal', cleanup);
                        }).catch(err => {
                            console.error('Failed to load product:', err);
                            Swal.fire('Error', 'Failed to load product details', 'error');
                        });
                    }
                });
            </script>
        @endpush


    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
@endsection
