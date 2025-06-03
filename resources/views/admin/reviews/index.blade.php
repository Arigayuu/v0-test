@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Reviews Management</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>
                                    <a href="{{ route('products.show', $review->product) }}">
                                        {{ $review->product->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $review->user) }}">
                                        {{ $review->user->name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning me-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                        <span>({{ $review->rating }}/5)</span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($review->comment, 100) }}</td>
                                <td>{{ $review->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No reviews found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 