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
            <a href="{{ route('menu#list') }}"><button class="btn btn-lg bg-dark text-white my-3">Menu List</button></a>
          </div>
        </div>
        <div class="col-lg-6 offset-3">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h3 class="text-center title-2">Create Menu</h3>
              </div>
              <hr>
              <form action="{{ route('menu#create') }}" method="post" enctype="multipart/form-data"
                    novalidate="novalidate">
                @csrf
                <div class="form-group mb-3">
                  <label>Menu Name</label>
                  <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                         value="{{ old('name') }}" placeholder="Enter menu name...">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label>Menu Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" type="text"
                            rows="5" placeholder="Enter menu description...">{{ old('description') }}</textarea>
                  @error('description')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label>Menu Category</label>
                  <select class="form-select @error('category') is-invalid @enderror" name="category">
                    <option value="">Choose menu category...</option>

                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                  </select>
                  @error('category')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label>Menu Photo</label>
                  <input class="form-control @error('image') is-invalid @enderror" name="image" type="file">
                  @error('image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label>Menu Price</label>
                  <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                         value="{{ old('price') }}" placeholder="Enter menu price...">
                  @error('price')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label>Menu Waiting Time</label>
                  <input class="form-control @error('time') is-invalid @enderror" name="time" type="text"
                         value="{{ old('time') }}" placeholder="Enter waiting time...">
                  @error('time')
                    <small class="text-danger">{{ $message }}</small>
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
