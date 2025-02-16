@extends('layouts.main')
@section('css')
@endsection
@section('body')
    <h3> Search & Filters </h3>
    <div class="card rounded shadow border-1">
        <div class="card-body">

            <form action="{{ url('/search-post') }}" method="GET">
                <div class="row">
                    <!-- Search -->
                    <div class="col-md-4 mb-1">
                        <input type="text" name="search" class="form-control" placeholder="Search posts..."
                            value="{{ request('search') }}">
                    </div> <br>

                    <!-- Category Filter -->
                    <div class="col-md-3 mb-1">
                        <select name="category" class="form-control">
                            <option value="" {{ request('category') == '' ? 'selected' : '' }}> All
                                Category </option>
                            <option value="Artificial Intelligence"
                                {{ request('category') == 'Artificial Intelligence' ? 'selected' : '' }}>
                                Artificial Intelligence</option>
                            <option value="Cybersecurity" {{ request('category') == 'Cybersecurity' ? 'selected' : '' }}>
                                Cybersecurity
                            </option>
                            <option value="Software Development"
                                {{ request('category') == 'Software Development' ? 'selected' : '' }}>
                                Software Development</option>
                            <option value="Programming Languages"
                                {{ request('category') == 'Programming Languages' ? 'selected' : '' }}>
                                Programming Languages</option>
                            <option value="Web Development"
                                {{ request('category') == 'Web Development' ? 'selected' : '' }}>Web
                                Development</option>
                            <option value="Cloud Computing"
                                {{ request('category') == 'Cloud Computing' ? 'selected' : '' }}>Cloud
                                Computing</option>
                            <option value="Electronic Vehicles"
                                {{ request('category') == 'Electronic Vehicles' ? 'selected' : '' }}>
                                Electronic Vehicles</option>
                            <option value="Blockchain & Cryptocurrency"
                                {{ request('category') == 'Blockchain & Cryptocurrency' ? 'selected' : '' }}>
                                Blockchain & Cryptocurrency</option>
                            <option value="Gadgets & Hardware"
                                {{ request('category') == 'Gadgets & Hardware' ? 'selected' : '' }}>Gadgets
                                & Hardware</option>
                            <option value="Tech Industry News"
                                {{ request('category') == 'Tech Industry News' ? 'selected' : '' }}>Tech
                                Industry News</option>
                        </select>
                    </div>

                    <!-- Sorting -->
                    <div class="col-md-3 mb-1">
                        <select name="sort" class="form-control">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Oldest</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                                Most Popular</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Apply</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php error_reporting(0); ?>

    @if ($posts)
        @if ($count > 0)
            <h1 class="mt-4"> Results found ({{ $count }}) </h1>
            <hr>
            @foreach ($posts as $post)
                <div class="single-recent-blog-post">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ $post->thumbnail }}" alt="">
                        <ul class="thumb-info">
                            <li><a href="#"><i class="ti-user"></i>{{ Str::limit($post->user->name, 9, '...') }}</a>
                            </li>
                            <li><a href="#"><i class="ti-notepad"></i>{{ $post->updated_at->format('F d, Y') }}</a>
                            </li>
                            <li><a href="#"><i class="ti-themify-favicon"></i>{{ $post->comments->count() }}
                                    Comments</a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="{{ env('APP_URL') }}/{{ $post->id }}/view">
                            <h3>{{ $post->title }}</h3>
                        </a>
                        <p class="tag-list-inline">Tag: <a href="#">{{ $post->category }}</a></p>
                        <p>{{ Str::limit(preg_replace('/\s+/', ' ', strip_tags($post->content)), 300, '...') }}
                        </p>
                        <a class="button" href="#" id="readMoreBTN" data-id="{{ $post->id }}">Read
                            More <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            @endforeach
            <!-- Pagination Links -->
            <div class="pagination">
                {{ $posts->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        @else
            <h1 class="mt-4"> Results found ({{ $count }}) </h1>
            <hr>
            <h1> No Result Found </h1>
        @endif
    @endif
@endsection
@section('script')
@endsection
