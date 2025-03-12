$('.confirm-price-btn').click(function () {
    let id = $(this).data('id');
    let caseId = $(this).data('case-id');
    let donerId = $(this).data('doner-id');
    let type = $(this).data('type');
    let image = $(this).data('image');

    console.log(image);
    console.log(id);

    $('#id').val(id); 
    $('#case_id').val(caseId);
    $('#type').val(type);
    $('#doner_id').val(donerId); 

    $('#image img').attr('src', image);

});
