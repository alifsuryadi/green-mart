@extends('layouts.app')

@section('title', 'Daftar Produk')

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

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Produk</h5>
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Deskripsi Produk</th>
                                <th>Gambar Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->order_number }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->categories->count() > 0)
                                                                                        <ul class="list-unstyled mb-0">
                                                @foreach($product->categories as $category)
                                                    <li>
                                                        <strong>{{ $category->name }}</strong>
                                                        @if($category->description)
                                                            <br><small class="text-muted">{{ $category->description }}</small>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">Belum ada kategori</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $totalImages = 0;
                                            foreach($product->categories as $category) {
                                                $totalImages += $category->images->count();
                                            }
                                        @endphp
                                        <span class="badge bg-info">{{ $totalImages }} gambar</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $products->links('pagination::bootstrap-5') }}
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada produk yang ditambahkan</p>
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Produk Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection