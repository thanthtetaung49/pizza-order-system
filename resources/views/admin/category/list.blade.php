@extends('admin.layout.master')

@section('search')
    <form class="form-header" action="{{ route('category#listPage') }}" method="GET">
        <input class="au-input au-input--xl" name="search" type="text" value="{{ request('search') }}"
               placeholder="Search for categories..." />
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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="btn btn-dark position-relative" type="button">
                               <i class="fa-solid fa-cheese"></i>
                                <span
                                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $categories->total() }}
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

                    @if ($categories->total() != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-M-y h:m') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a class="me-2"
                                                       href="{{ route('category#editPage', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        <tr class="spacer"></tr>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-muted text-center mt-5">There is no category here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-4">
                        {{ $categories->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
