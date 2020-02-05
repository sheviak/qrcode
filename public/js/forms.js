$(document).ready(function(e){

    $("#reset").click(function(e){
        $("#logo").val("");
    });

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#form-data").on("submit",(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let flag = $("#selected_form").val() != "decode" ? true : false;
        $.ajax({
            type: "POST",
            url: flag ? "/api" : "/api/decode",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                if(!flag){
                    $('#output').html(data);
                } else {
                    let resObj = $.parseJSON(data);  
                    if(resObj.qrcode_url != null)
                        $('#output').html('<img src=../' + resObj.qrcode_url + '><br><a href=../' + resObj.qrcode_url + ' download><img src="../icons/download.png"></a>');
                    else 
                        $('#output').html(resObj.error);
                }
            },
            error: function(){
                $('#output').text('Error! No data was sent');
            }
        });
        return false;
    }));
});