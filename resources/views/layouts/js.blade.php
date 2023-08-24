<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<!-- Your other script imports -->
<script src="{{ asset('assets/dashboard/dist/js/adminlte.min.js') }}"></script>

<script>
   var table = $("#DataTables_Table_0").DataTable();

// Clear the data in the DataTable
table.clear().draw();

    $(document).ready(function() {
        fetchAllArticles();
        // Add article form submission
        $("#add_Articles_form").submit(function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            $("#add_Articles_btn").text('Adding.....');

            $.ajax({
                url: '/dashboard/articles',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Added!',
                        'Article Added Successfully',
                        'success'
                    );

                    $('#add_Articles_btn').text('Add Article');
                    $('#add_Articles_form')[0].reset();
                    $('#addArticlesModal').modal('hide');

                    fetchAllArticles(); // Fetch all articles again to update the table
                }
            });
        });
    });

    function fetchAllArticles() {
        $.ajax({
            url: '{{ route('dashboard.layouts.fetchArticle.index') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Articles").html(res);
                if (table) {
                            table.destroy();
                        }
            }
        });
    }

    function initializeDataTables() {
        $("table").DataTable({
            order: [
                [0, 'desc']
            ]
        });
    }
    ///edit
    $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '/dashboard/edit/' + id, // Replace with the actual URL path
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $("#title_en").val(res.title_en);
                $("#title_ar").val(res.title_ar);
                $("#description_en").val(res.description_en);
                $("#description_ar").val(res.description_ar);
                $("#image").html(
                    `<img src="{{ asset('storage/images/') }}/${res.image}" width="100" class="img-fluid img-thumbnail">`
                );
                $("#article_id").text(res.id);
                $("#article_image").text(res.image);
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });


    // update employee ajax request
    $("#edit_Articles_form").submit(function(e) {
    e.preventDefault();
    var articleId = $("#article_id").text(); // Get the article id from the element
    const fd = new FormData(this);

    fd.append('id', articleId); // Add the article id to the form data

    $("#edit_Articles_btn").text('Updating...');
    $.ajax({
        url: '/dashboard/update/', // Replace with the actual URL path
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == 200) {
                Swal.fire(
                    'Updated!',
                    'Article Updated Successfully!',
                    'success'
                );
                fetchAllArticles(); // Assuming you have a function named fetchAllArticles to refresh the article list
            }
            $("#edit_Articles_btn").text('Update Employee');
            $("#edit_Articles_form")[0].reset();
            $("#editArticlesModal").modal('hide');
        }
    });
});


//delete

$(document).on('click', '.deleteIconA', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('dashboard.layouts.delete.index') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Deleted!',
                            'Article deleted successfully',
                            'success'
                        );
                        fetchAllArticles();
                    } else {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the article',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    
});


});
   
</script>
