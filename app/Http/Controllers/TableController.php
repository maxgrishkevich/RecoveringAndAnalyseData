<?php

namespace App\Http\Controllers;

use App\Models\Lviv;

class TableController
{
    function index()
    {
        return view('table');
    }

    function getDataByMonthAndDay()
    {
        $model = new Lviv();
        return view('table', ['data' => $model->where('month', '=', $_GET['month'])
            ->where('day', '=', $_GET['day'])->orderBy('time')->get()]);
    }
}