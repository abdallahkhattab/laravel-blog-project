<script>

    $(document).ready(function() {
        fetchAllPlan();
        // Add feature form submission
        $("#add_Plans_form").submit(function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            $("#add_Plans_btn").text('Adding.....');

            $.ajax({
                
                url: '/dashboard/plan',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Added!',
                        'plan Added Successfully',
                        'success'
                    );

                    $('#add_Plans_btn').text('Add plans');
                    $('#add_Plans_form')[0].reset();
                    $('#addPlansModal').modal('hide');

                    fetchAllPlan(); // Fetch all Features again to update the table
                }
            });
        });
     
    });
    function initializeDataTables() {
    if ($.fn.DataTable.isDataTable("table")) {
        // DataTable is already initialized, destroy the existing instance
        dataTableInstance.destroy();
    }

    dataTableInstance = $("table").DataTable({
        order: [[0, 'desc']]
    });
}

function fetchAllPlan() {
        $.ajax({
            url: '{{ route('dashboard.layouts.plan.fetch') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Plans").html(res);
     
                initializeDataTables(); // Call the function to initialize DataTables again
            }
        });
    }

    $(document).on('click', '.editIconP', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '/dashboard/editeplan/' + id, // Replace with the actual URL path
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $("#title_en").val(res.title_en);
                $("#title_ar").val(res.title_ar);
                $("#title_time_en").val(res.title_time_en);
                $("#title_time_ar").val(res.title_time_ar);
                $("#image").html(
                    `<img src="{{ asset('storage/images/') }}/${res.image}" width="100" class="img-fluid img-thumbnail">`
                );
                $("#plan_id").val(res.id); // Set the testimonial ID in the input field
                $("#plan_image").text(res.image);

            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });

    $("#edit_Plans_form").submit(function(e) {
    e.preventDefault();
    var planId = $("#plan_id").text(); // Get the article id from the element
    const fd = new FormData(this);

    fd.append('id', planId); // Add the article id to the form data

    $("#edit_Plans_btn").text('Updating...');
    $.ajax({
        url: '/dashboard/updateplan/', // Replace with the actual URL path
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
                    'plan Updated Successfully!',
                    'success'
                );
                fetchAllPlan(); // Assuming you have a function named fetchAllFeatures to refresh the article list
            }
            $("#edit_Plans_btn").text('Update plan');
            $("#edit_Plans_form")[0].reset();
            $("#editPlansModal").modal('hide');
        }
    });

    
});

$(document).on('click', '.deleteIconP', function(e) {
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
                url: '{{ route('dashboard.layouts.plan.delete') }}',
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status == 200) {
                        
                        Swal.fire(
                            'Deleted!',
                            'Team member deleted successfully',
                            'success'
                        );
                        fetchAllPlan();
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