<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Zxing\QrReader;

class DecodeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $qrcodeName = "";

    public function index(Request $request)
    {
        if($request->hasFile('qrcode')) {
            $this->qrcodeName = bin2hex(random_bytes(5));
            $file = $request->file('qrcode');
            $file->move(public_path() . '/decode_qrcode', $this->qrcodeName . '.png');

            $qrcode = new QrReader(public_path() . '/decode_qrcode/' . $this->qrcodeName . '.png');
            return $qrcode->text();
        } else {
            return json_encode(['error' => "You don`t selected file!"]);
        }
    }
}