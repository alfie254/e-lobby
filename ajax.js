$(document).ready(function() {
  $("#dept").change(function() {
    var country_id = $(this).val();
    if(country_id != "") {
      $.ajax({
        url:"index.php",
        data:{c_id:country_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#staff").html(resp);
        }
      });
    } else {
      $("#staff").html("<option value=''>------- Select --------</option>");
    }
  });
});