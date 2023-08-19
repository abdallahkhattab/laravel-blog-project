@extends('layouts.dashboard')
@section('content-article')
{{-- add new Features modal start --}}
<div class="modal fade" id="addFeaturesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Features</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Features_form" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="title_en">Title in english</label>
              <input type="text" name="title_en" class="form-control" placeholder="Title in english" required>
            </div>
            <div class="col-lg">
              <label for="title_en">Title in arabic</label>
              <input type="text" name="title_ar" class="form-control" placeholder="Title in english" required>
            </div>
          </div>
          <div class="my-2">
            <label for="description_en">description in english</label>
            <textarea type="email" name="description_en" class="form-control" placeholder="description in english" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">description in arabic</label>
            <textarea type="text" name="description_ar" class="form-control" placeholder="description in arabic" required></textarea>
          </div>
          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_Features_btn" class="btn btn-primary">Add Features</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Features modal end --}}


{{-- edit Features modal start --}}
<div class="modal fade" id="editFeaturesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Features</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dashboard.layouts.updatefeature.index') }}" method="POST" id="edit_Features_form" enctype="multipart/form-data">
      @csrf

      <input type="hidden" name="feature_id" id="feature_id">
      <input type="hidden" name="feature_image" id="feature_image">

        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="title_en">Title in english</label>
              <input type="text" name="title_en"  id="title_en"  class="form-control" placeholder="Title in english" required>
            </div>
            <div class="col-lg">
              <label for="title_en">Title in arabic</label>
              <input type="text" name="title_ar"  id="title_ar" class="form-control" placeholder="Title in english" required>
            </div>
          </div>
          <div class="my-2">
            <label for="description_en">description in english</label>
            <textarea type="email" name="description_en" id="description_en" class="form-control" placeholder="description in english" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">description in arabic</label>
            <textarea type="text" name="description_ar"  id="description_ar" class="form-control" placeholder="description in arabic" required></textarea>
          </div>
          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image"  class="form-control" required>
          </div>
          <div class="mt-2" id="image">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_Features_btn" class="btn btn-primary">Update Features</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Features modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Features</h3>
            <button class="btn btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#addFeaturesModal"><i
                class="bi-plus-circle me-2"></i>Add New Features</button>
          </div>
          <div class="card-body" id="show_all_Features">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop