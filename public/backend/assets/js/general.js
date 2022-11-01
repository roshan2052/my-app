$(document).ready(function() {7
    // onfirmation before delete
    $(document).on("click",".delete-confirm",function(e) {
        e.preventDefault();
        let form =  $(this).closest("form");
        Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

});


