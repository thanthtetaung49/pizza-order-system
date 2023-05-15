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
                <h3 class="text-center title-2">Edit Admin Account</h3>
              </div>
              <hr>

              <form action="{{ route('admin#updateAccount', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-4 offset-1">
                    @if (Auth::user()->image == null)
                      @if (Auth::user()->gender == 'male')
                        <img src="{{ asset('image/default_user.jpg') }}" alt="default user" style="height: 250px"
                             width="100%">
                      @else
                        <img src="{{ asset('image/female_default.png') }}" alt="female_default" style="height: 250px"
                             width="100%">
                      @endif
                    @else
                      <img class="shadow-sm" src="{{ asset('storage/' . Auth::user()->image) }}" alt="admin image"
                           style="height: 250px" width="100%" />
                    @endif

                    <div class="mt-2">
                      <div class="form-group">
                        <input class="form-control form-control-sm @error('image') is-invalid @enderror" name="image"
                               type="file">
                        @error('image')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="d-grid mt-2 rounded-3">
                        <button class="btn bg-dark text-light" type="submit"><i
                             class="fa-solid fa-arrow-right-from-bracket me-2"></i>Done</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-5 offset-1">
                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Name</label>
                      <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                             value="{{ old('name', Auth::user()->name) }}" aria-required="true" aria-invalid="false"
                             placeholder="Enter Admin Name...">
                      @error('name')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Email</label>
                      <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                             value="{{ old('email', Auth::user()->email) }}" aria-required="true" aria-invalid="false"
                             placeholder="Enter Admin Email...">
                      @error('email')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Phone Number</label>
                      <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number"
                             value="{{ old('phone', Auth::user()->phone) }}" aria-required="true" aria-invalid="false"
                             placeholder="Enter Admin Phone Number...">
                      @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Address</label>
                      <textarea class="form-control @error('address') is-invalid @enderror" name="address" cols="10" rows="2"
                                placeholder="Enter Admin Address...">{{ old('address', Auth::user()->address) }}</textarea>
                      @error('address')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Gender</label>
                      <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                        <option value="">Choose your gender...</option>
                        <option value="male" @if (old('gender', Auth::user()->gender) == 'male') selected @endif>Male</option>
                        <option value="female" @if (old('gender', Auth::user()->gender) == 'female') selected @endif>Female
                        </option>
                      </select>
                      @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label class="control-label mb-1">Admin Role</label>
                      <input class="form-control" name="role" type="text"
                             value="{{ old('role', Auth::user()->role) }}" placeholder="Enter Admin Role..." disabled>
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
