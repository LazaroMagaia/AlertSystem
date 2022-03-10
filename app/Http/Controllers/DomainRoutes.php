<?php

namespace App\Http\Controllers;

use App\Models\apache_service_dbs;
use App\Models\down_up_servers;
use App\Models\static_servers;
use App\Models\User;
use App\Models\user_server_dbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainRoutes extends Controller
{
    public function index()
    {
        $server = apache_service_dbs::orderByDesc("time_search")->limit(10)->get();
        return view("index",[
            "servers" => $server
        ]);
    }
    public function alert_Index(){
        $user_id = Auth::user()->id;
        $server = user_server_dbs::where("user_id",$user_id)->get();
        return view("admin.alert.index",["servers"=>$server]);
    }
    public function alert_edit($id){
        $server = user_server_dbs::where("id",$id)->first();
        return view("admin.alert.edit",["servers"=>$server]);
    }
    public function alert_show($id)
    {
        $server = user_server_dbs::find($id);
        $downUpServer = down_up_servers::where("site_id",$id)->first();
        $downServer = static_servers::where("site_id",$id)->first();
        $site = user_server_dbs::find($id);
        $user = User::find($site->user_id);
        return view("admin.alert.show",[
            "server"=>$server,
            "down"=>$downServer,
            "downUpServer"=>$downUpServer,
            "user" => $user
        ]);
    }
}
