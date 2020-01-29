<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
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

        $this->qrcode = new BaconQrCodeGenerator();
        $this->SetDefaultValue($request);
        $path = $this->path . bin2hex(random_bytes(5)) . '.' . $request->format;

        switch($request->selected_form){
            case "link":
                $this->createLink($request, $path);
                return $path;
            break;
        }
    }

    public function SetDefaultValue(Request $baseVal)
    {
        $bcolor = $this->HexToRgb($baseVal->background_color);
        $fcolor = $this->HexToRgb($baseVal->foreground_color);

        return $this
            ->qrcode
            ->format($baseVal->format)
            ->encoding('UTF-8')
            ->errorCorrection($baseVal->errors_correction)
            ->size($baseVal->size)
            ->color($fcolor[0], $fcolor[1], $fcolor[2])
            ->backgroundColor($bcolor[0], $bcolor[1], $bcolor[2]);
    }

    // создание ссылки
    function createLink(Request $requestLink, $path)
    {
        $this->qrcode->generate($requestLink->link, $path);
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