function linkForm() {
    $("#selected_form").val("link");
    $("#output").empty();
    $("#set-form").html(`
        <div class="form-group text-left">
            <label for="link">Link</label>
            <input name="link" type="text" class="form-control" placeholder="Enter Link" required>
        </div>`);
}

function emailForm(){
    $("#selected_form").val("email");
    $("#output").empty();
    $("#set-form").html(`
        <div class="form-group text-left">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Enter Email" required>
        </div>
        <div class="form-group text-left">
            <label for="theme">Theme</label>
            <input name="theme" type="text" class="form-control" placeholder="Enter Theme" required>
        </div>
        <div class="form-group text-left">
            <label for="message">Message</label>
            <input name="message" type="text" class="form-control" placeholder="Enter Message" required>
        </div>
        `);
}

function geoForm() {
    $("#selected_form").val("geo");
    $("#output").empty();
    $("#set-form").html(`
        <div class="form-group text-left">
            <label for="latitude">Latitude</label>
            <input name="latitude" type="text" class="form-control" placeholder="Enter Latitude" required>
        </div>
        <div class="form-group text-left">
            <label for="longitude">Longitude</label>
            <input name="longitude" type="text" class="form-control" placeholder="Enter Longitude" required>
        </div>
        `);
}

function telForm() {
    $("#selected_form").val("phoneNumber");
    $("#output").empty();
    $("#set-form").html(`
        <div class="form-group text-left">
            <label for="phoneNumber">Phone number</label>
            <input name="phoneNumber" type="text" class="form-control" placeholder="Enter Phone number" required>
        </div>`);
}

function smsForm() {
    $("#selected_form").val("sms");
    $("#output").empty();
    $("#set-form").html(`
        <div class="form-group text-left">
            <label for="phoneNumber">Phone number</label>
            <input name="phoneNumber" type="text" class="form-control" placeholder="Enter Phone number" required>
        </div>
        <div class="form-group text-left">
            <label for="message">Message</label>
            <input name="message" type="text" class="form-control" placeholder="Enter Message" required>
        </div>`);
}


$(document).ready(function(){
    $("#form").click(function() {
        var form_data = $('#form-data').serialize();
        $.ajax({
            type: "GET",
            url: "/api",
            datatype: JSON,
            data: form_data,
            success: function(data) {
                let resObj = $.parseJSON(data);
                $('#output').html('<img src=../' + resObj.qrcode_url +'>');
            },
            error: function(){
                $('#'+id).text('Ошибка! Данные не были отправлены!');
            }
      });
      return false;
    });
});
