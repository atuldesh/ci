<?php
//    print_r($receipts);
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div class="container shadow rounded my-3 text-center">
    <div class="card">
        <div class="card-header text-muted">
            <h4>Fees List</h4>
        </div>
        <div class="card-body">
            <span class="card-title">
                <div class="row g-3 my-3">
                    <div class="d-none d-lg-inline-block  col-lg-1">
                        <!-- Reg. No.  -->
                    </div>
                    <div class="d-none d-lg-inline-block col-lg-1">
                        <!-- Rec. No.  -->
                    </div>
                    <div class="col-6 col-lg-3 form-floating">
                    <input type="text" id="tsname" oninput="feesList(1,1)" class="form-control w-70" value ='<?php echo(isset($psname) ? $psname : ""); ?>' placeholder="Search Name">
                        <label for="tsname">Name</label>
                        
                    </div>
                    <div class="col-6  col-lg-2 form-floating">
                        <input type="date" id="tfdate" oninput="feesList(1,2)" class="form-control w-70" placeholder="Search Date" value ='<?php echo(isset($pfdate) ? $pfdate :""); ?>'>
                        <label for="tfdate"></label>
                    </div>
                    <div class="col-6  col-lg-1 form-floating">
                    <input type="number" id="tamount" oninput="feesList(1,3)" class="form-control w-70" placeholder="Search Amount" value ='<?php echo(isset($pamount) ? $pamount :""); ?>'>
                        <label for="tamount">Search Amound</label>
                    </div>
                    <div class="col-6  col-lg-2 form-floating">
                    <input type="text" id="tremark" oninput="feesList(1,4)" class="form-control w-70" placeholder="Search Remark" value ='<?php echo(isset($premark) ? $premark :""); ?>'>
                    <label for="tremark">Remark</label>
                    </div>
                </div>
             
            </span>
            <div class="container ">
                <div class="row g-3 my-2 border-bottom border-3  d-none d-lg-flex ">
                    <div class="d-none d-lg-inline-block col-lg-1 "><h5>Rec No </h5></div>
                    <div class="d-none d-lg-inline-block col-lg-1 "><h5>Reg No </h5></div>
                    <div class=" col-6 col-lg-3 font-weight-bold"><h5>Full Name</h5></div>     
                    <div class="col-3  col-lg-2"><h5>Date</h5></div>       
                    <div class="col-2  col-lg-1"><h5>Amount</h5></div>     
                    <div class="col-2  col-lg-2"><h5>Remark</h5></div>     
                    <?php   if(!(isset($repoNo))) {
            echo "<div class='col-3  col-lg-2 fs-5'  style='font-weight:bolder'>Action</div>"; } 
        else {
            echo "</div><div class='bg-info'><th class='text-end fs-5' colspan='4'>Total</div><div class='fs-5'>".$totAmt."</div><div></div>";
        } ?> 
                </div>
                <?php if($receipts): ?>
          <?php foreach($receipts as $receipt): ?>            

                    <div class="row border-bottom border-2 g-3 my-3">
                        <div class="col-3  col-lg-1 border border-2"><?php echo $receipt['recno']; ?></div>
                        <div class="col-3  col-lg-1 border border-2"><?php echo $receipt['regno']; ?></div>
                        <div class="col-12  col-lg-3 border border-2"><?php echo $receipt['sname']; ?></div>
                        <div class="col-6  col-lg-2 border border-2"><?php echo $receipt['fdate']; ?></div>
                        <div class="col-6  col-lg-1 border border-2"><?php echo $receipt['amount']; ?></div>
                        <div class="col-6  col-lg-2 border border-2"><?php echo $receipt['remark']; ?></div>
                
<?php           if(!(isset($repoNo))) { ?>
                        <div class="col-6  col-lg-2">
                            <div class="btn-group mb-2" role="group" aria-label="Action">
                            <button class='btn btn-primary'
                     onclick='editReceipt(<?php echo $receipt["recno"]; ?>)'>
                    Edit</button>
                    <button class='btn btn-warning'
                    onclick='delReceipt(<?php echo $receipt["recno"]; ?>)'>
                    Del</button>
                            </div>
                        </div>
                        <?php           } ?>
                    </div>
                    <?php endforeach; ?>
        <?php endif; ?>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="mx-5 " id="pgLinks ">
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
        </div>        
    </div> 
</div>
