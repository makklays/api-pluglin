<?php 
/**
 * Author: Alexander Kuziv
 * E-mail: hola.kuziv@gmail.com
 * Fecha: idi ! 
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class Content 
{
    // 
    final function url_request($url, $limit = 100, $offset = 0) {
        // proba url
        if (empty($url)) return false;
        
        // obtenemos los datos por url
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query([
            //'limit' => $limit,
            //'offset' => $offset,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POSTREDIR, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mi Agent 1.0 para obtener el contenido');
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        return $result;
    } 
}