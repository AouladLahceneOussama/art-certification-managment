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

$certificats =DB::table('certificats')
                ->select('admin_user_id',DB::raw('count(*) as total'))
                ->whereBetween('created_at',[$begin,$end])
                ->groupBy('admin_user_id')
                ->limit(10)
                ->get();

$artistId = $certificats->pluck('admin_user_id');
$artistsName = [];
foreach ($artistId as $id) {
   
    $artistName = DB::table('admin_users')
                ->select('lastName','firstName')
                ->where('id',"=",$id)
                ->first();

                
    array_push($artistsName,$artistName->firstName." ".$artistName->lastName);
}
?>
<canvas id="certificatsTop10" width="200" height="200"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("certificatsTop10").getContext('2d');
    var myChart = new Chart(ctx, {
        
  
     type: 'doughnut',
        data: {
            labels:{!! json_encode($artistsName)!!},
            
            datasets: [{
                label: '# of Votes', 
                data: {!! json_encode($certificats->pluck('total')) !!} ,
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