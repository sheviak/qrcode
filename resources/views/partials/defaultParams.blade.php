<div id="base-settings" class="col-sm">
    <p>{{ trans('page.lblSettings') }}</p>
    <div class="form-group text-left">
        <label for="background_color">{{ trans('page.bColor') }}</label>
        <input name="background_color" type="text" class="form-control" placeholder="{{ trans('page.placeholderBcolor') }}" value="FFFFFF" required>
    </div>
    <div class="form-group text-left">
        <label for="foreground_color">{{ trans('page.fColor') }}</label>
        <input name="foreground_color" type="text" class="form-control" placeholder="{{ trans('page.placeholderFcolor') }}" value="000000" required>
    </div>
    <div class="form-group text-left">
        <label for="size">{{ trans('page.sizePicture') }}</label>
        <input name="size" type="text" class="form-control" placeholder="{{ trans('page.placeholderSize') }}" value="300" required>
    </div>
    <div class="form-group text-left">
        <label for="margin">{{ trans('page.margin') }}</label>
        <input name="margin" type="text" class="form-control" placeholder="{{ trans('page.placeholdermargin') }}" value="1" required>
    </div>
    <div class="form-group text-left">
        <label for="errors_correction">{{ trans('page.error_correction') }}</label>
        <select name="errors_correction" class="form-control" required>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="Q">Q</option>
            <option value="H">H</option>
        </select>
    </div>
    <div class="form-group text-left">
        <label for="format">{{ trans('page.formatFile') }}</label>
        <select name="format" class="form-control" required>
            <option value="png">PNG</option>
            <option value="eps">EPS</option>
            <option value="svg">SVG</option>
        </select>
    </div>
    <div class="form-group text-left">
        <label for="logo">{{ trans('page.logo') }}</label>
        <input id="logo" name="logo" type="file" accept=".png"><br><br>
        <input id="reset" type="button" value="{{ trans('page.btnFile') }}" class="form-control btn btn-outline-secondary">
    </div>
</div>