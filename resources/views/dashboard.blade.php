@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Dashboard</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! Codebase assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p class="text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Block Form</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-alt-primary">
                    <i class="fa fa-check"></i> Submit
                </button>
                <button type="reset" class="btn btn-sm btn-alt-danger">
                    <i class="fa fa-repeat"></i> Reset
                </button>
            </div>
        </div>
        <div class="block-content">

        </div>
    </div>
    <!-- END Page Content -->
@endsection
