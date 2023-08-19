@extends('layouts.dashboard')
@section('content-setting')
{{-- add new Services modal start --}}
<div class="modal fade" id="addServicesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Services</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Services_form" enctype="multipart/form-data" >
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
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_Services_btn" class="btn btn-primary">Add Services</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Services modal end --}}


{{-- edit Services modal start --}}
<div class="modal fade" id="editServicesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Services</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dashboard.layouts.service.updateservice') }}" method="POST" id="edit_Services_form" enctype="multipart/form-data">
      @csrf

      <input type="hidden" name="service_id" id="service_id">
      <input type="hidden" name="logo" id="logo">

        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="title_en">name in english</label>
              <input type="text" name="name_en"  id="name_en"  class="form-control" placeholder="Title in english" required>
            </div>
            <div class="col-lg">
              <label for="title_en">name in arabic</label>
              <input type="text" name="name_ar"  id="name_ar" class="form-control" placeholder="Title in english" required>
            </div>
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
          <button type="submit" id="edit_Services_btn" class="btn btn-primary">Update Services</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Services modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Services</h3>
            <button class="btn btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#addServicesModal"><i
                class="bi-plus-circle me-2"></i>Add New Services</button>
          </div>
          <div class="card-body" id="show_all_Services">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop