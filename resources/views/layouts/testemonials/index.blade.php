@extends('layouts.dashboard')
@section('content-testemonial')
{{-- add new Testemonials modal start --}}
<div class="modal fade" id="addTestemonialsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Testemonials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Testemonials_form" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">

              <label for="name_en">name in english</label>
              <input type="text" name="name_en" class="form-control" placeholder="name in english" required>
            </div>
            <div class="col-lg">
              <label for="name_ar">name in arabic</label>
              <input type="text" name="name_ar" class="form-control" placeholder="name in arabic" required>
            </div>
          </div>

          
          <div class="my-2">
            <label for="title_job_en">title job in english</label>
            <input type="text" name="title_job_en" class="form-control" placeholder="title job in english" required>
          </div>
          <div class="my-2">
            <label for="title_job_en">title job</label>
            <input type="text" name="title_job_ar" class="form-control" placeholder="title job in arabic" required>
          </div>

          <div class="my-2">
            <label for="rating">Rating</label>
            <div id="rating"></div>
            <input type="hidden" name="rating" id="rating_value" value="0">
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
          <button type="submit" id="add_Testemonials_btn" class="btn btn-primary">Add Testemonials</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Testemonials modal end --}}

{{-- edit Testemonials modal start --}}
<div class="modal fade" id="editTestemonialsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Testemonials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dashboard.layouts.updatetestemonial.index') }}" method="POST" id="edit_Testemonials_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="testemonial_id" id="testemonial_id">
      <input type="hidden" name="testemonial_image" id="testemonial_image">

        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="name_en">Name in english</label>
              <input type="text" name="name_en"  id="name_en"  class="form-control" placeholder="name in english" required>
            </div>
            <div class="col-lg">
              <label for="name_ar">Name in arabic</label>
              <input type="text" name="name_ar"  id="name_ar" class="form-control" placeholder="name in arabic" required>
            </div>
          </div>

          <div class="my-2">
            <label for="title_job_en">title job in english</label>
            <input type="text" id ="title_job_en"name="title_job_en" class="form-control" placeholder="title job in english" required>
          </div>
          <div class="my-2">
            <label for="title_job_ar">title job</label>
            <input type="text" id = "title_job_ar" name="title_job_ar" class="form-control" placeholder="title job in arabic" required>
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
            <label for="rating">Rating</label>
            <div id="rating1"></div>
            <input type="hidden" name="rating" id="rating_value1" value="0">
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
          <button type="submit" id="edit_Testemonials_btn" class="btn btn-primary">Update Testemonials</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Testemonials modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Testemonials</h3>
            <button class="btn btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#addTestemonialsModal"><i
                class="bi-plus-circle me-2"></i>Add New Testemonials</button>
          </div>
          <div class="card-body" id="show_all_Testemonials">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop