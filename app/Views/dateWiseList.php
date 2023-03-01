<?php
   // print_r($receipts);
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div class="col-6  md-col-4">
    <table class="table mx-2" id="feestbl">
        <thead>
            <tr class="bg-secondary text-white">
            <th class="fs-5 px-5">Date</th><th class="fs-5 px-5">Amount</th></tr>
            <tr class='bg-info'><th class='text-end fs-5 px-5'>Total</th>
            <th class='fs-5 px-5'><?php echo $totAmt; ?></th></tr>
        </thead>
        <tbody>
        <?php if($receipts): ?>
          <?php foreach($receipts as $receipt): ?>
            <tr>
                <td class="fs-5 px-5"><?php echo $receipt->fdate; ?></td>
                <td class="fs-5 px-5"><?php echo $receipt->totAmt; ?></td>
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
        echo "<span class='px-2'><a href='#' onclick='feesList(".($fromPage-1).",1)'><<</a></span>";
    }
    for($i=$fromPage;$i<=$toPage;$i++){
        if($i==$curPage){
        echo ("<span class='px-2 '><a href='#' class='text-danger' onclick='feesList(".$i.")'>".$i."</a></span>");
        } else {
            echo ("<span class='px-2'><a href='#' onclick='feesList(".$i.",1)'>".$i."</a></span>");            
        }
    }
    if($toPage<$pages){
        echo "<span class='px-2'><a href='#' onclick='feesList(".($toPage+1).",1)'>>></a></span>";
    }
    ?>
</div> 