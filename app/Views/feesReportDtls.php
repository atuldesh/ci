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

<div class="mx-5" id="pgLinks">
    <?php
    $fromPage = max(1,$curPage-10);
    $toPage = min($fromPage+15,$pages);
    if($fromPage>1){
        echo "<span class='px-2'><a href='#' onclick='showReport(".($fromPage-1).")'><<</a></span>";
    }
    for($i=$fromPage;$i<=$toPage;$i++){
        if($i==$curPage){
        echo ("<span class='px-2 '><a href='#' class='text-danger' onclick='studList(".$i.")'>".$i."</a></span>");
        } else {
            echo ("<span class='px-2'><a href='#' onclick='showReport(".$i.")'>".$i."</a></span>");            
        }
    }
    if($toPage<$pages){
        echo "<span class='px-2'><a href='#' onclick='showReport(".($toPage+1).")'>>></a></span>";
    }
    ?>
</div> 