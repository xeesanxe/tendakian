<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Product — tendakian Admin</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .admin-header {
      background: linear-gradient(135deg, #1e4d3f 0%, #2d7a6e 50%, #3d9b8c 100%);
      padding: 30px 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-bottom: 40px;
      color: white;
    }
    
    .admin-header h1 {
      color: white;
      font-weight: 700;
      margin-bottom: 8px;
    }
    
    .admin-header .text-muted {
      color: rgba(255,255,255,0.8) !important;
    }
    
    .form-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      overflow: hidden;
      margin-bottom: 30px;
    }
    
    .form-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      padding: 25px 30px;
      border-bottom: 1px solid #f1f3f4;
    }
    
    .form-title {
      font-weight: 700;
      color: #2d3748;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .form-title i {
      font-size: 1.2rem;
      color: #2d7a6e;
    }
    
    .form-body {
      padding: 40px;
    }
    
    .form-group {
      margin-bottom: 28px;
    }
    
    .form-label {
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 10px;
      font-size: 0.95rem;
    }
    
    .form-control {
      border-radius: 12px;
      border: 2px solid #e9ecef;
      padding: 14px 18px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #2d7a6e;
      box-shadow: 0 0 0 0.2rem rgba(45, 122, 110, 0.15);
    }
    
    .form-control.is-invalid {
      border-color: #dc3545;
    }
    
    .invalid-feedback {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 8px;
    }
    
    .file-upload-area {
      border: 2px dashed #e9ecef;
      border-radius: 12px;
      padding: 40px 20px;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .file-upload-area:hover {
      border-color: #2d7a6e;
      background-color: #f8f9fa;
    }
    
    .file-upload-area.dragover {
      border-color: #2d7a6e;
      background-color: #f0f8f7;
    }
    
    .file-upload-icon {
      font-size: 3rem;
      color: #6c757d;
      margin-bottom: 16px;
    }
    
    .btn-save {
      background: linear-gradient(135deg, #28a745, #20c997);
      border: none;
      color: white;
      padding: 14px 32px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      margin-right: 12px;
    }
    
    .btn-save:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    }
    
    .btn-cancel {
      background: #6c757d;
      border: none;
      color: white;
      padding: 14px 32px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .btn-cancel:hover {
      color: white;
      background: #5a6268;
      transform: translateY(-2px);
    }
    
    .btn-logout {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
      background: rgba(255,255,255,0.2);
      color: white;
      transform: translateY(-1px);
    }
    
    .input-group {
      border-radius: 12px;
      overflow: hidden;
    }
    
    .input-group-text {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border: 2px solid #e9ecef;
      border-right: none;
      color: #6c757d;
      font-weight: 600;
    }
    
    .input-group .form-control {
      border-left: none;
    }
    
    .preview-image {
      max-width: 200px;
      max-height: 200px;
      border-radius: 12px;
      border: 2px solid #e9ecef;
      margin-top: 16px;
    }
    
    .form-help {
      font-size: 0.875rem;
      color: #6c757d;
      margin-top: 8px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="admin-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h2 mb-2">Add New Product</h1>
          <p class="mb-0">Create a new outdoor gear product for rental</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-logout me-2">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
          </a>
          <span class="small opacity-75">Admin Panel</span>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-logout">
              <i class="bi bi-box-arrow-right me-2"></i>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container pb-5">
    <div class="form-card">
      <div class="form-header">
        <h3 class="form-title">
          <i class="bi bi-plus-circle"></i>
          Product Information
        </h3>
      </div>
      
      <div class="form-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-8">
              <!-- Product Name -->
              <div class="form-group">
                <label class="form-label">Product Name</label>
                <input 
                  type="text"
                  name="name" 
                  class="form-control @error('name') is-invalid @enderror"
                  placeholder="Enter product name (e.g., Mountain Tent 4-Person)"
                  value="{{ old('name') }}"
                  required
                >
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">Choose a descriptive name that customers will easily understand</div>
              </div>

              <!-- SKU -->
              <div class="form-group">
                <label class="form-label">SKU (Stock Keeping Unit)</label>
                <input 
                  type="text"
                  name="sku" 
                  class="form-control @error('sku') is-invalid @enderror"
                  placeholder="Enter unique SKU (e.g., TNT-MT-001)"
                  value="{{ old('sku') }}"
                  required
                >
                @error('sku')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">Unique identifier for inventory tracking</div>
              </div>

              <!-- Description -->
              <div class="form-group">
                <label class="form-label">Description</label>
                <textarea 
                  name="description"
                  class="form-control @error('description') is-invalid @enderror"
                  rows="4"
                  placeholder="Describe the product features, specifications, and usage..."
                >{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">Detailed description helps customers make informed decisions</div>
              </div>
            </div>

            <div class="col-md-4">
              <!-- Price -->
              <div class="form-group">
                <label class="form-label">Rental Price (per day)</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input 
                    type="number"
                    name="price" 
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="0"
                    value="{{ old('price') }}"
                    min="0"
                    step="1000"
                    required
                  >
                </div>
                @error('price')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">Price per day in Indonesian Rupiah</div>
              </div>

              <!-- Stock -->
              <div class="form-group">
                <label class="form-label">Stock Quantity</label>
                <input 
                  type="number"
                  name="stock" 
                  class="form-control @error('stock') is-invalid @enderror"
                  placeholder="0"
                  value="{{ old('stock') }}"
                  min="0"
                  required
                >
                @error('stock')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-help">Available units for rental</div>
              </div>
            </div>
          </div>

          <!-- Image Upload -->
          <div class="form-group">
            <label class="form-label">Product Image</label>
            <div class="file-upload-area" onclick="document.getElementById('image').click()">
              <div class="file-upload-icon">
                <i class="bi bi-cloud-upload"></i>
              </div>
              <h5>Click to upload product image</h5>
              <p class="text-muted mb-0">Drag and drop or click to select files</p>
              <small class="text-muted">Supported formats: JPG, PNG, GIF (Max: 2MB)</small>
            </div>
            <input 
              type="file" 
              name="image" 
              id="image"
              class="form-control @error('image') is-invalid @enderror"
              accept="image/*"
              style="display: none;"
              onchange="previewImage(this)"
            >
            @error('image')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <div id="imagePreview"></div>
          </div>

          <!-- Form Actions -->
          <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-cancel">
              <i class="bi bi-arrow-left me-2"></i>
              Back to Products
            </a>
            <button type="submit" class="btn btn-save">
              <i class="bi bi-check-circle me-2"></i>
              Create Product
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    // Image preview function
    function previewImage(input) {
      const preview = document.getElementById('imagePreview');
      
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.innerHTML = `
            <img src="${e.target.result}" class="preview-image" alt="Preview">
            <div class="form-help mt-2">Image preview - this will be uploaded</div>
          `;
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Drag and drop functionality
    const uploadArea = document.querySelector('.file-upload-area');
    
    uploadArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadArea.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', () => {
      uploadArea.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadArea.classList.remove('dragover');
      
      const files = e.dataTransfer.files;
      if (files.length > 0) {
        document.getElementById('image').files = files;
        previewImage(document.getElementById('image'));
      }
    });
  </script>
</body>
</html>
