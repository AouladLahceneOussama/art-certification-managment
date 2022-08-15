<?php

use Illuminate\Support\Facades\DB;

$begin = new DateTime(date('Y-m-d', strtotime('-7 days')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));

$methods = DB::table('abonnements')
                ->select('method_paiement',DB::raw('count(*) as total'))
                ->groupBy('method_paiement')
                ->get();
?>

<canvas id="abbonnementChart" width="200" height="200"></canvas>

<script>
$(function () {
    var ctx = document.getElementById("abbonnementChart").getContext('2d');
    var myChart = new Chart(ctx, {
        
  
     type: 'doughnut',
        data: {
            labels:{!! json_encode($methods->pluck('method_paiement')) !!},
            
            datasets: [{
                label: 'mode de paiement', 
                data: {!! json_encode($methods->pluck('total')) !!} ,
                backgroundColor: [
                    '#605ca8',
                    '#aa88f4',
                    '#bcbcc4',
                ]
            }]
        },
        options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'left',
        }
       
        }
    }
    });
});
</script>