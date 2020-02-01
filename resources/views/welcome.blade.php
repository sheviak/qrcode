<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QR-CODE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <script src="../js/jquery.js"></script>
        <script src="../js/forms.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head> 
    <body>
        <div class="flex-center p-3">
            <div class="content">
                <div class="text-right">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('locale', ['locale' => 'en']) }}">EN</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('locale', ['locale' => 'ru']) }}">RU</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('locale', ['locale' => 'ua']) }}">UA</a>
                        </li>
                    </ul>
                </div>

                <div class="title m-b-md">
                    QR-CODE
                </div>
                    
                <div class="links">
                    <a href="link">LINK</a>
                    <a href="email">EMAIL</a>
                    <a href="geo">GEO</a>
                    <a href="tel">TELEPHONE</a>
                    <a href="sms">SMS</a>
                    <a href="wifi">WI-FI</a>
                    <a href="#">VCARD</a>
                    <a href="#">DECODE</a>
                </div>
                <div class="container m-3 p-3">
                    <form id="form-data">
                        <div class="row">
                            <div id="base-settings" class="col-sm">
                                <p>{{ trans('page.lblSettings') }}</p>
                                <div class="form-group text-left">
                                    <label for="background_color">{{ trans('page.bColor') }}</label>
                                    <input name="background_color" type="text" class="form-control" placeholder="{{ trans('page.pceholderBcolor') }}" value="FFFFFF" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="foreground_color">{{ trans('page.fColor') }}</label>
                                    <input name="foreground_color" type="text" class="form-control" placeholder="{{ trans('page.pceholderFcolor') }}" value="000000" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="size">{{ trans('page.sizePicture') }}</label>
                                    <input name="size" type="text" class="form-control" placeholder="{{ trans('page.pceholderSize') }}" value="300" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="margin">{{ trans('page.margin') }}</label>
                                    <input name="margin" type="text" class="form-control" placeholder="{{ trans('page.pceholdermargin') }}" value="1" required>
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
                            </div>
                            <div class="col-sm">
                                <p>{{ trans('page.lblParams') }}</p>
                                <div id="set-form">
                                    @include('partials.' . $page) 
                                </div>
                            </div>
                        </div>
                        <div class="center-block m-3 p-3">
                            <input type="hidden" id="selected_form" name="selected_form" value="{{ $page }}">
                            <!-- <input  type="submit" id="form" value="btn"> -->
                            <input type="button" id='form' class='btn btn-outline-secondary' value="{{ trans('page.create') }}">
                        </div>
                    </form>
                    <div id="output" class="col-sm"></div>
                </div>
            </div>
        </div>
    </body>
</html>