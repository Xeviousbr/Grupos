<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Financeiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{

    public function Frutas()
    {
        return view('mapas.index');
    }

    public function NaEpoca()
    {
        return view('mapas.naepoca');
    }

    public function NovaFruta()
    {
        return view('mapas.novafruta');
    }

}
