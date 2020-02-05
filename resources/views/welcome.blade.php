<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QR-CODE</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/forms.js"></script>
        <link rel="stylesheet" href="../fonts/nunito.css">
        <link rel="stylesheet" href="../styles/bootstrap.min.css">
        <link rel="stylesheet" href="../styles/style.css">
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
                <div class="title m-b-md">QR-CODE</div>
                <div class="links">
                    <a href="link">{{ trans('page.titleLink') }}</a>
                    <a href="email">{{ trans('page.titleEmail') }}</a>
                    <a href="geo">{{ trans('page.titleGeo') }}</a>
                    <a href="tel">{{ trans('page.titlePhone') }}</a>
                    <a href="sms">{{ trans('page.titleSms') }}</a>
                    <a href="wifi">{{ trans('page.titleWifi') }}</a>
                    <a href="vcard">{{ trans('page.titleVcard') }}</a>
                    <a href="decode">{{ trans('page.titleDecode') }}</a>
                </div>
                <div class="container m-3 p-3">
                    <form id="form-data" action="javascript:void(0)" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            @if($page != "decode")         
                                @include('partials.defaultParams')   
                                <div class="col-sm">
                                    <p>{{ trans('page.lblParams') }}</p>
                                    <div id="set-form">
                                        @include('partials.' . $page) 
                                    </div>
                                </div>       
                            @else
                                @include('partials.decode')        
                            @endif
                        </div>
                        @if($page != "decode") 
                            <div class="center-block m-3 p-3">
                                <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
                                <input type="hidden" id="selected_form" name="selected_form" value="{{ $page }}">
                                <button type="submit" id='form' class='btn btn-outline-secondary'>{{ trans('page.create') }}</button>
                            </div>
                        @endif
                    </form>
                    <div id="output" class="col-sm"></div>
                </div>
            </div>
        </div>
    </body>
</html>