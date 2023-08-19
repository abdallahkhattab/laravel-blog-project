
<script>
// Clear the data in the DataTable

       $(document).ready(function() {
        fetchAllFeatures();
        // Add feature form submission
        $("#add_Features_form").submit(function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            $("#add_Features_btn").text('Adding.....');

            $.ajax({
                url: '/dashboard/features',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Added!',
                        'feature Added Successfully',
                        'success'
                    );

                    $('#add_Features_btn').text('Add feature');
                    $('#add_Features_form')[0].reset();
                    $('#addFeaturesModal').modal('hide');

                    fetchAllFeatures(); // Fetch all Features again to update the table
                }
            });
        });
     
    });

    function fetchAllFeatures() {
        $.ajax({
            url: '{{ route('dashboard.layouts.fetchfeatures.index') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Features").html(res);
     
                initializeDataTables(); // Call the function to initialize DataTables again
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
            url: '/dashboard/editfeature/' + id, // Replace with the actual URL path
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
                $("#feature_id").text(res.id);
                $("#feature_image").text(res.image);
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });
    $("#edit_Features_form").submit(function(e) {
    e.preventDefault();
    var articleId = $("#feature_id").text(); // Get the article id from the element
    const fd = new FormData(this);

    fd.append('id', articleId); // Add the article id to the form data

    $("#edit_Features_btn").text('Updating...');
    $.ajax({
        url: '/dashboard/updatefeature/', // Replace with the actual URL path
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
                fetchAllFeatures(); // Assuming you have a function named fetchAllFeatures to refresh the article list
            }
            $("#edit_Features_btn").text('Update Employee');
            $("#edit_Features_form")[0].reset();
            $("#editFeaturesModal").modal('hide');
        }
    });

    
});
//delete

$(document).on('click', '.deleteIconF', function(e) {
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
                url: '{{ route('dashboard.layouts.deletefeature.index') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Deleted!',
                            'Feature deleted successfully',
                            'success'
                        );
                        fetchAllFeatures();
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
