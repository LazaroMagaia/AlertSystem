<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use App\Models\apache_service_dbs;
use App\Models\user_server_dbs;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function index(Request $request){
        $domain_name = $request->domain;
        $request->validate(['domain'=>'required'],
        ['domain.required'=>'O campo dominiu(url) não deve estar vazio']);
        $ValidateDomain = $this->ValidateDomain($domain_name);
        if($ValidateDomain)
        {
            $searchDomain = apache_service_dbs::where("name_url",$domain_name)->first();
            $ap_serv_bd = array();
            $domain = $this->searchDomain($domain_name);
            if($domain)
            {
                if($searchDomain)
                {
                    $ap_serv_bd["status"] = true;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain->update($ap_serv_bd);
                    return redirect()->route("index")
                    ->with('mensagem', 'Com sucesso!')->with("response",true);
                }else
                {
                    $ap_serv_bd["name_url"]= $domain_name;
                    $ap_serv_bd["status"] = true;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $searchDomain = apache_service_dbs::create($ap_serv_bd);
                    return redirect()->route("index")
                    ->with('mensagem', 'Com sucesso!')->with("response",true);
                }
            }else
            {
                if($searchDomain)
                {
                    $ap_serv_bd["status"] = false;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain->update($ap_serv_bd);
                    return redirect()->route("index")
                    ->with('mensagem', 'Sem sucesso!')->with("response",false);
                }else
                {
                    $ap_serv_bd["name_url"]= $domain_name;
                    $ap_serv_bd["status"] = false;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $searchDomain = apache_service_dbs::create($ap_serv_bd);
                    return redirect()->route("index")
                    ->with('mensagem', 'Sem sucesso!')->with("response",false);
                }
            }
        }else
        {
            echo "Invalido";
        }
    }
    public function store(Request $request)
    {
        $request->validate(['url_name'=>'required'],
        ['url_name.required'=>'O campo Novo site não deve estar vazio']);
        $domain_name = $request->url_name;
        $data = [];
        $domain_validate = $this->ValidateDomain($domain_name);
        if($domain_validate)
        {
            $searchDomain = user_server_dbs::where("url_name",$domain_name)
            ->where("user_id",Auth::user()->id)->exists();
            $ap_serv_bd = array();
            $domain = $this->searchDomain($domain_name);
            if($searchDomain)
            {
                echo "ja existe este site";
            }else
            if($domain)
            {
                $data["url_name"] = $domain_name;
                $data['status'] = true;
                $data["user_id"] = Auth::user()->id;
                $data['date_time_reset'] = new DateTime();
                $tb = user_server_dbs::create($data);
                return redirect()->route("alert.index");
            }else
            {
                $data["url_name"] = $domain_name;
                $data['status'] = false;
                $data["user_id"] = Auth::user()->id;
                $data['date_time_reset'] = new DateTime();
                $tb = user_server_dbs::create($data);
                return redirect()->route("alert.index");
            }
        }else
        {
            echo "dominio invalido";
        }
    }
    public function alert_update($id, Request $request)
    {
        $request->validate(['url_name'=>'required|unique:user_server_dbs,url_name,'.$id.',id'],
        ['url_name.required'=>'O campo Novo site não deve estar vazio']);
        $domain_name = $request->url_name;
        $data = [];
        $domain_validate = $this->ValidateDomain($domain_name);
        if($domain_validate)
        {
            $domain = $this->searchDomain($domain_name);
            if($domain)
            {
                $data["url_name"] = $domain_name;
                $data['status'] = true;
                $data["user_id"] = Auth::user()->id;
                $data['date_time_reset'] = new DateTime();
                $domainUpdate = user_server_dbs::where("url_name",$domain_name)
                ->where("user_id",Auth::user()->id)->update($data);
                return redirect()->route("alert.index");
            }else
            {
                $data["url_name"] = $domain_name;
                $data['status'] = false;
                $data["user_id"] = Auth::user()->id;
                $data['date_time_reset'] = new DateTime();
                $domainUpdate = user_server_dbs::where("url_name",$domain_name)
                ->where("user_id",Auth::user()->id)->update($data);
                return redirect()->route("alert.index");
            }
        }else
        {
            echo "site invalido";
        }
    }
    public function destroy($id)
    {
        $domainUpdate = user_server_dbs::find($id);
        if($domainUpdate)
        {
            $domainUpdate->delete();
            return redirect()->route("alert.index");
        }else
        {
            echo "delete com sucesso";
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
