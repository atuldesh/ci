<?php
//    print_r($recs);
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div class="col-6  md-col-4">
    <table class="table mx-2" id="feestbl">
        <thead>
            <tr class="bg-secondary text-white">
            <th class="fs-5 px-5">Name</th><th class="fs-5 px-5">Adm.Date</th><th class="fs-5 px-5">Amount</th></tr>
        </thead>
        <tbody>
        <?php if($recs): ?>
          <?php foreach($recs as $receipt): ?>
            <tr>
                <td class="fs-5 px-5"><?php echo $receipt['sname']; ?></td>
                <td class="fs-5 px-5"><?php echo $receipt['admDate']; ?></td>
                <td class="fs-5 px-5"><?php echo $receipt['paidFees']; ?></td>
            </tr>
          <?php endforeach;endif; ?>
        </tbody>
    </table>
</div>   
      
<div class="mx-5" id="pgLinks">
    <?php
    $fromPage = max(1,$curPage-10);
    $toPage = min($fromPage+15,$pages);
    if($fromPage>1){
        echo "<span class='px-2'><a href='#' onclick='studFees(".($fromPage-1).",1)'><<</a></span>";
    }
    for($i=$fromPage;$i<=$toPage;$i++){
        if($i==$curPage){
        echo ("<span class='px-2 '><a href='#' class='text-danger' onclick='studFees(".$i.")'>".$i."</a></span>");
        } else {
            echo ("<span class='px-2'><a href='#' onclick='studFees(".$i.",1)'>".$i."</a></span>");            
        }
    }
    if($toPage<$pages){
        echo "<span class='px-2'><a href='#' onclick='studFees(".($toPage+1).",1)'>>></a></span>";
    }
    ?>
</div> 