@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Produk</h6>
                            <h2 class="mb-0">{{ $totalProducts }}</h2>
                            <small class="text-muted">Dari maksimal 5 produk</small>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-box fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Kategori</h6>
                            <h2 class="mb-0">{{ $totalCategories }}</h2>
                            <small class="text-muted">Semua kategori produk</small>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-tags fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Gambar</h6>
                            <h2 class="mb-0">{{ $totalImages }}</h2>
                            <small class="text-muted">Semua gambar produk</small>
                        </div>
                        <div class="text-info">
                            <i class="fas fa-image fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('products.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-plus me-2"></i> Tambah Produk Baru
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('products.index') }}" class="btn btn-primary w-100">
                                <i class="fas fa-list me-2"></i> Lihat Semua Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection