
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<!-- Your other script imports -->
<script>


    let dataTableInstance; // Variable to store the DataTable instance

function initializeDataTables() {
    if ($.fn.DataTable.isDataTable("table")) {
        // DataTable is already initialized, destroy the existing instance
        dataTableInstance.destroy();
    }

    dataTableInstance = $("table").DataTable({
        order: [[0, 'desc']]
    });
}

function fetchAlltestemonials() {
        $.ajax({
            url: '{{ route('dashboard.layouts.fetchtestemonial.index') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Testemonials").html(res);
     
                initializeDataTables(); // Call the function to initialize DataTables again
            }
        });
    }

$(document).ready(function () {
    $("#rating").rateYo({
      starWidth: "20px",
      rating: 0,
      onChange: function (rating, rateYoInstance) {
        $("#rating_value").val(rating);
      },
    });
  });

  $(document).ready(function () {
    $("#rating1").rateYo({
      starWidth: "20px",
      rating: 0,
      onChange: function (rating, rateYoInstance) {
        $("#rating_value1").val(rating);
      },
    });
  });

  $(document).ready(function() {
    fetchAlltestemonials();
        // Add testemonial form submission
        $("#add_Testemonials_form").submit(function(e) {
            
            e.preventDefault();
            
            const fd = new FormData(this);
            $("#add_testemonials_btn").text('Adding.....');

            $.ajax({
                url: '/dashboard/testemonial',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Added!',
                        'testemonial Added Successfully',
                        'success'
                    );

                    $('#add_testemonials_btn').text('Add testemonial');
                    $('#add_Testemonials_form')[0].reset();
                    $('#addTestemonialsModal').modal('hide');

                    fetchAlltestemonials(); // Fetch all testemonials again to update the table
                }
            });
        });
    });


 

     ///edit


   

        //delete

$(document).on('click', '.deleteIcon', function(e) {
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
                url: '{{ route('dashboard.layouts.deletetestemonial.index') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Deleted!',
                            'Testemonial deleted successfully',
                            'success'
                        );
                        fetchAlltestemonials();
                    } else {
                        Swal.fire(
                            'Error!',
                            
                            'An error occurred while deleting the Testemonial',
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
       // update employee ajax request
  // Inside the click event for editIconT
$(document).on('click', '.editIconT', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
        url: '/dashboard/edittestemonial/' + id,
        method: 'get',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(res) {
            $("#name_en").val(res.name_en);
            $("#name_ar").val(res.name_ar);
            $("#title_job_en").val(res.title_job_en);
            $("#title_job_ar").val(res.title_job_ar);
            $("#description_en").val(res.description_en);
            $("#description_ar").val(res.description_ar);
            $("#image").val(res.avatar);
            $("#image").html(`<img src="{{ asset('storage/images/') }}/${res.avatar}" width="100" class="img-fluid img-thumbnail">`);
            var decimalRating = parseFloat(res.rate);
            $("#rating1").rateYo("rating", decimalRating);
            $("#testemonial_id").val(res.id); // Set the testimonial ID in the input field
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
        }
    });
});

$("#edit_Testemonials_form").submit(function(e) {
    e.preventDefault();
    var testemonialId = $("#testemonial_id").text(); // Get the article id from the element
    const fd = new FormData(this);

    fd.append('id', testemonialId); // Add the article id to the form data

    $("#edit_Features_btn").text('Updating...');
    $.ajax({
        url: '/dashboard/updatetestemonial/', // Replace with the actual URL path
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
                fetchAlltestemonials(); // Assuming you have a function named fetchAllFeatures to refresh the article list
            }
            $("#edit_Testemonials_btn").text('Update Employee');
            $("#edit_Testemonials_form")[0].reset();
            $("#editTestemonialsModal").modal('hide');
        }
    });

});

$(document).on('click', '.deleteIconT', function(e) {
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
                url: '{{ route('dashboard.layouts.deletetestemonial.index') }}',
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
                        fetchAlltestemonials();
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