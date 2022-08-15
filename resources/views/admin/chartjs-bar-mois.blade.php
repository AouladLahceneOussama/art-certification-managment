<?php
$begin = new DateTime(date('Y-m-d', strtotime('-30 days')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);
dump($test);
$data= [];
$date=[];
foreach ($period as $dt) {
    $demande =DB::table('demandes')
                ->select(DB::raw('count(*) as total'))
                ->where('created_at','=',$dt)
                ->groupBy('created_at')
                ->first();

    array_push($date,$dt->format('Y-m-d'));
    if($demande != null)
        array_push($data,$demande->total);  
    else
        array_push($data,0);
    }
    $date = json_encode($date);



?>
<canvas id="myChart-mois" width="200" height="200"></canvas>
<script>
$(function () {
    var date = {!!  $date !!}
    var ctx = document.getElementById("myChart-mois").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        title:false,
        data: {
            labels: date,
            datasets: [{
                label: '# of Votes',
                data:  {{ json_encode($data) }}  ,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
      
        }
    });
});
</script>