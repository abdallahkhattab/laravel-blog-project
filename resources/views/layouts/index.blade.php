@extends('layouts.dashboard')
@section('content')
{{-- add new Articles modal start --}}
<div class="modal fade" id="addArticlesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Articles</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_Articles_form" enctype="multipart/form-data">
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
          <button type="submit" id="add_Articles_btn" class="btn btn-primary">Add Articles</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new Articles modal end --}}

{{-- edit Articles modal start --}}
<div class="modal fade" id="editArticlesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Articles</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_Articles_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
          </div>
          <div class="my-2">
            <label for="post">Post</label>
            <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
          </div>
          <div class="my-2">
            <label for="avatar">Select Avatar</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_Articles_btn" class="btn btn-success">Update Articles</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit Articles modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-blue d-flex justify-content-between align-items-left">
            <h3 class="text-light">Manage Articles</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addArticlesModal"><i
                class="bi-plus-circle me-2"></i>Add New Articles</button>
          </div>
          <div class="card-body" id="show_all_Articles">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>


@stop