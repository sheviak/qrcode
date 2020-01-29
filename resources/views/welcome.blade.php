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
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    QR-CODE
                </div>

                <div class="links">
                    <a href="#" onclick="linkForm();">LINK</a>
                    <a href="#" onclick="emailForm();">EMAIL</a>
                    <a href="#" onclick="geoForm();">GEO</a>
                    <a href="#" onclick="telForm();">TELEPHONE</a>
                    <a href="#" onclick="smsForm();">SMS</a>
                    <a href="#" onclick="wifiForm();">WI-FI</a>
                    <a href="#" onclick="vcardForm();">VCARD</a>
                    <a href="#" onclick="decode();">DECODE</a>
                </div>

                <div class="container m-3 p-3">

                    <form id="form-data">
                        <div class="row">
                            <div id="base-settings" class="col-sm">
                                <p>Settings</p>
                                <div class="form-group text-left">
                                    <label for="background_color">Background color</label>
                                    <input name="background_color" type="text" class="form-control" placeholder="Enter Background color" value="FFFFFF" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="foreground_color">Foreground color</label>
                                    <input name="foreground_color" type="text" class="form-control" placeholder="Enter Foreground color" value="000000" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="size">Size (px)</label>
                                    <input name="size" type="text" class="form-control" placeholder="Enter Size" value="300" required>
                                </div>
                                <div class="form-group text-left">
                                    <label for="errors_correction">Error correction</label> <!--  Коррекция ошибок -->
                                    <select name="errors_correction" class="form-control" required>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="Q">Q</option>
                                        <option value="H">H</option>
                                    </select>
                                </div>
                                <div class="form-group text-left">
                                    <label for="format">Set format output file</label> <!-- формат  -->
                                    <select name="format" class="form-control" required>
                                        <option value="png">PNG</option>
                                        <option value="eps">EPS</option>
                                        <option value="svg">SVG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <p>Parameters</p>
                                <div id="set-form">
                                    <!-- install form -->
                                    <div class="form-group text-left">
                                        <label for="link">Link</label>
                                        <input name="link" type="text" class="form-control" placeholder="Enter Link" required>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="center-block">
                            <input type="hidden" id="selected_form" name="selected_form" value="link">
                            <!-- <input  type="submit" id="form" value="btn"> -->
                            <input type="button" id='form' style = 'cursor: pointer;' value="Create">
                        </div>
                    </form>

                    <div id="output" class="col-sm">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
