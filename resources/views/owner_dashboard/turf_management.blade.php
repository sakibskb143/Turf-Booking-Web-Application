@extends('layouts.owner_dashboard_layout')

@section('content')
<style>
    .status-active { background:#d4f7df; color:#2e8b57; padding:2px 8px; border-radius:6px; font-size:12px; }
    .status-maintenance { background:#ffe9b3; color:#b58900; padding:2px 8px; border-radius:6px; font-size:12px; }
    .category-card { border:1px solid #e5e7eb; border-radius:10px; padding:18px; background:white; }
    .category-card:hover { background:#f9fafb; }
    .field-table th, .field-table td { vertical-align:middle; }
</style>

<div class="container-fluid">
    <h3 class="fw-bold mb-3">Turf Management</h3>
    <p class="text-muted">Manage your sport categories and fields.</p>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#categories">Categories</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fields">Fields</button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- Categories Tab -->
        <div class="tab-pane fade show active" id="categories">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Sport Categories</h5>
               <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    + Add Category
</button>
            </div>

            <div class="row g-3">
                <!-- Category Item -->
                <div class="col-md-4">
                    <div class="category-card shadow-sm">
                        <h6 class="fw-bold">Football</h6>
                        <span class="status-active">active</span>
                        <p class="mt-2 text-muted">3 fields</p>
                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="category-card shadow-sm">
                        <h6 class="fw-bold">Cricket</h6>
                        <span class="status-active">active</span>
                        <p class="mt-2 text-muted">2 fields</p>
                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="category-card shadow-sm">
                        <h6 class="fw-bold">Badminton</h6>
                        <span class="status-active">active</span>
                        <p class="mt-2 text-muted">2 fields</p>
                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="category-card shadow-sm">
                        <h6 class="fw-bold">Tennis</h6>
                        <span class="status-active">active</span>
                        <p class="mt-2 text-muted">1 field</p>
                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fields Tab -->
        <div class="tab-pane fade" id="fields">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Fields</h5>
                <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addFieldModal">
    + Add Field
</button>

            </div>

            <div class="card p-3 shadow-sm">
                <table class="table field-table">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            <th>Category</th>
                            <th>Capacity</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Football Field A</strong><br><small class="text-muted">Premium football field</small></td>
                            <td>Football</td>
                            <td>22</td>
                            <td>North Wing</td>
                            <td><span class="status-active">active</span></td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm">✏️</button>
                                <button class="btn btn-outline-danger btn-sm">🗑️</button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Football Field B</strong><br><small class="text-muted">Natural grass field</small></td>
                            <td>Football</td>
                            <td>22</td>
                            <td>South Wing</td>
                            <td><span class="status-active">active</span></td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm">✏️</button>
                                <button class="btn btn-outline-danger btn-sm">🗑️</button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Cricket Ground</strong><br><small class="text-muted">Full-size cricket ground</small></td>
                            <td>Cricket</td>
                            <td>30</td>
                            <td>East Wing</td>
                            <td><span class="status-active">active</span></td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm">✏️</button>
                                <button class="btn btn-outline-danger btn-sm">🗑️</button>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Badminton Court 1</strong><br><small class="text-muted">Indoor court</small></td>
                            <td>Badminton</td>
                            <td>4</td>
                            <td>Indoor Complex</td>
                            <td><span class="status-maintenance">maintenance</span></td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm">✏️</button>
                                <button class="btn btn-outline-danger btn-sm">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Button -->


<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label class="fw-bold">Category Name</label>
                <input type="text" class="form-control" placeholder="e.g. Football, Cricket, Tennis">

                <label class="fw-bold mt-3">Description (Optional)</label>
                <textarea class="form-control" rows="2" placeholder="Brief description of this sport category"></textarea>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-dark">Create Category</button>
            </div>

        </div>
    </div>
</div>
<!-- Add Field Button -->

<!-- Add Field Modal -->
<div class="modal fade" id="addFieldModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Field</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label class="fw-bold">Field Name</label>
                <input type="text" class="form-control" placeholder="e.g. Football Field A">

                <label class="fw-bold mt-3">Category</label>
                <select class="form-control">
                    <option>Select category</option>
                    <option>Football</option>
                    <option>Cricket</option>
                    <option>Badminton</option>
                    <option>Tennis</option>
                </select>

                <div class="d-flex gap-3 mt-3">
                    <div class="flex-fill">
                        <label class="fw-bold">Capacity</label>
                        <input type="number" class="form-control" placeholder="e.g. 22">
                    </div>

                    <div class="flex-fill">
                        <label class="fw-bold">Location</label>
                        <input type="text" class="form-control" placeholder="North Wing">
                    </div>
                </div>

                <label class="fw-bold mt-3">Description</label>
                <textarea class="form-control" rows="2" placeholder="Brief description of this field"></textarea>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-dark">Create Field</button>
            </div>

        </div>
    </div>
</div>

</div>
@endsection