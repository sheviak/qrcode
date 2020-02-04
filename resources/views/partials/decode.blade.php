<div class="form-group text-left">
    <label for="qrcode">{{ trans('page.lblQrcode') }}</label> <br><br>
    <input id="qrcode" name="qrcode" type="file"><br><br>
    <button type="submit" id="decode" class="form-control btn btn-outline-secondary">{{ trans('page.btnDecode') }}</button>
    <input type="hidden" id="selected_form" name="selected_form" value="{{ $page }}">
</div>