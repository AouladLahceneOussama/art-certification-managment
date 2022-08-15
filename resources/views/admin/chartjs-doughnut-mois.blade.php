<?php
$begin = new DateTime(date('Y-m-d', strtotime('-7 days')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));

$demandes =DB::table('demandes')
                ->select('statut',DB::raw('count(*) as total'))
                ->whereBetween('updated_at',[$begin,$end])
                ->groupBy('statut')
                ->get();



   // var date = {!!  $date !!}


?>
<canvas id="myDoughnut-mois" width="200" height="200"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("myDoughnut-mois").getContext('2d');
    var myChart = new Chart(ctx, {
        
  
     type: 'doughnut',
        data: {
            labels:{!! json_encode($demandes->pluck('statut')) !!},
            
            datasets: [{
                label: '# of Votes', 
                data: {!! json_encode($demandes->pluck('total')) !!} ,
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