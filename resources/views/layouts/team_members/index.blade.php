@extends('layouts.dashboard')
@section('contentTeam')
{{-- add new Members modal start --}}
<div class="modal fade" id="addMembersModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Members</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Members_form" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="name_en">name in english</label>
              <input type="text" name="name_en" class="form-control" placeholder="name in english" required>
            </div>
            <div class="col-lg">
              <label for="name_en">name in arabic</label>
              <input type="text" name="name_ar" class="form-control" placeholder="name in english" required>
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
            <label for="twitter">facebook</label>
            <textarea type="text" name="facebook" class="form-control" placeholder="facebook" required></textarea>
          </div>

          <div class="my-2">
            <label for="twitter">twitter</label>
            <textarea type="text" name="twitter" class="form-control" placeholder="twitter" required></textarea>
          </div>

          <div class="my-2">
            <label for="linkedin">linked in</label>
            <textarea type="text" name="linkedin" class="form-control" placeholder=" linkedin" required></textarea>
          </div>

          <div class="my-2">
            <label for="youtube">youtube</label>
            <textarea type="text" name="youtube" class="form-control" placeholder="youtube" required></textarea>
          </div>

          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_Members_btn" class="btn btn-primary">Add Members</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Members modal end --}}


{{-- edit Members modal start --}}
<div class="modal fade" id="editMembersModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Members</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dashboard.layouts.member.updatemember') }}" method="POST" id="edit_Members_form" enctype="multipart/form-data">
      @csrf

      <input type="hidden" name="Member_id" id="Member_id">
      <input type="hidden" name="Member_image" id="Member_image">

        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="name_en">name in english</label>
              <input type="text" name="name_en"  id="name_en"  class="form-control" placeholder="name in english" required>
            </div>
            <div class="col-lg">
              <label for="name_en">name in arabic</label>
              <input type="text" name="name_ar"  id="name_ar" class="form-control" placeholder="name in english" required>
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
            <label for="twitter">facebook</label>
            <textarea type="text" name="facebook" id= "facebook" class="form-control" placeholder="facebook" required></textarea>
          </div>

          <div class="my-2">
            <label for="twitter">twitter</label>
            <textarea type="text" name="twitter" id="twitter" class="form-control" placeholder="twitter" required></textarea>
          </div>

          <div class="my-2">
            <label for="linkedin">linked in</label>
            <textarea type="text" name="linkedin" id = "linkedin" class="form-control" placeholder=" linkedin" required></textarea>
          </div>

          <div class="my-2">
            <label for="youtube">youtube</label>
            <textarea type="text" name="youtube" id="youtube" class="form-control" placeholder="youtube" required></textarea>
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
          <button type="submit" id="edit_Members_btn" class="btn btn-primary">Update Members</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Members modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Members</h3>
            <button class="btn btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#addMembersModal"><i
                class="bi-plus-circle me-2"></i>Add New Members</button>
          </div>
          <div class="card-body" id="show_all_Members">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop