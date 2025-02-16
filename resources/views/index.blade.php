@extends('layouts.main')
@section('css')
@endsection
@section('bannerAndSlider')
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner">
                <div class="hero-banner__content">
                    <h3>TechBlog</h3>
                    <h1>The Amazing World of Technology</h1>
                    <h4>{{ $date }}</h4>
                </div>
            </div>
        </div>
    </section>
    <!--================Hero Banner end =================-->

    <!--================ Blog slider start =================-->
    <section>
        <div class="container">
            <div class="owl-carousel owl-theme blog-slider">
                @foreach ($forSliders as $slider)
                    <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="{{ $slider->thumbnail }}" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="#">{{ $slider->category }}</a>
                            <h3><a href="#" id="sliderViewBTN" data-id="{{ $slider->id }}"> {{ $slider->title }}
                                </a></h3>
                            <p>{{ \Carbon\Carbon::parse($slider->created_at)->locale('en')->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================ Blog slider end =================-->
@endsection
@section('body')
    @foreach ($forPosts as $post)
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
                <a id="readMoreBTN" data-id="{{ $post->id }}" href="#">
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
        {{ $forPosts->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).on('click', '#sliderViewBTN', function(e) {
            e.preventDefault();
            let post_id = $(this).data('id');
            window.location = `${window.location.origin}/${post_id}/view`;
        });
        $(document).on('click', '#readMoreBTN', function(e) {
            e.preventDefault();
            let post_id = $(this).data('id');
            window.location = `${window.location.origin}/${post_id}/view`;
        });
    </script>
@endsection
