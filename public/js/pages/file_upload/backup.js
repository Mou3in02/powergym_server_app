const UPLOAD_NEW_FILE_URL = document.querySelector('meta[name="upload-url"]').content;
const UPLOAD_DELETE_FILE_URL = document.querySelector('meta[name="delete-url"]').content;

$(document).ready(function () {
    $('#uploaded_table').dataTable();

    $('#backup_file').on('change', function () {
        const fileName = this.files[0] ? this.files[0].name : 'Choose file ...';
        $(this).next('.custom-file-label').text(fileName);
    });

    $('#backup_upload_btn').on('click', function () {
        const file = $('#backup_file').prop('files')[0];
        if (!file) { alert("Veuillez choisir un fichier avant de l'envoyer."); $('#backup_file').focus(); return; }

        const formData = new FormData();
        formData.append('file', file);

        $('#uploadProgressBar').css('width','0%').text('0%');
        $('#uploadProgressModal').modal({backdrop:'static',keyboard:false}).modal('show');

        $.ajax({
            xhr: function(){
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(e){
                    if(e.lengthComputable){
                        const percent = Math.round((e.loaded/e.total)*100);
                        $('#uploadProgressBar').css('width', percent+'%').text(percent+'%');
                    }
                }, false);
                return xhr;
            },
            url: UPLOAD_NEW_FILE_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
                $('#uploadProgressBar').css('width','100%').text('100%');
                setTimeout(()=>{
                    $('#uploadProgressModal').modal('hide');
                    $('#backup_file').val(null).next('.custom-file-label').text('Choose file ...');
                    $('#uploadSuccessModal').modal('show');
                },300);
                $('#uploadSuccessModal').on('hidden.bs.modal', function(){ window.location.reload(); });
            },
            error: function(){ $('#uploadProgressModal').modal('hide'); alert('Erreur lors du téléchargement.'); }
        });
    });

    let fileIdToDelete = null;

    $('.delete_file').on('click', function () {
        fileIdToDelete = $(this).data('file-id');
        $('#deleteFileModal').modal('show');
    });

    $('#confirmDeleteFileBtn').on('click', function () {
        if(!fileIdToDelete) return;

        $.ajax({
            url: `${UPLOAD_DELETE_FILE_URL}?fileId=${fileIdToDelete}`,
            method: 'DELETE',
        }).done(function(response){
            $('#deleteFileModal').modal('hide');

            $(`button[data-file-id="${fileIdToDelete}"]`).closest('tr').remove();

            // Afficher modal succès central
            $('#deleteSuccessModal').modal('show');
            setTimeout(()=>$('#deleteSuccessModal').modal('hide'),5000);

        }).fail(function(xhr){
            $('#deleteFileModal').modal('hide');
            alert(xhr.responseJSON?.message || 'Erreur lors de la suppression.');
        });
    });
});
