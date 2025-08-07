<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Management</title>
    <!-- Bootstrap CSS ekleniyor -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- başarı mesajı -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Categories</h3>
                  
                </div>
            </div>
            
            <div class="card-body">
                <!-- kategori ekleme  -->
                <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Kategori adı girin..." required>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>

                <!-- kategori listesi -->
                <div class="list-group">
                    @foreach($categories as $category)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $category->name }}</span>
                            <div>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-2">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>