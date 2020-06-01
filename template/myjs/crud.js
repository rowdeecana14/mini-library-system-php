var CRUD = {
    path: "",
    param: "",
    run: function() {
        return ajaxRun(this.path, this.param);
    }
}

function ajaxRun(path, param) {
    var response_data;
    $.ajax({
        async: false,
        url: path,
        //dataType: 'json',
        type: "POST",
        data: param,
        success: function(response) {   
          response_data = response;
        },
        error: function(){
          showError("error");
        }
    });

    return response_data;
}

function showError(message) {
    swal({
        title: 'Error',
        text: message,
        type : 'error',
        showConfirmButton: true,
        confirmButtonText: 'Okay',
        confirmButtonColor: 'blue',
        timer: 4000
    });

    $('.sa-confirm-button-container button').removeClass('sa-btn-success');
    $('.sa-confirm-button-container button').addClass('sa-btn-error');

}


function showSuccess(message) {
    swal({
        title: 'Saved',
        text: message,
        type : 'success',
        showConfirmButton: true,
        confirmButtonText: 'Okay',
        confirmButtonColor: 'blue',
        timer: 4000
    });
    $('.sa-confirm-button-container button').removeClass('sa-btn-error');
    $('.sa-confirm-button-container button').addClass('sa-btn-success');
}

function showSuccessLogin(message) {
    swal({
        title: 'Success',
        text: message,
        type : 'success',
        showConfirmButton: true,
        confirmButtonText: 'Okay',
        confirmButtonColor: 'blue',
        timer: 4000
    });
    $('.sa-confirm-button-container button').removeClass('sa-btn-error');
    $('.sa-confirm-button-container button').addClass('sa-btn-success');
}