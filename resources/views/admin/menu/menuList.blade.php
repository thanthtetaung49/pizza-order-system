@extends('admin.layout.master')

@section('search')
    <form class="form-header" action="{{ route('menu#list') }}" method="GET">
        <input class="au-input au-input--xl" name="search" type="text" value="{{ request('search') }}"
               placeholder="Search for pizza menu list..." />
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
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Menu List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('menu#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add menu
                                </button>
                            </a>

                            <button class="btn btn-dark position-relative" type="button">
                                <i class="fa-solid fa-file-lines"></i>
                                <span
                                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $menus->total() }}
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

                    @if ($menus->total() != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Menu Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>View</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr class="tr-shadow">
                                            <td>
                                                <img class="shadown-sm" src="{{ asset('storage/' . $menu->image) }}"
                                                     alt="{{ $menu->image }}" style="width: 100%">
                                            </td>
                                            <td class="">{{ $menu->name }}</td>
                                            <td>{{ Str::words($menu->description, 10, '...') }}</td>
                                            <td>{{ $menu->category_name }}</td>
                                            <td>{{ $menu->price }} Kyats</td>
                                            <td>{{ $menu->view_count }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('menu#details', $menu->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a class="mx-1" href="{{ route('menu#editPage', $menu->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('menu#delete', $menu->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-muted text-center mt-5">There is no menu list here!</h3>
                    @endif

                    <div class="mt-3">
                        {{ $menus->appends(request()->query())->links() }}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
