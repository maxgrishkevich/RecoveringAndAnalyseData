<?php

namespace App\Http\Controllers;

use App\Models\Lviv;

class OverviewController extends Controller
{
    function index()
    {
        return view('overview');
    }

    function allData()
    {
        $model = new Lviv();
        return view('overview', ['data' => [
            'January' => [$model->select('day')->where('month', 1)->groupBy('day')->orderBy('day', 'asc')->get()],
            'February' => [$model->select('day')->where('month', 2)->groupBy('day')->orderBy('day', 'asc')->get()],
            'March' => [$model->select('day')->where('month', 3)->groupBy('day')->orderBy('day', 'asc')->get()],
            'April' => [$model->select('day')->where('month', 4)->groupBy('day')->orderBy('day', 'asc')->get()],
            'May' => [$model->select('day')->where('month', 5)->groupBy('day')->orderBy('day', 'asc')->get()],
            'June' => [$model->select('day')->where('month', 6)->groupBy('day')->orderBy('day', 'asc')->get()],
            'July' => [$model->select('day')->where('month', 7)->groupBy('day')->orderBy('day', 'asc')->get()],
            'August' => [$model->select('day')->where('month', 8)->groupBy('day')->orderBy('day', 'asc')->get()],
            'September' => [$model->select('day')->where('month', 9)->groupBy('day')->orderBy('day', 'asc')->get()],
            'October' => [$model->select('day')->where('month', 10)->groupBy('day')->orderBy('day', 'asc')->get()],
            'November' => [$model->select('day')->where('month', 11)->groupBy('day')->orderBy('day', 'asc')->get()],
            'December' => [$model->select('day')->where('month', 12)->groupBy('day')->orderBy('day', 'asc')->get()],
        ]]);
    }
}