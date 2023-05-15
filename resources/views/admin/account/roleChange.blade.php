@extends('admin.layout.master')

@section('search')
  <h3 class="form-header">Admin dashboard panel</h3>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
      <div class="container-fluid">
        <div class="col-10 offset-1">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h3 class="text-center title-2">Change Role</h3>
              </div>
              <hr>

              <form action="{{ route('admin#role', $account->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-3 offset-2">
                    @if ($account->image == null)
                      @if ($account->gender == 'male')
                        <img src="{{ asset('image/default_user.jpg') }}" alt="default user" width="100%">
                      @else
                        <img src="{{ asset('image/female_default.png') }}" alt="female_default" width="100%">
                      @endif
                    @else
                      <img class="shadow-sm" src="{{ asset('storage/' . $account->image) }}" alt="admin image"
                           width="100%" />
                    @endif

                    <div class="mt-2">
                      <div class="d-grid mt-2 rounded-3">
                        <button class="btn bg-dark text-light" type="submit"><i
                             class="fa-solid fa-arrow-right-from-bracket me-2"></i>Change</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-5 offset-1">
                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Name</label>
                      <input class="form-control" name="name" type="text" value="{{ old('name', $account->name) }}"
                             aria-required="true" aria-invalid="false" placeholder="Enter Admin Name..." disabled>

                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Role</label>
                      <select class="form-select" name="role">
                        <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                        <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                      </select>
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Email</label>
                      <input class="form-control" name="email" type="email"
                             value="{{ old('email', $account->email) }}" aria-required="true" aria-invalid="false"
                             placeholder="Enter Admin Email..." disabled>

                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Phone Number</label>
                      <input class="form-control " name="phone" type="number"
                             value="{{ old('phone', $account->phone) }}" aria-required="true" aria-invalid="false"
                             placeholder="Enter Admin Phone Number..." disabled>

                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Address</label>
                      <textarea class="form-control" name="address" cols="10" rows="2" placeholder="Enter Admin Address..."
                                disabled>{{ old('address', $account->address) }}</textarea>

                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Gender</label>
                      <select class="form-select" name="gender" disabled>
                        <option value="">Choose your gender...</option>
                        <option value="male" @if (old('gender', $account->gender) == 'male') selected @endif>Male</option>
                        <option value="female" @if (old('gender', $account->gender) == 'female') selected @endif>Female
                        </option>
                      </select>

                    </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN CONTENT-->
  @endsection
