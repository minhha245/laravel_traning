
$(document).ready(function () {

    $(".confirmDelete").click(function () {
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Are you sure ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Cancel',
            cancelButtonColor: "#d33",
            confirmButtonText: 'Ok',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = "/admin/" + record + "/delete/" + recordid;
            }
        });
    });

});

function sortByField(field) {
    let type_inner = '';
    let params = new URLSearchParams(location.search);
    let currentType = params.get('sort_type');

    type_inner=currentType == 'asc' ? 'desc':'asc'
    params.set('sort_field', field);
    params.set('sort_type', type_inner);
    location.search = params.toString();
    console.log(params.toString());
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

