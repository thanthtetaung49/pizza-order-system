@extends('admin.layout.master')

@section('search')
  <h3 class="form-header">Admin dashboard panel</h3>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3 offset-8">
            <a href="{{ route('category#listPage') }}"><button class="btn btn-lg bg-dark text-white my-3">Category List</button></a>
          </div>
        </div>
        <div class="col-lg-6 offset-3">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h3 class="text-center title-2">Create Category Form</h3>
              </div>
              <hr>
              <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                @csrf
                <div class="form-group">
                  <label class="control-label mb-1" for="category">Name</label>
                  <input class="form-control @error('categoryName') is-invalid @enderror" id="category"
                         name="categoryName" type="text" value="{{ old('categoryName') }}" aria-required="true"
                         aria-invalid="false" placeholder="Seafood...">
                  @error('categoryName')
                    <div class="invalid-feedback">
                      <span>{{ $message }}</span>
                    </div>
                  @enderror
                </div>

                <div class="d-grid mt-3">
                  <button class="btn btn-lg btn-info btn-block" id="category-button" type="submit">
                    <span id="category-button-amount">Create</span>
                    <i class="fa-solid fa-circle-right"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END MAIN CONTENT-->
@endsection
