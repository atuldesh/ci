<?php
   // print_r($receipts);
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<script>
    st="";
    <?php foreach($receipts as $receipt): ?>
    st = "<tr>"  
         + "<td><?php echo $receipt['recno']; ?></td>" 
<?php   if($repoNo==1){ ?>
         + "<td><?php echo $receipt['regno']; ?></td>"
         + "<td><?php echo $receipt['sname']; ?></td>"
<?php   } ?>
        + "<td><?php echo $receipt['fdate']; ?></td>"
        + "<td><?php echo $receipt['amount']; ?></td>"
        + "<td><?php echo $receipt['remark']; ?></td>"
        + "<td></tr>"
<?php endforeach; ?>
$('feesRepoTbl').tbodies[0].innerHTML=st;
</script>
<div id="pgLinks">
    <?php
    for($i=1;$i<=$pages;$i++){
        echo ("<span class='px-2'><a href='#' onclick='showReport(".$i.")'>".$i."</a></span>");
    }
    ?>
</div> 
