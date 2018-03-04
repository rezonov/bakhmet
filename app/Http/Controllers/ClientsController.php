<?php

namespace App\Http\Controllers;
use App\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    //
    public function Record(Request $request)
    {
        dump($request);
        $Users = new Clients();
        $Users->name = $request->name;
        $Users->email = $request->email;
        $Users->message = $request->message;
        $Users->save();

    }

    public function Show() {
        $Clients = Clients::all();

        return view('admin/clients', ['fnames' => $Clients]);
    }

    public function ShowClient($id) {
        $Clients = Clients::where('id', $id)->first();

        return view ('admin/client', ['item' => $Clients]);
    }
}
