@extends('admin.layout.master')

@section('search')
    <form class="form-header" action="{{ route('admin#adminsList') }}" method="GET">
        <input class="au-input au-input--xl" name="search" type="text" value="{{ request('search') }}"
               placeholder="Search for admins account..." />
        <button class="au-btn--submit bg-dark text-light" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class=" d-flex justify-content-between mb-2">
                        <h2 class="title-1">Admins List</h2>
                        <div class="">
                            <button class="btn btn-dark position-relative" type="button">
                                <i class="fa-solid fa-users"></i>
                                <span
                                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $admins->total() }}
                                </span>
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="d-flex justify-content-end mt-3">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>

                                        <td class="col-2">
                                            @if ($admin->image == null)
                                                @if ($admin->gender == 'male')
                                                    <img class="shadow-sm" src="{{ asset('image/default_user.jpg') }}"
                                                         alt="male_default" width="100%">
                                                @else
                                                    <img class="shadow-sm" src="{{ asset('image/female_default.png') }}"
                                                         alt="female_default" width="100%">
                                                @endif
                                            @else
                                                <img class="shadow-sm" src="{{ asset('storage/' . $admin->image) }}"
                                                     alt="{{ $admin->image }}" width="100%">
                                            @endif
                                        </td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->gender }}</td>
                                        <td>{{ $admin->address }}</td>
                                        <td>
                                            @if (Auth::user()->id != $admin->id)
                                                <div class="table-data-feature">
                                                    <a class="me-2" href="{{ route('admin#changeRole', $admin->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Change admins role">
                                                            <i class="fa-solid fa-people-arrows"></i>
                                                        </button>
                                                    </a>
                                                    <a class="me-2" href="{{ route('admins#delete', $admin->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach

                            </tbody>

                        </table>
                        <div>
                            {{ $admins->appends(request()->query())->links() }}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
