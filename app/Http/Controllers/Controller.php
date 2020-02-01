<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use BaconQrCode\Writer;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $qrcode;
    var $path = "qrcode_images/";

    public function index(Request $request)
    {
        // тут надо сделать проверку 
        // code..
        //TODO:: vCard, Decode qr-code
        // добавить свойство Margin (поле) QrCode::margin(100);

        $this->qrcode = new BaconQrCodeGenerator();
        $this->SetDefaultValue($request);
        $this->path = $this->path . bin2hex(random_bytes(5)) . '.' . $request->format;

        switch($request->selected_form){
            case "link":
                $this->createLink($request);
            break;
            case "email":
                $this->createEmail($request);
            break;
            case "geo":
                $this->createGeo($request);
            break;
            case "phoneNumber":
                $this->createPhoneNumber($request);
            break;
            case "sms":
                $this->createSMS($request);
            break;
            case "wifi":
                $this->createWiFi($request);
            break;
        }

        return json_encode(['qrcode_url' => $this->path]);
    }

    public function SetDefaultValue(Request $baseVal)
    {
        $bcolor = $this->HexToRgb($baseVal->background_color);
        $fcolor = $this->HexToRgb($baseVal->foreground_color);

        return $this->qrcode
            ->format($baseVal->format)
            ->encoding('UTF-8')
            ->errorCorrection($baseVal->errors_correction)
            ->size($baseVal->size)
            ->margin($baseVal->margin)
            ->color($fcolor[0], $fcolor[1], $fcolor[2])
            ->backgroundColor($bcolor[0], $bcolor[1], $bcolor[2]);
    }

    // создание ссылки
    function createLink(Request $request)
    {
        $this->qrcode->generate($request->link, $this->path);
    }

    // создание Email
    function createEmail(Request $request)
    {
        file_put_contents(
            $this->path, 
            $this->qrcode->email(
                $request->email,
                $request->theme,
                $request->message
            )
        );
    }

    function createGeo(Request $request)
    {
        file_put_contents(
            $this->path, 
            $this->qrcode->geo(
                $request->latitude,
                $request->longitude
            )
        );
    }

    function createPhoneNumber(Request $request)
    {
        file_put_contents(
            $this->path,
            $this->qrcode->phoneNumber($request->phoneNumber)
        );
    }

    // проверить с другого тел на распознование
    function createSMS(Request $request)
    {
        file_put_contents(
            $this->path,
            $this->qrcode->SMS($request->phoneNumber, $request->message)
        );
    }

    function createWiFi(Request $request)
    {
        if($request->hidden != null && 
            $request->hidden == "on" && 
            $request->ssid != "" && 
            $request->pass != "" &&
            $request->typeNetwork != ""){

            file_put_contents(
                $this->path,
                $this->qrcode->wiFi([
                    'encryption' => $request->typeNetwork,
                    'ssid' => $request->ssid,
                    'password' => $request->pass,
                    'hidden' => true
                ])
            );
        }

        // Подключается к открытой сети WiFi.
        if($request->hidden == null && 
            $request->pass == "" &&
            $request->ssid == "" &&
            $request->typeNetwork == ""){

            file_put_contents(
                $this->path,
                $this->qrcode->wiFi([
                    'ssid' => $request->ssid,
                ])
            );
        }

        // Подключается к открытой, скрытой сети WiFi.
        if($request->hidden == "on" && 
            $request->ssid != "" &&
            $request->pass == "" &&
            $request->typeNetwork == ""){
            
            file_put_contents(
                $this->path,
                $this->qrcode->wiFi([
                    'ssid' => $request->ssid,
	                'hidden' => 'true'
                ])
            );
        }

        // Подключается к защищенной сети.
        if($request->hidden == null &&
            $request->ssid != "" &&
            $request->pass != "" &&
            $request->typeNetwork != ""){
            
            file_put_contents(
                $this->path,
                $this->qrcode->wiFi([
                    'ssid' => $request->ssid,
                    'encryption' => $request->typeNetwork,
                    'password' => $request->pass
                ])
            );
        }
    }
    
    // перевод цвета из HEX в RGB
    function HexToRgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
}