@extends('layouts.alternative')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('body')
    @if (!Auth::check())
        <div class="container mt-5 mb-5">
            <div class="card rounded shadow border-0">
                <div class="card-body">
                    <h1> Please login to create a post! </h1>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-5 mb-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">
                    <ul>
                        {{ session('status') }}
                    </ul>
                </div>
            @endif
            <h2>Create a Blog Post</h2>

            <form action="{{ url('/store-post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Thumbnail Upload Section -->
                <div class="mb-3">
                    <button class="btn btn-success" id="uploadThumbnail"> Upload thumbnail </button>
                    <input type="file" style="display: none;" id="upload" accept="image/*" class="form-control">
                    <div id="upload-demo" class="mt-3" style="display: none;"></div>
                    <!-- Croppie will be here -->
                    <input type="hidden" name="thumbnail" id="thumbnail">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category"
                            required>
                            <option value="" disabled selected>-- Choose a category --</option>
                            <option value="Artificial Intelligence">Artificial Intelligence</option>
                            <option value="Cybersecurity">Cybersecurity</option>
                            <option value="Software Development">Software Development</option>
                            <option value="Programming Languages">Programming Languages</option>
                            <option value="Web Development">Web Development</option>
                            <option value="Cloud Computing">Cloud Computing</option>
                            <option value="Electronic Vehicles">Electronic Vehicles</option>
                            <option value="Blockchain & Cryptocurrency">Blockchain & Cryptocurrency</option>
                            <option value="Gadgets & Hardware">Gadgets & Hardware</option>
                            <option value="Tech Industry News">Tech Industry News</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="summernote" name="content" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Publish</button>
            </form>
        </div>
    @endif
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Write your blog content here...',
                tabsize: 2,
                height: 300
            });

            $('#uploadThumbnail').on('click', function() {
                $('#upload').click();
            });

            // Initialize Croppie for 1270x720 pixels
            var croppie = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 635,
                    height: 360,
                    type: 'rectangle'
                }, // Maintain 1270x720 ratio at half size
                boundary: {
                    width: 700,
                    height: 400
                }
            });

            // When user selects an image
            $('#upload').on('change', function(e) {
                e.preventDefault();
                var reader = new FileReader();
                reader.onload = function(e) {
                    croppie.croppie('bind', {
                        url: e.target.result
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadThumbnail').html('Change thumbnail')
                $('#upload-demo').show();
            });

            // On form submit, get the cropped image
            $('form').on('submit', function(e) {
                e.preventDefault();
                croppie.croppie('result', {
                    type: 'base64',
                    size: 'original'
                }).then(function(base64) {
                    $('#thumbnail').val(base64); // Store in hidden input
                    e.currentTarget.submit(); // Submit form
                });
            });
        });
    </script>
@endsection
