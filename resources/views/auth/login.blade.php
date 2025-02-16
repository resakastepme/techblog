@extends('layouts.alternative')
@section('css')
    <style>
        .absolute-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @media (max-width: 767px) {
            .absolute-center {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
@endsection
@section('body')
    @if (Auth::check())
        {{ redirect()->to('/')->send() }}
    @endif
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <section class="absolute-center">
                    <section id="alert">
                        @if (session('from') == 'registerSuccess')
                            <div class="alert alert-success" id="alertPop" style="display: block; cursor: pointer;"
                                role="alert">
                                You have successfully registered! <br> Please login to continue.
                            </div>
                        @elseif (session('error') == 'Invalid email or password')
                            <div class="alert alert-warning" id="alertPop" style="display: block; cursor: pointer;"
                                role="alert">
                                Email or password doesn't match! <br>
                                Please try again.
                            </div>
                        @endif
                    </section>
                    <div class="card shadow p-4" style="width: 400px;">
                        <h3 class="text-center mb-4">Login</h3>
                        <form action="{{ url('/login-check') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                {{-- <label for="email" class="form-label">Email Address</label> --}}
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                    required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{-- <label for="password" class="form-label">Password</label> --}}
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </section>
            </div>
            <div class="col-md-6">
                <section class="mb-30px">
                    <div class="hero-banner">
                        <div class="hero-banner__content">
                            <h3>TechBlog</h3>
                            <h1>The Amazing World of Technology</h1>
                            <h4>{{ $date }}</h4>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).on('click', '#alertPop', function() {
            $(this).remove();
        });
    </script>
@endsection
