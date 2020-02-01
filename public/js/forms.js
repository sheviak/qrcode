$(document).ready(function(){
    $("#form").click(function() {
        let form_data = $('#form-data').serialize();
        $.ajax({
            type: "GET",
            url: "/api",
            datatype: JSON,
            data: form_data,
            success: function(data) {
                let resObj = $.parseJSON(data);  
                if(resObj.qrcode_url != null)
                    $('#output').html('<img src=../' + resObj.qrcode_url +'>');
                else 
                    $('#output').html(resObj.error);
            },
            error: function(){
                $('#output').text('Ошибка! Данные не были отправлены!');
            }
      });
      return false;
    });
});