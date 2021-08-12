$(document).ready(function () {
  $("form").on("submit", function (event) {
    $.ajax({
      type: 'POST',
      url: 'send_mail_v2.php',
      data: $(this).serialize(),
      success: function (result) {
        document.getElementById("sucessMessage").innerHTML = result;
      }
    });
  });
});