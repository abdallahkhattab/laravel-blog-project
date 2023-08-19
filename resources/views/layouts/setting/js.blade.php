<script>
function initializeDataTables() {
    if ($.fn.DataTable.isDataTable("table")) {
        // DataTable is already initialized, destroy the existing instance
        dataTableInstance.destroy();
    }

    dataTableInstance = $("table").DataTable({
        order: [[0, 'desc']]
    });
}

function fetchAllServices() {
        $.ajax({
            url: '{{ route('dashboard.layouts.service.fetch') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Services").html(res);
     
                initializeDataTables(); // Call the function to initialize DataTables again
            }
        });
    }

$(document).ready(function() {
    fetchAllServices();
        // Add service form submission
        $("#add_Services_form").submit(function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            $("#add_Services_btn").text('Adding.....');

            $.ajax({
                url: '/dashboard/service',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Added!',
                        'Services Added Successfully',
                        'success'
                    );

                    $('#add_Services_btn').text('Add Service');
                    $('#add_Services_form')[0].reset();
                    $('#addServicesModal').modal('hide');
                    fetchAllServices(); // Fetch all Services again to update the table
                }
                
            });
        });
     
    });
    $(document).on('click', '.editIconS', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '/dashboard/editservice/' + id, // Replace with the actual URL path
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $("#name_en").val(res.name_en);
                $("#name_ar").val(res.name_ar);
                $("#image").html(
                    `<img src="{{ asset('storage/images/') }}/${res.logo}" width="100" class="img-fluid img-thumbnail">`
                );
                $("#service_id").text(res.id);
                $("#service_image").text(res.logo);
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });




    $("#edit_Services_form").submit(function(e) {
    e.preventDefault();
    var serviceId = $("#service_id").val(); // Use .val() to get the service ID
    const fd = new FormData(this);

    fd.append('id', serviceId); // Add the service ID to the form data

    $("#edit_Services_btn").text('Updating...');
    $.ajax({
        url: '{{ route('dashboard.layouts.service.updateservice') }}',
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
                    'Service Updated Successfully!',
                    'success'
                );
                fetchAllServices(); // Assuming you have a function named fetchAllServices to refresh the service list
            }
            $("#edit_Services_btn").text('Update Service');
            $("#edit_Services_form")[0].reset();
            $("#editServicesModal").modal('hide');
        }
    });
});

$(document).on('click', '.deleteIconS', function(e) {
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
                url: '{{ route('dashboard.layouts.service.delete') }}',
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
                        fetchAllServices();
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