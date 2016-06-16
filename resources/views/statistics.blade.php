@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Статистика</div>
                <div class="panel-body">
                    <p>
                        <b>Игр сегодня:</b>&nbsp;&nbsp;{{ $statistics->count() }}
                    </p>
                    <p>
                        <b>Сумма игр сегодня:</b>&nbsp;&nbsp;{{ $statistics->sum('sum') }}
                    </p>
                    <p>
                        <b>Количество зарегестрированных пользователей:</b>&nbsp;&nbsp;{{ $users_total }}
                    </p>
                    <p>
                        <b>Количество новых пользователей за день:</b>&nbsp;&nbsp;{{ $users_today }}
                    </p>
                    <hr>
                    <h3 class="text-center">График доходов</h3>
                    <canvas id="graph"></canvas>

                    <script src="{{ asset('js/Chart.min.js') }}"></script>

                    <script>
                        (function() {
                            var ctx = document.getElementById('graph').getContext('2d');
                            var chart = {
                                labels: {!! json_encode($sums) !!},
                                datasets: [{
                                    label: "Доход",
                                    data: {!! json_encode($dates) !!},
                                    fill: false,
                                    lineTension: 0.1,
                                    backgroundColor: "rgba(75,192,192,0.4)",
                                    borderColor: "rgba(75,192,192,1)",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "rgba(75,192,192,1)",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                    pointHoverBorderColor: "rgba(220,220,220,1)",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 5,
                                    pointHitRadius: 10
                                }]
                            };
                            var LineChart = new Chart(ctx, {
                                type: 'line',
                                data: chart,
                                options: {
                                    scales: {
                                        yAxes: [{
                                            scaleLabel: {
                                                display: true,
                                                labelString: "руб."
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        mode: 'label',
                                        callbacks: {
                                            title: function() {
                                                return '';
                                            },
                                            label: function(tooltipItem, data) {
                                                return tooltipItem.yLabel + ' р.';
                                            }
                                        }
                                    }
                                }
                            });
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection