@extends('admin.layout.master')

@section('search')
    <h3 class="form-header"><input type="hidden"></h3>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-10 offset-1">
                    <div class="my-2">
                            <a href="{{ route('customer#feedback') }}" class="text-dark text-decoration-none">
                                <i class="fa-solid fa-arrow-left fs-3"></i>
                            </a>
                        </div>
                    <div class="card bg-light shadow-sm" style="width: 100%;">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <small class="text-muted">{{ $viewFeedback->created_at->format('M-d-Y') }}</small>
                            </div>
                            <h5 class="card-title"><i class="fa-solid fa-id-card me-2"></i>Name : {{ $viewFeedback->name }}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted"><i class="fa-solid fa-envelope me-2"></i>Mail :
                                {{ $viewFeedback->email }}</h6>
                            <p class="card-text mt-3"><i class="fa-solid fa-message me-2"></i>
                                {{ Str::words($viewFeedback->message, 30, '...') }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
