@extends('layouts.app')

@section('title')
    Graphics
@endsection

@section('menu')
    @parent
    <li class="nav-item"><a href="/" class="nav-link">Overview</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Table</a></li>
    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Graphics</a></li>
@endsection

@section('content')
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var items = <?= $data1 ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'date');
            data.addColumn('number', 't, °C');
            for (var i = 0; i < items.length; i++) {
                data.addRows([
                    [`${items[i]['day']}.${items[i]['month']}`,  items[i]['temperature']]
                ]);
            }
            var options = {
                title: 'Graph of temperature conditions',
                width: 1200,
                height: 500,
                vAxes: {
                    0: {title: 'temperature, °C'},
                }
            };
            var chart = new google.charts.Line(document.getElementById('one'));
            chart.draw(data, google.charts.Line.convertOptions(options));
        }


        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var temperatures = <?= $data2 ?>;
            var numbers = <?= $data21 ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Т, °C');
            data.addColumn('number', 't, год');
            data.addColumn({ role: "style" });
            for (var i = 0; i < temperatures.length; i++) {
                data.addRows([
                    [Number(temperatures[i]['temperature']),  Number(numbers[i]['number'])/2, "blue"]
                ]);
            }
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" }]);
            var options = {
                title: 'Diagram of the duration of temperature regimes',
                width: 1300,
                height: 500,
                bar: {groupWidth: "95%"},
                vAxes: {
                    0: {title: 'time, h'},
                },
                hAxes: {
                    0: {title: 'temperature, °C'},
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('two'));
            chart.draw(view, options);
        }


        google.charts.load("current", {'packages':["corechart"]});
        google.charts.setOnLoadCallback(drawChart3);
        function drawChart3() {
            var winds = <?= $data3 ?>;
            var countWinds = <?= $data31 ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string','wind direction');
            data.addColumn('number','number');
            for (var i = 0; i < winds.length; i++) {
                data.addRows([
                    [winds[i][0], Number(countWinds[i][0])]
                ]);
            }
            var options = {
                title: 'Wind direction ratio',
                pieHole: 0.3,
                width: 1300,
                height: 800,
            };
            var chart = new google.visualization.PieChart(document.getElementById('tree'));
            chart.draw(data, options);
        }


        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart4);
        function drawChart4() {
            var speeds = <?= $data4 ?>;
            var numbers = <?= $data41 ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'V, m/s');
            data.addColumn('number', 't, h');
            data.addColumn({ role: "style" });
            for (var i = 0; i < speeds.length; i++) {
                data.addRows([
                    [Number(speeds[i]['wind speed']),  Number(numbers[i]['number'])/2, "blue"]
                ]);
            }
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" }]);
            var options = {
                title: "Distribution of wind potential by velocities",
                width: 1300,
                height: 500,
                bar: {groupWidth: "95%"},
                vAxes: {
                    0: {title: 't, h'},
                },
                hAxes: {
                    0: {title: 'V, m/s'},
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("four"));
            chart.draw(view, options);
        }
    </script>

{{--    <h4 class="pt-3" style="text-align: center!important;">Graph of temperature conditions</h4>--}}
    <div id="one" class="center pt-5" style="display: flex; justify-content: center;"></div>

{{--    <h4 class="pt-5 mt-5" style="text-align: center!important;">Diagram of the duration of temperature regimes</h4>--}}
    <div id="two" class="center pt-5" style="display: flex; justify-content: center;"></div>

{{--    <h4 class="pt-5 mt-5" style="text-align: center!important;">Wind direction ratio</h4>--}}
    <div id="tree" class="center" style="display: flex; justify-content: center;"></div>

{{--    <h4 class="pt-5 mt-5" style="text-align: center!important;">Distribution of wind potential by velocities</h4>--}}
    <div id="four" class="center pb-5" style="display: flex; justify-content: center;"></div>
@endsection
