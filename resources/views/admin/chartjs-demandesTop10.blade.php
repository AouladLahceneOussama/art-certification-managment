<?php
if($choice == "week"){
$begin = new DateTime(date('Y-m-d', strtotime('-7 days')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
}
if($choice == "month"){
$begin = new DateTime(date('Y-m-d', strtotime('-1 month')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
}
if($choice == "year"){
$begin = new DateTime(date('Y-m-d', strtotime('-1 year')));
$end = new DateTime(date('Y-m-d',strtotime('+1 day')));
}

$demandes =DB::table('demandes')
                ->select('nom_artist',DB::raw('count(*) as total'))
                ->whereBetween('created_at',[$begin,$end])
                ->groupBy('nom_artist')
                ->limit(10)
                ->get();
?>
<canvas id="demandesTop10" width="200" height="200"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("demandesTop10").getContext('2d');
    var myChart = new Chart(ctx, {
        
  
     type: 'doughnut',
        data: {
            labels:{!! json_encode($demandes->pluck('nom_artist')) !!},
            
            datasets: [{
                label: '# of Votes', 
                data: {!! json_encode($demandes->pluck('total')) !!} ,
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