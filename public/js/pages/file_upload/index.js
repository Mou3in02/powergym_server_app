$(document).ready(function () {
    $('#uploaded_table').dataTable();
    $('#backup_file').on('change', function () {
        const fileName = this.files[0] ? this.files[0].name : 'Choose file ...';
        $(this).next('.custom-file-label').text(fileName);
    });
    $('#backup_upload_btn').on('click', function () {
        const file = $('#backup_file').prop('files')[0];
        if (!file) {
            $('#backup_file').focus();
            return;
        }
        const formData = new FormData();
        formData.append('file', file);
        Swal.fire({
            title: 'Uploading',
            text: "Uploading file en cours ...",
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        $.ajax({
            url: UPLOAD_NEW_FILE_URL,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (_) {
            $('#backup_file').val(null).next('.custom-file-label').text('Choose file ...');
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'File uploaded successfully',
                timer: 4000,
                timerProgressBar: true
            }).then(() => {
                window.location.reload();
            })
        }).fail(function (_) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Upload failed. Please try again.',
                timer: 5000,
                timerProgressBar: true
            });
        });
    });

    $('.delete_file').on('click', function () {
        const fileId = $(this).data('file-id');
        if(!fileId) return;
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
                    url: `${UPLOAD_DELETE_FILE_URL}?fileId=${fileId}`,
                    method: 'DELETE',
                }).done(function (_) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'File deleted successfully',
                        timer: 4000,
                    }).then(() => {
                        window.location.reload();
                    })
                }).fail(function (_) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Deleted failed. Please try again.',
                        timer: 5000,
                    });
                });
            }
        })
    })
})