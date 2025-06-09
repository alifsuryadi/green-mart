@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&background=28a745&color=fff" 
                             alt="Avatar" class="rounded-circle shadow">
                    </div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <hr>
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <h5 class="mb-0">{{ $stats['total_products'] }}</h5>
                            <small class="text-muted">Products</small>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['total_categories'] }}</h5>
                            <small class="text-muted">Categories</small>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['total_images'] }}</h5>
                            <small class="text-muted">Images</small>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('profile.edit') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Account Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Member Since</label>
                        <p class="mb-0">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Last Updated</label>
                        <p class="mb-0">{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small">Email Verified</label>
                        <p class="mb-0">
                            @if($user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> Verified
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-times"></i> Not Verified
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Recent Products -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">My Recent Products</h6>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-success">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($user->products()->latest()->limit(5)->get()->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Categories</th>
                                        <th>Images</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->products()->latest()->limit(5)->get() as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->categories->count() }}</td>
                                            <td>
                                                {{ $product->categories->sum(function($cat) { 
                                                    return $cat->images->count(); 
                                                }) }}
                                            </td>
                                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $product) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No products yet</p>
                    @endif
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($user->products()->latest()->limit(3)->get() as $product)
                            <div class="timeline-item mb-3 pb-3 border-bottom">
                                <div class="d-flex">
                                    <div class="timeline-icon bg-success text-white rounded-circle p-3 me-3" style="font-size: 2rem;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Added new product</h6>
                                        <p class="mb-0 text-muted">{{ $product->name }}</p>
                                        <small class="text-muted">
                                            {{ $product->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection