<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index(Request $request){
        $request->validate(['domain'=>'required'],
        ['domain.required'=>'O campo dominiu(url) não deve estar vazio']);
        $domain = $request->domain;
        $ValidateDomain = $this->ValidateDomain($domain);
        if($ValidateDomain)
        {
            echo "Valido";
        }else
        {
            echo "Invalido";
        }
    }
    public function ValidateDomain($domain)
    {
        if(strstr($domain, "@"));
        list($domain) = explode("@",$domain);
        return (checkdnsrr($domain)) ? true:false;
    }
    public function searchDomain($domain)
    {
        $ch = curl_init($domain);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if( $httpcode >= 200 && $httpcode < 400 ){
            return true;
        } else {
            return false;
        }
    }
}
