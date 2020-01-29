function linkForm() {
    $("#set-form").html(`
        <div class="form-group">
            <label for="link">Link</label>
            <input name="link" type="text" class="form-control" placeholder="Enter Link" required>
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
                $('#output').html(data);
            },
            error: function(){
                $('#'+id).text('Ошибка! Данные не были отправлены!');
            }
      });
      return false;
    });
});