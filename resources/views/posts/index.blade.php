<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Posts</h3>
                    <a href="{{ route('posts.create') }}" class="btn btn-light">
                        <i class="bi bi-plus-lg"></i> New Post
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Post List -->
                <div class="list-group">
                    @foreach($posts as $post)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="post">
                                    @if($post->image)
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid post-image">
                                    @endif
        
                                </div>
                                <div>
                                    <h5>{{ $post->title }}</h5>
                                    <small class="text-muted">Category: {{ $post->category->name }}</small>
                                    <p class="mb-0 mt-2">{{ Str::limit($post->content, 100) }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>