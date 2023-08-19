@extends('layouts.dashboard')
@section('content-plan')
{{-- add new Plans modal start --}}
<div class="modal fade" id="addPlansModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Plans</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Plans_form" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="title_en">Title in english</label>
              <input type="text" name="title_en" id="#title_en" class="form-control" placeholder="Title in english" required>
            </div>
            <div class="col-lg">
              <label for="title_ar">Title in arabic</label>
              <input type="text" name="title_ar" class="form-control" placeholder="Title in english" required>
            </div>
          </div>
          <div class="my-2">
            <label for="title_time_en">title time in english</label>
            <textarea type="email" name="title_time_en" class="form-control" placeholder="title_time_en" required></textarea>
          </div>
          
          <div class="my-2">
            <label for="title_time_en">title time in arabic</label>
            <textarea type="email" name="title_time_ar" class="form-control" placeholder="title_time_ar" required></textarea>
          </div>
          


          <div class="col-lg">
            <label for="price">price</label>
            <input type="text" name="price" class="form-control" placeholder="price" required>
          </div>
          <div class="col-lg">
            <label for="price">hdd space</label>
            <input type="hdd_en" name="hdd_en" class="form-control" placeholder="hdd space" required>
          </div>
       
          <div class="col-lg">
            <label for="price">email_num</label>
            <input type="email_num" name="email_num" class="form-control" placeholder="email_num" required>
          </div>
          <div class="col-lg">
            <label for="price">subdomain_num</label>
            <input type="subdomain_num" name="subdomain_num" class="form-control" placeholder="subdomain_num" required>
          </div>
          <div class="col-lg">
            <label for="price">database_num</label>
            <input type="database_num" name="database_num" class="form-control" placeholder="database_num" required>
          </div>
          <div class="col-lg">
            <label for="price">support_type</label>
            <input type="support_type" name="support_type" class="form-control" placeholder="support_type" required>
          </div>
          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_Plans_btn" class="btn btn-primary">Add Plans</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Plans modal end --}}


{{-- edit Plans modal start --}}
<div class="modal fade" id="editPlansModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Plans</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dashboard.layouts.plan.updateplan') }}" method="POST" id="edit_Plans_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="plan_id" id="plan_id">
      <input type="hidden" name="plan_image" id="plan_image">

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
            <label for="description_en">title time in english</label>
            <textarea type="email" name="description_en" id="title_time_en" class="form-control" placeholder="description in english" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">title time in arabic</label>
            <textarea type="text" name="description_ar"  id="title_time_ar" class="form-control" placeholder="description in arabic" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">hdd space</label>
            <textarea type="text" name="hdd_en"  id="hdd_en" class="form-control" placeholder="hdd space" required></textarea>
          </div>
         
          <div class="my-2">
            <label for="description_ar">email_num</label>
            <textarea type="text" name="email_num"  id="email_num" class="form-control" placeholder="email_num" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">subdomain_num</label>
            <textarea type="text" name="subdomain_num"  id="subdomain_num" class="form-control" placeholder="subdomain_num" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">database_num</label>
            <textarea type="text" name="database_num"  id="database_num" class="form-control" placeholder="database_num" required></textarea>
          </div>
          <div class="my-2">
            <label for="description_ar">support_type</label>
            <textarea type="text" name="support_type"  id="support_type" class="form-control" placeholder="support_type" required></textarea>
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
          <button type="submit" id="edit_Plans_btn" class="btn btn-primary">Update Plans</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Plans modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Plans</h3>
            <button class="btn btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#addPlansModal"><i
                class="bi-plus-circle me-2"></i>Add New Plans</button>
          </div>
          <div class="card-body" id="show_all_Plans">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop