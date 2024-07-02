<?php
namespace helper;

require_once __DIR__ . '/../vendor/phpqrcode/qrlib.php';

class QrUtils
{
    public static function generarQR($url, $path)
    {
        \QRcode::png($url, $path, QR_ECLEVEL_L, 3);
    }
}
?>
