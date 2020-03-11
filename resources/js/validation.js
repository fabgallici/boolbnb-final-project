function formApartValidation() {
  $('.addApartForm').parsley();

  $('.addApartForm').parsley().on('field:error', function (ParsleyField) {
    ParsleyField.$element.addClass('is-invalid');
    console.log('fired error');
  });
  $('.addApartForm').parsley().on('field:success', function (ParsleyField) {
    ParsleyField.$element.removeClass('is-invalid');
  });
  var $createApart = $('.apartment-submit');
  $('.addApartForm').parsley().on('form:error', function () {

    if ($createApart.hasClass('btn-primary')) {
      $('.apartment-submit').removeClass('btn-primary').addClass('btn-danger');
    }
  });

  $('.addApartForm').parsley().on('field:success', function () {

    if ($createApart.hasClass('btn-danger')) {
      $('.apartment-submit').removeClass('btn-danger').addClass('btn-primary');
    }
  }); //comm
}