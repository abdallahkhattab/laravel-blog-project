<script>
 // Clear the data in the DataTable




function initializeDataTables() {
    if ($.fn.DataTable.isDataTable("table")) {
        // DataTable is already initialized, destroy the existing instance
        dataTableInstance.destroy();
    }

    dataTableInstance = $("table").DataTable({
        order: [[0, 'desc']]
    });
}

function fetchAllMembers() {
        $.ajax({
            url: '{{ route('dashboard.layouts.fetchtemember.fetchall') }}',
            method: 'GET',
            success: function(res) {
                $("#show_all_Members").html(res);
     
                initializeDataTables(); // Call the function to initialize DataTables again
            }
        });
    }


 $(document).ready(function() {
        fetchAllMembers();
        // Add feature form submission
        $("#add_Members_form").submit(function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            $("#add_Members_btn").text('Adding.....');

            $.ajax({
                url: '/dashboard/member',
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

                    $('#add_Members_btn').text('Add feature');
                    $('#add_Members_form')[0].reset();
                    $('#addMembersModal').modal('hide');

                    fetchAllMembers(); // Fetch all Features again to update the table
                }
            });
        });
     
    });

      ///edit
      $(document).on('click', '.editIconM', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '/dashboard/editemember/' + id, // Replace with the actual URL path
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $("#name_en").val(res.name_en);
                $("#name_ar").val(res.name_ar);
                $("#description_en").val(res.description_en);
                $("#description_ar").val(res.description_ar);
                $("#facebook").val(res.facebook);
                $("#twitter").val(res.twitter);
                $("#youtube").val(res.youtube);
                $("#linkedin").val(res.linkedin);
                $("#image").html(
                    `<img src="{{ asset('storage/images/') }}/${res.image}" width="100" class="img-fluid img-thumbnail">`
                );
                $("#Member_id").text(res.id);
                $("#Member_image").text(res.image);
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });

    $("#edit_Members_form").submit(function(e) {
    e.preventDefault();
    var memberId = $("#Member_id").text(); // Get the article id from the element
    const fd = new FormData(this);

    fd.append('id', memberId); // Add the article id to the form data

    $("#edit_Members_btn").text('Updating...');
    $.ajax({
        url: '/dashboard/updatemember/', // Replace with the actual URL path
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
                    'Team Member Updated Successfully!',
                    'success'
                );
                fetchAllMembers(); // Assuming you have a function named fetchAllFeatures to refresh the article list
            }
            $("#edit_Members_btn").text('Update Team Member');
            $("#edit_Members_form")[0].reset();
            $("#editMembersModal").modal('hide');
        }
    });

});

$(document).on('click', '.deleteIconM', function(e) {
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
                url: '{{ route('dashboard.layouts.member.delete') }}',
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
                        fetchAllMembers();
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
