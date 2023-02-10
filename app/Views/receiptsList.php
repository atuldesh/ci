<?php
   // print_r($receipts);
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
            echo "</tr><tr class='bg-info'><th colspan='4'>Sum</th><th>".$totAmt."</th><th></th>";
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
<div id="pgLinks">
    <?php
    for($i=1;$i<=$pages;$i++){
        echo ("<span class='px-2'><a href='#' onclick='feesList(".$i.")'>".$i."</a></span>");
    }
    ?>
</div>        
