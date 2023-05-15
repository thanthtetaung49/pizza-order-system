@extends('admin.layout.master')

@section('search')
    <form class="form-header" action="{{ route('admin#userList') }}" method="GET">
        <input class="au-input au-input--xl" name="search" type="text" value="{{ request('search') }}"
               placeholder="Search for users..." />
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
                    <div class="d-flex justify-content-between mb-2">
                        <h2 class="title-1">Users List</h2>
                        <div class="">
                            <button class="btn btn-dark position-relative" type="button">
                                <i class="fa-solid fa-users"></i>
                                <span
                                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $users->total() }}
                                </span>
                            </button>
                        </div>
                    </div>

                    @if (count($users) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($users as $user)
                                        <tr class="tr-shadow" id="tableRow">
                                            <td class="align-middle">{{ $user->name }}
                                                <input id="userId" type="hidden" value="{{ $user->id }}">
                                            </td>
                                            <td class="align-middle col-2">
                                                @if ($user->image != null)
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                         alt="{{ $user->image }}">
                                                @else
                                                    @if ($user->gender == 'male')
                                                        <img src="{{ asset('image/default_user.jpg') }}"
                                                             alt="male default photo">
                                                    @else
                                                        <img src="{{ asset('image/female_default.png') }}"
                                                             alt="female default photo">
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $user->phone }}</td>
                                            <td class="align-middle">{{ $user->gender }}</td>
                                            <td class="align-middle">{{ $user->address }}</td>
                                            <td class="align-middle">
                                                <select class="form-select user-role" id="role" name="role">
                                                    <option value="admin"
                                                            @if ($user->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user"
                                                            @if ($user->role == 'user') selected @endif>User</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a class="me-2" href="{{ route('userList#edit', $user->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('userList#delete', $user->id) }}">
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
                        <h3 class="text-muted text-center mt-5">There is user list.</h3>
                    @endif
                    <!-- END DATA TABLE -->

                    <div class="mt-3">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('jsSourceScript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".user-role").change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "get",
                    url: "/ajax/adminPanel/userList",
                    data: {
                        "userId": $(this).parents("tr").find("#userId").val(),
                        "userRole": $(this).val()
                    },
                    dataType: "dataType",
                });

                location.reload();
            });
        });
    </script>
@endsection
