@extends('layouts.main')
@section('css')
@endsection
@section('body')
    <div class="main_blog_details">
        <div align="center">
            <img class="img-fluid" src="{{ env('APP_URL') }}{{ $data->thumbnail }}" style="width: 200%; height: 200%;">
        </div>
        <a href="#">
            <h4>{{ $data->title }}</h4>
        </a>
        <div class="user_details">
            <div class="float-left">
                <a href="#">{{ $data->category }}</a>
            </div>
            <div class="float-right mt-sm-0 mt-3">
                <div class="media">
                    <div class="media-body">
                        <h5>{{ $data->user->name }}</h5>
                        <p>{{ $data->created_at->format('d M, Y h:i a') }}</p>
                    </div>
                    <div class="d-flex">
                        <i class="fa-regular fa-user fa-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card shadow rounded border-0">
        <div class="card-body"> --}}
        {!! $data->content !!}
        {{-- </div>
    </div> --}}

        <div class="news_d_footer flex-column flex-sm-row">
            <a @if (Auth::check()) href="#" class="like-btn"
    @else
        href="{{ url('/login') }}" @endif
                data-post-id="{{ $data->id }}">
                <span class="align-middle mr-2">
                    <i
                        class="{{ auth()->check() && $data->isLikedByUser() ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                </span>
                <span class="like-count">{{ $data->likes_count }} people like this</span>
            </a>

            <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#commentSection"><span
                    class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>{{ $countComments->count() }}
                Comments</a>
            @if (Auth::id() == $data->user->id)
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                    <button class="btn btn-warning" style="color: white" id="editPostBTN"><i
                            class="fa-regular fa-pen-to-square">
                            Edit </i></button>
                    {{-- <a href="#" id="deletePostBTN" data-id="{{ $data->id }}"><i
                        class="fa-solid fa-trash"> delete</i></a> --}}
                    <form action="{{ url('/post-delete') }}" method="GET" style="display: inline;" id="deleteForm">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                        <button type="submit" class="btn btn-danger" id="deletePostBTN">
                            <i class="fa-solid fa-trash">Delete</i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="comments-area">
        <h4 id="commentSection">Comments</h4>
        @if (count($comments) == 0)
            <div class="card rounded shadow border-0">
                <div class="card-body">
                    <h4> There is no comment yet, be the first! </h4>
                </div>
            </div>
        @else
            @foreach ($comments as $comment)
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
                                <i class="fa-regular fa-user fa-2xl"></i>
                            </div>
                            <div class="desc">
                                <h5><a href="#"> {{ $comment->user->name }} </a></h5>
                                <p class="date">{{ $comment->created_at->format('d M, Y h:i a') }} </p>
                                <p class="comment">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </div>
                        @if (Auth::check())
                            <div class="reply-btn">
                                <a href="#" class="btn-reply text-uppercase" data-id="{{ $comment->id }}"
                                    id="replyCommentBTN">reply</a>
                            </div>
                        @else
                            <div class="reply-btn">
                                <a href="/login" class="btn-reply text-uppercase" data-id="{{ $comment->id }}">reply</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="replyCommentForm{{ $comment->id }}"></div>

                {{-- Show Replies (Max 1 Level Deep) --}}
                @if ($comment->replies->isNotEmpty())
                    <div class="comment-list left-padding">
                        @foreach ($comment->replies as $reply)
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <i class="fa-regular fa-user fa-2xl"></i>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#"> {{ $reply->user->name }} </a></h5>
                                        <p class="date">{{ $reply->created_at->format('d M, Y h:i a') }}
                                        </p>
                                        <p class="comment">
                                            {{ $reply->content }}
                                        </p>
                                    </div>
                                </div>
                                <div class="reply-btn">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @endif

    </div>
    <div class="comment-form">
        <h4>Leave a Comment</h4>
        @if (Auth::check())
            <form action="/post-comment" method="POST" id="formComment">
                @csrf
                <div class="form-group">
                    <textarea class="form-control mb-10" rows="5" name="content" placeholder="Messege" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Messege'" required=""></textarea>
                    <input type="hidden" name="post_id" value="{{ $data->id }}">
                </div>
                <h5 style="margin-left: 5px;"> Comment as: <span class="fa-regular fa-user fa-sm">
                        {{ auth()->user()->name }} </span> </h5>
                <a href="#" class="button submit_btn" id="submitCommentBTN">Post Comment</a>
            </form>
        @else
            <div class="card shadow rounded border-0">
                <div class="card-body">
                    <h1> Please login to comment. </h1>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('#submitCommentBTN').on('click', function(e) {
            e.preventDefault();
            $('#formComment').submit();
        })

        $(document).on('click', '#replyCommentBTN', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#replyCommentForm' + id).html(`
                            <section class="comment-form">
                                <form action="/post-reply-comment" method="POST" id="formReplyComment">
                                    @csrf
                                    <div class="form-group">
                                        <h5 style="margin-left: 5px;"> Reply as: <span class="fa-regular fa-user fa-sm">
                                            @if (Auth::check())
                                            {{ auth()->user()->name }}
                                            @endif
                                             </span> </h5>
                                        <textarea class="form-control reply mb-10" rows="5" name="content" placeholder="Messege" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Messege'" required=""></textarea>
                                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                                        <input type="hidden" name="parent_id" value="${id}">
                                    </div>
                                    <button class="button submit_btn" style="color: orange;" type="submit" id="submitRepliesBTN">Post Reply</button>
                                </form>
                            </section>
            `);
        });

        $('#editPostBTN').on('click', function(e) {
            e.preventDefault();
            let post_id = {{ $data->id }};
            window.location = `${window.location.origin}/${post_id}/edit`;
        });

        $('#deletePostBTN').on('click', function(e) {
            e.preventDefault();
            let post_id = $(this).data('id');
            Swal.fire({
                icon: "error",
                title: "Do you want to delete the post?",
                showDenyButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `Cancel`
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').submit();
                }
            });
        });

        $('.like-btn').on('click', function(e) {
            e.preventDefault();
            let likeBtn = $(this);
            let postId = likeBtn.data('post-id');
            let icon = likeBtn.find('i');
            let likeText = likeBtn.find('.like-count');

            let isLiked = icon.hasClass('fa-solid');
            let url = isLiked ? `/posts/${postId}/unlike` : `/posts/${postId}/like`;

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        if (data.liked == true) {
                            icon.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
                        } else {
                            icon.removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
                        }
                        let newCount = isLiked ? parseInt(likeText.text()) - 1 : parseInt(likeText
                            .text()) + 1;
                        likeText.text(newCount + " people like this");
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

        });
    </script>
@endsection
