<div class="form-group text-left">
    <label for="ssid">{{ trans('page.lblSsid') }}</label>
    <input name="ssid" type="text" class="form-control" placeholder="{{ trans('page.pceholderSsid') }}">
</div>
<div class="form-group text-left">
    <label for="pass">{{ trans('page.lblPass') }}</label>
    <input name="pass" type="text" class="form-control" placeholder="{{ trans('page.pceholderPass') }}">
</div>
<div class="form-group text-left">
    <label for="typeNetwork">{{ trans('page.lblTypeNetwork') }}</label>
    <select name="typeNetwork" class="form-control">
        <option value="none">{{ trans('page.encryption') }}</option> <!-- No encryption -->
        <option value="WPA/WPA2">WPA/WPA2</option>
        <option value="WEP">WEP</option>
    </select>
</div>
<div class="form-group text-left">
    <label for="hidden">{{ trans('page.hidden') }}</label>
    <input name="hidden" class="form-control" type="checkbox">
</div>