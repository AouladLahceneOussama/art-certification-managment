<?php
if($choice == "week"){
$begin = new DateTime(date('Y-m-d', strtotime('-7 days')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
$interval = DateInterval::createFromDateString('1 day');
}
else if ($choice == "month"){
$begin = new DateTime(date('Y-m-d', strtotime('-1 month')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
$interval = DateInterval::createFromDateString('1 day');
}
else {
$begin = new DateTime(date('Y-m-d', strtotime('-11month')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
$interval = DateInterval::createFromDateString('1 month');
}

$period = new DatePeriod($begin, $interval, $end);

$data= [];
$date=[];
foreach ($period as $dt) {
    if($choice == "year")
    {
 
 
     $user =DB::table('admin_users')
                 ->select(DB::raw('month(created_at) as date'),DB::raw('count(*) as total'))
                 ->whereMonth('created_at','=',$dt->format('m'))
                 ->whereYear('created_at','=',$dt->format('Y'))
                 ->groupBy('date')
                 ->first();
 
    }
    else {
 
     $user =DB::table('admin_users')
                 ->select(DB::raw('date(created_at) as date'),DB::raw('count(*) as total'))
                 ->whereDate('created_at','=',$dt)
                 ->groupBy('date')
                 ->first();
    }
   
//    dump($demande);

    
    //format labels           
    if($choice == "year")
    array_push($date,$dt->format('F'));
    else
    array_push($date,$dt->format('Y-m-d'));

    if($user != null)
        array_push($data,$user->total);  
    else
        array_push($data,0);
    }
    



?>
<canvas id="InscriptionChart" width="200" height="200"></canvas>
<script>
$(function () {
    var date = {!! json_encode($date ) !!}
    var ctx = document.getElementById("InscriptionChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        title:false,
        data: {
            labels: date,
            datasets: [{
                label: 'nombre des insciptions',
                data:  {{ json_encode($data) }}  ,
               
                borderColor: '#605ca8',
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