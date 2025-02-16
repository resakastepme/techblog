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
                    <h1> Please login to edit a post! </h1>
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
            <h2>Edit a Post</h2>

            <form action="{{ url('/store-edit-post') }}" method="POST" id="formEditPost">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="mb-3">
                    <button type="button" class="btn btn-success" id="uploadThumbnail">Change thumbnail</button>
                    <input type="file" style="display: none;" id="upload" accept="image/*" class="form-control">
                    <div align="center">
                        <img id="currentThumbnail" class="img-fluid" src="{{ env('APP_URL') }}{{ $data->thumbnail }}"
                            style="width: 50%; height: 50%;">
                    </div>
                    <div id="upload-demo" class="mt-3" style="display: none;"></div>
                    <input type="hidden" name="thumbnail" id="thumbnail">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $data->title }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category"
                            required>
                            <option value="" disabled {{ $data->category == '' ? 'selected' : '' }}>-- Choose a
                                category --</option>
                            <option value="Artificial Intelligence"
                                {{ $data->category == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence
                            </option>
                            <option value="Cybersecurity" {{ $data->category == 'Cybersecurity' ? 'selected' : '' }}>
                                Cybersecurity</option>
                            <option value="Software Development"
                                {{ $data->category == 'Software Development' ? 'selected' : '' }}>Software Development
                            </option>
                            <option value="Programming Languages"
                                {{ $data->category == 'Programming Languages' ? 'selected' : '' }}>Programming Languages
                            </option>
                            <option value="Web Development" {{ $data->category == 'Web Development' ? 'selected' : '' }}>
                                Web Development</option>
                            <option value="Cloud Computing" {{ $data->category == 'Cloud Computing' ? 'selected' : '' }}>
                                Cloud Computing</option>
                            <option value="Electronic Vehicles"
                                {{ $data->category == 'Electronic Vehicles' ? 'selected' : '' }}>Electronic Vehicles
                            </option>
                            <option value="Blockchain & Cryptocurrency"
                                {{ $data->category == 'Blockchain & Cryptocurrency' ? 'selected' : '' }}>Blockchain &
                                Cryptocurrency</option>
                            <option value="Gadgets & Hardware"
                                {{ $data->category == 'Gadgets & Hardware' ? 'selected' : '' }}>Gadgets & Hardware</option>
                            <option value="Tech Industry News"
                                {{ $data->category == 'Tech Industry News' ? 'selected' : '' }}>Tech Industry News</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="summernote" name="content" class="form-control">{{ $data->content }}</textarea>
                </div>

                <button type="button" class="btn btn-primary" id="submitBTN">Publish</button>
            </form>


        </div>
    @endif
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let isThumbnailChanged = false;
            $('#summernote').summernote({
                placeholder: 'Write your blog content here...',
                tabsize: 2,
                height: 600
            });

            $('#uploadThumbnail').on('click', function() {
                $('#upload').click();
            });

            var croppie = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 635,
                    height: 360,
                    type: 'rectangle'
                },
                boundary: {
                    width: 700,
                    height: 400
                }
            });

            $('#upload').on('change', function(e) {
                e.preventDefault();
                isThumbnailChanged = true;
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#upload-demo').show().promise().done(function() {
                        croppie.croppie('bind', {
                                url: e.target.result
                            })
                            .then(() => console.log("Image bound to Croppie"));
                    });
                };
                reader.readAsDataURL(this.files[0]);

                $('#uploadThumbnail').html('Change thumbnail');
                $('#currentThumbnail').hide();
            });

            $('#submitBTN').on('click', function(e) {
                e.preventDefault();

                if (isThumbnailChanged) {
                    croppie.croppie('result', {
                        type: 'base64',
                        size: {
                            width: 1270,
                            height: 720
                        }
                    }).then(function(base64) {
                        console.log("Thumbnail ready");
                        $('#thumbnail').val(base64);
                        $('#formEditPost').submit();
                    }).catch(function(error) {
                        console.error("Croppie failed:", error);
                    });
                } else {
                    $('#formEditPost').submit();
                }
            });
        });
    </script>
@endsection
