$(document).ready(function () {
  $("#sign-in-link").click(function () {
    $("#sign-in-form-container").fadeIn(500);
  });

  $("#sign-up-link").click(function () {
    $("#sign-in-form-container").hide();
  });

  $("#signInForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "ajax/login.php",
      { formData: $(this).serialize() },
      function (data) {
        console.log(data);
        if (data.success === true) {
          window.location.reload();
        } else {
          errors_data = "<ul>";
          for (var i = 0; i < data.errors.length; i++) {
            errors_data += "<li>" + data.errors[i] + "</li>";
          }
          errors_data += "</ul>";
          $("#signInForm .alert-errors").html(errors_data).hide().fadeIn(1000);
        }
      },
      "json"
    );
  });
});
