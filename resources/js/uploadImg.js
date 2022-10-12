 $(".avatar").change(function(){
    $(".file-name").text(this.files[0].name);
});

    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#upload-file')
    .attr('src', e.target.result);
};

    reader.readAsDataURL(input.files[0]);
}
}
