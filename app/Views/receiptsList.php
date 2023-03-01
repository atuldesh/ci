<?php
//    print_r($receipts);
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div>
    <table class="table" id="feestbl">
        <tr class="bg-secondary text-white">
        <th>Rec.No.</th><th>Reg.No.</th><th>Name</th><th>Date</th>
        <th>Amount</th><th>Remark</th>
<?php   if(!(isset($repoNo))) {
            echo "<th>Action</th>"; } 
        else {
            echo "</tr><tr class='bg-info'><th class='text-end fs-5' colspan='4'>Total</th><th class='fs-5'>".$totAmt."</th><th></th>";
        } ?> 
        </tr>
        <tbody>
        <?php if($receipts): ?>
          <?php foreach($receipts as $receipt): ?>
            <tr>
                <td><?php echo $receipt['recno']; ?></td>
                <td><?php echo $receipt['regno']; ?></td>
                <td><?php echo $receipt['sname']; ?></td>
                <td><?php echo $receipt['fdate']; ?></td>
                <td><?php echo $receipt['amount']; ?></td>
                <td><?php echo $receipt['remark']; ?></td>
<?php           if(!(isset($repoNo))) { ?>
                <td>
                    <button class='btn btn-primary'
                     onclick='editReceipt(<?php echo $receipt["recno"]; ?>)'>
                    Edit</button>
                    <button class='btn btn-warning'
                    onclick='delReceipt(<?php echo $receipt["recno"]; ?>)'>
                    Del</button>
                </td> 
<?php           } ?>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>   

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