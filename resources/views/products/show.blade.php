@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Product Info -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $product->name }}</h5>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Kategori Produk</h6>
            @if($product->categories->count() < 3)
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </button>
            @else
                <span class="badge bg-warning">Maksimal 3 kategori</span>
            @endif
        </div>
        <div class="card-body">
            @if($product->categories->count() > 0)
                <div class="row">
                    @foreach($product->categories as $category)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                </div>
                                <div class="card-body">
                                    @if($category->description)
                                        <p class="small text-muted">{{ $category->description }}</p>
                                    @endif
                                    
                                    <h6 class="mb-2">Gambar:</h6>
                                    @if($category->images->count() > 0)
                                        <div class="row g-2">
                                            @foreach($category->images as $image)
                                                <div class="col-6">
                                                    <div class="position-relative">
                                                        <img src="{{ $image->full_path }}" class="img-fluid rounded" alt="{{ $image->file_name }}">
                                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                                                                onclick="confirmDeleteImage({{ $image->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small">Belum ada gambar</p>
                                    @endif
                                    
                                    <form action="{{ route('images.store', $category) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png" required>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-warning btn-sm" onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center">Belum ada kategori untuk produk ini</p>
            @endif
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories.store', $product) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="category_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_category_name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_category_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_category_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Image Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin untuk Menghapus Gambar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #808080;">
                    Batalkan
                </button>
                <form id="deleteImageForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="background-color: #D22B2B;">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editCategory(id, name, description) {
    document.getElementById('edit_category_name').value = name;
    document.getElementById('edit_category_description').value = description || '';
    document.getElementById('editCategoryForm').action = `/categories/${id}`;
    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}

function confirmDeleteImage(imageId) {
    document.getElementById('deleteImageForm').action = `/images/${imageId}`;
    new bootstrap.Modal(document.getElementById('deleteImageModal')).show();
}
</script>
@endpush
@endsection