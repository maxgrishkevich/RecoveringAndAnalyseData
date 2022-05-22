<?php

namespace App\Http\Controllers;

use App\Models\Lviv;
use Illuminate\Database\Eloquent\Collection;

class GraphicsController
{
    function index()
    {
        return view('graphics');
    }

    function getDataByPeriod()
    {
        $model = new Lviv();

        $date_from = explode('-', $_GET['date1']);
        $date_to = explode('-', $_GET['date2']);


        $first_month = $model->where('month', '=', (int)$date_from[1])
            ->where('day', '>=', (int)$date_from[2]);
        $last_month = $model->where('month', '=', (int)$date_to[1])
            ->where('day', '<=', (int)$date_to[2]);
        $between = $model->where('month', '>', (int)$date_from[1])
            ->where('month', '<', (int)$date_to[1]);
        $data1 = $first_month->union($last_month)->union($between)->orderBy('month', 'asc')
            ->orderBy('day', 'asc')->orderBy('time', 'asc');



        $all_temperatures = $model->select('temperature')->where('month', '=', (int)$date_from[1])
            ->where('day', '>=', (int)$date_from[2])->union($model->select('temperature')
                ->where('month', '=', (int)$date_to[1])->where('day', '<=', (int)$date_to[2]))
            ->union($model->select('temperature')->where('month', '>', (int)$date_from[1])
                ->where('month', '<', (int)$date_to[1]))->groupBy('temperature')->get();
        $data2 = new Collection();
        $data21 = new Collection();
        $data1 = $data1->get();
        foreach ($all_temperatures as $temperature){
            $counter = 0;
            foreach ($data1 as $value){
                if($temperature['temperature'] === $value['temperature']){
                    ++$counter;
                }
            }
            $data2->add(['temperature' => (string)$temperature['temperature']]);
            $data21->add(['number' => (string)$counter]);
        }



        $data3 = new Collection();
        $data31 = new Collection();
        $winds = ['N' => 'north', 'S' => 'south', 'E' => 'east', 'W' => 'west', 'NE' => 'northeast',
            'NW' => 'northwest', 'SE' => 'southeast', 'SW' => 'southwest', 'Variable' => 'variable'];
        foreach (array_keys($winds) as $wind){
            $counter = 0;
            foreach ($data1 as $value){
                if($wind === $value['wind direction']){
                    ++$counter;
                }
            }
            $data3->add([$winds[$wind]]);
            $data31->add([(string)$counter]);
        }



        $all_speeds = $model->select('wind speed')->where('month', '=', (int)$date_from[1])
            ->where('day', '>=', (int)$date_from[2])->union($model->select('wind speed')
                ->where('month', '=', (int)$date_to[1])->where('day', '<=', (int)$date_to[2]))
            ->union($model->select('wind speed')->where('month', '>', (int)$date_from[1])
                ->where('month', '<', (int)$date_to[1]))->groupBy('wind speed')->get();
        $data4 = new Collection();
        $data41 = new Collection();
        foreach ($all_speeds as $speed){
            $counter = 0;
            foreach ($data1 as $value){
                if($speed['wind speed'] === $value['wind speed']){
                    ++$counter;
                }
            }
            $data4->add(['wind speed' => (string)$speed['wind speed']]);
            $data41->add(['number' => (string)$counter]);
        }


        return view('graphics', [
            'data1' => $data1,

            'data2' => $data2,
            'data21' => $data21,

            'data3' => $data3,
            'data31' => $data31,

            'data4' => $data4,
            'data41' => $data41
            ]);
    }
}