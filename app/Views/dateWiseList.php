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
<div id="pgLinks">
    <?php
    for($i=1;$i<=$pages;$i++){
        echo ("<span class='px-5'><a href='#' onclick='feesList(".$i.")'>".$i."</a></span>");
    }
    ?>
</div>        