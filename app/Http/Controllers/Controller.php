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

    private $qrcode = null;
    private $path = "qrcode_images/";
    private $logoName = "";

    public function index(Request $request)
    {
        $this->path = $this->path . bin2hex(random_bytes(5)) . '.' . $request->format;
        $this->logoName = bin2hex(random_bytes(5));

        $this->qrcode = new BaconQrCodeGenerator();
        $this->CreateWithLogoIfExist($request);
        $this->SetDefaultValue($request);
        
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
            case "tel":
                $this->createPhoneNumber($request);
            break;
            case "sms":
                $this->createSMS($request);
            break;
            case "wifi":
                $this->createWiFi($request);
            break;
            case "vcard":
                $this->createVCard($request);
            break;
            default:
                return json_encode(['error' => "Incorrect data!"]);
        }
        
        return json_encode(['qrcode_url' => $this->path]);
    }

    function CreateWithLogoIfExist(Request $request)
    {
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file->move(public_path() . '/logo', $this->logoName . '.png');
            $this->qrcode
                ->format('png')
                ->merge(public_path() . '/logo' . '/' . $this->logoName . '.png', .3, true)
                ->errorCorrection('H');
        } else {
            $this->qrcode
                ->format($request->format)
                ->errorCorrection($request->errors_correction);
        }
    }

    function SetDefaultValue(Request $baseVal)
    {
        $bcolor = $this->HexToRgb($baseVal->background_color);
        $fcolor = $this->HexToRgb($baseVal->foreground_color);

        $this->qrcode
            ->size($baseVal->size)
            ->encoding('UTF-8')
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

    function createVCard(Request $request)
    {
        $content = "BEGIN:VCARD" . "\n";
        $content .= "VERSION:3.0" . "\n";
        $content .= "N:" . $request->lastName . ";" . $request->firstName . ";" . $request->secondName . "\n";
        $content .= "EMAIL:" . $request->email . "\n";
        $content .= "TEL;TYPE=cell:" . $request->phoneNumberHome . "\n";
        $content .= "TEL;TYPE=work:" . $request->phoneNumberWork . "\n";
        $content .= "ORG:" . $request->company . "\n";
        $content .= "TITLE:" . $request->position . "\n";
        $content .= "URL:" . $request->website . "\n";
        $content .= "ADR;TYPE=home:" . $request->address . "\n";
        $content .= "END:VCARD" . "\n";

        $this->qrcode->generate($content, $this->path);
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