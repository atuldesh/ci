<?php
        $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div class="container shadow rounded my-3">
    <div class="card">
        <div class="card-header text-muted">
            <h4>List of Students</h4>
        </div>
        <div class="card-body">
            <span class="card-title">
                <div class="row g-3 justify-content-center">
                    <div class="d-none d-md-inline col-lg-1">
                        <!-- Reg. No.  -->
                    </div>
                    <div class="col-6 col-lg-4 form-floating">
                        <input type="text" class="form-control" id="tsname" name="tsname"
                        placeholder="Name" oninput="studList(1,1,<?=PER_PAGE;?>)" 
                        value='<?php echo(isset($psname) ? $psname : ""); ?>'>
                        <label for="tsname">Name</label>
                        
                    </div>
                    <div class="col-3  col-lg-2 form-floating">
                        <input type="text" class="form-control" id="tcourse" name="tcourse"
                            placeholder="Course" oninput="studList(1,2,<?=PER_PAGE;?>)" 
                            value='<?php echo(isset($pcourse) ? $pcourse : ""); ?>'>
                        <label for="tcourse">Course</label>
                    </div>
                    <div class="col-3  col-lg-2"></div>
            </span>
            <div class="container ">
                <div class="row g-3 my-2 border-bottom border-3 justify-content-center d-none d-lg-flex ">
                    <div class="d-none d-lg-inline-block col-lg-1 "><h5>Id</h5></div>
                    <div class=" col-6 col-lg-4 font-weight-bold"><h5>Full Name</h5></div>
                    <div class="col-3  col-lg-2"><h5>Course</h5></div>            
                    <div class="col-3  col-lg-2"><h5>Action</h5></div>
                </div>
                <?php foreach($students as $student): ?>               

                    <div class="row border-bottom border-2 g-3 justify-content-center">
                        <div class="d-none d-lg-inline-block col-lg-1 border border-2"><?=$student['regno'];?></div>
                        <div class="col-6  col-lg-4 border border-2"><?=$student['sname'];?></div>
                        <div class="col-3  col-lg-2 border border-2"><?=$student['course'];?></div>
                        <div class="col-3  col-lg-2">
                            <div class="btn-group mb-2" role="group" aria-label="Action">
                                <button type="button" onclick="delStudent(<?=$student['regno'];?>)" class="btn btn-danger">Del</button>
                                <button type="button" onclick="editStudent(<?=$student['regno'];?>)" class="btn btn-primary">Edit</button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="mx-5 " id="pgLinks ">
                <?php
                $fromPage = max(1,$curPage-10);
                $toPage = min($fromPage+15,$pages);
             //   echo $fromPage.",".$toPage."\n";
                if($fromPage>1){
                    echo "<span class='px-2'><a href='#' onclick='studList(".($fromPage-1).",1,".(PER_PAGE).")'><<</a></span>";
                }
                for($i=$fromPage;$i<=$toPage;$i++){
                    if($i==$curPage){
                    echo ("<span class='px-2 '><a href='#' class='text-warning fw-bold' onclick='studList(".$i.",1,".(PER_PAGE).")'>".$i."</a></span>");
                    } else {
                        echo ("<span class='px-2 '><a href='#' class='text-black' onclick='studList(".$i.",1,".(PER_PAGE).")'>".$i."</a></span>");            
                    }
                }
                if($toPage<$pages){
                    echo "<span class='px-2 text-white'><a href='#' onclick='studList(".($toPage+1).",1,".(PER_PAGE).")'>>></a></span>";
                }
                ?>
            </div>         
        </div>        
    </div> 
</div>
