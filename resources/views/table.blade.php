@extends('layouts.app')

@section('title')
  Table
@endsection

@section('menu')
  @parent
  <li class="nav-item"><a href="/" class="nav-link">Overview</a></li>
  <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Table</a></li>
  <li class="nav-item"><a href="#" class="nav-link">Graphics</a></li>
@endsection

@section('content')
    <h2 style="text-align: center!important;"><?= $_GET['day']?> <?=$_GET['m']?> 2012</h2>
    <div style="padding-left: 10% !important; padding-right: 10% !important;">
    <table class="table table-sm" style="text-align: center!important;">
      <thead>
        <tr>
          <th scope="col">time</th>
          <th scope="col">temperature, &#176C</th>
          <th scope="col">wind direction</th>
          <th scope="col">wind speed, m/s</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($data as $item): ?>
      <?php
      if ($item['wind direction'] === 'N'){
        $item['wind direction'] = 'north';
      }elseif ($item['wind direction'] === 'S'){
        $item['wind direction'] = 'south';
      }elseif ($item['wind direction'] === 'E'){
        $item['wind direction'] = 'east';
      }elseif ($item['wind direction'] === 'W'){
        $item['wind direction'] = 'west';
      }elseif ($item['wind direction'] === 'NE'){
        $item['wind direction'] = 'northeast';
      }elseif ($item['wind direction'] === 'NW'){
        $item['wind direction'] = 'northwest';
      }elseif ($item['wind direction'] === 'SE'){
        $item['wind direction'] = 'southeast';
      }elseif ($item['wind direction'] === 'SW'){
        $item['wind direction'] = 'southwest';
      }elseif ($item['wind direction'] === 'Variable'){
        $item['wind direction'] = 'variable';
      }
      ?>
        <tr>
          <td><?= $item['time'] ?></td>
          <td><?= $item['temperature'] ?></td>
          <td><?= $item['wind direction'] ?></td>
          <td><?= $item['wind speed'] ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
@endsection
