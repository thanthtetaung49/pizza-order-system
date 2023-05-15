@extends('admin.layout.master')

@section('search')
    <form class="col-5 form-header">
        <input type="hidden">
    </form>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($feedbacks as $feedback)
                        <div class="col-4">
                            <div class="card bg-light shadow-sm" style="width: 100%;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-end">
                                        <small class="card-title text-muted">{{ $feedback->created_at->format('M-d-Y') }}</small>
                                    </div>
                                    <h5 class="card-title"><i class="fa-solid fa-id-card me-2"></i>Name :
                                        {{ $feedback->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa-solid fa-envelope me-2"></i>Mail
                                        : {{ $feedback->email }}</h6>
                                    <p class="card-text mt-3"><i class="fa-solid fa-message me-2"></i>
                                        {{ Str::words($feedback->message, 30, '...') }}
                                    </p>

                                    <div class="mt-3 d-flex justify-content-end">
                                        <a class="btn btn-sm bg-primary text-light"
                                           href="{{ route('feedback#view', $feedback->id) }}">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div>
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('jsSourceScript')
    <script type="text/javascript"></script>
@endsection
