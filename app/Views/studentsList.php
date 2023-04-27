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
                    <div class="col-6 col-lg-3 form-floating">
                        <input type="text" class="form-control" id="tsname" name="tsname"
                        placeholder="Name" oninput="studList(1,1,<?=PER_PAGE;?>)" 
                        value='<?php echo(isset($psname) ? $psname : ""); ?>'>
                        <label for="tsname">Name</label>
                        
                    </div>
                    <div class="col-2  col-lg-1 form-floating">
                        <input type="text" class="form-control" id="tcourse" name="tcourse"
                            placeholder="Course" oninput="studList(1,2,<?=PER_PAGE;?>)" 
                            value='<?php echo(isset($pcourse) ? $pcourse : ""); ?>'>
                        <label for="tcourse">Course</label>
                    </div>
                    <div class="col-2  col-lg-2 form-floating">
                        <input type="date" class="form-control" id="tadmDate" name="tadmDate"
                            placeholder="AdmDate" onblur="studList(1,3,<?=PER_PAGE;?>)" 
                            value='<?php echo(isset($padmDate) ? $padmDate : ""); ?>'>
                        <label for="tadmDate">A.Date</label>
                    </div>
                    <div class="col-2  col-lg-1 form-check ">
                        <div>
                            <input class="form-check-input border border-primary" type="checkbox" id="tregistered" name="tregistered"
                                placeholder="registered" onchange="studList(1,4,<?=PER_PAGE;?>)" 
                                <?= ($pregistered==1)?"checked":""; ?>>
                            <label for="tregistered">Reg.?</label>
                        </div>
                        <div>
                            <input class="form-check-input border border-primary" type="checkbox" id="tAll" name="tAll"
                                placeholder="All" onchange="studList(1,4,<?=PER_PAGE;?>)" 
                                <?= ($pregistered==2)?"checked":""; ?>>
                            <label for="tall">All</label>
                        </div>                        
                    </div>
                    <div class="col-3  col-lg-2 py-2">
                        <button class="btn btn-warning" onclick="updateRegStatus()">Update</button>
                    </div>
            </span>
            <div class="container ">
                <div class="row g-3 my-2 border-bottom border-3 justify-content-center d-none d-lg-flex ">
                    <div class="d-none d-lg-inline-block col-lg-1 "><h5>Id</h5></div>
                    <div class=" col-6 col-lg-3 font-weight-bold"><h5>Full Name</h5></div>
                    <div class="col-3  col-lg-1"><h5>Course</h5></div>      
                    <div class="col-3  col-lg-2"><h5>A.Date</h5></div>       
                    <div class="col-2  col-lg-1"><h5>Reg?</h5></div>     
                    <div class="col-3  col-lg-2"><h5>Action</h5></div>
                </div>
                <?php foreach($students as $student): ?>               

                    <div class="row border-bottom border-2 g-3 justify-content-center">
                        <div class="d-none d-lg-inline-block col-lg-1 border border-2"><?=$student->regno;?></div>
                        <div class="col-6  col-lg-3 border border-2"><?=$student->sname;?></div>
                        <div class="col-3  col-lg-1 border border-2"><?=$student->course;?></div>
                        <div class="col-3  col-lg-2 border border-2"><?=$student->admDate;?></div>
                        <div class="col-3  col-lg-1 border border-2 pl-4 py-2">
                            <input class="form-check-input border-primary" type="checkbox"
                             id="c<?=$student->regno;?>" 
                            <?php echo ($student->registered?"checked":"");?>
                             onchange="changeRegStatus(<?=$student->regno;?>)">
                        </div>
                        
                        <div class="col-3  col-lg-2">
                            <div class="btn-group mb-2" role="group" aria-label="Action">
                                <button type="button" onclick="delStudent(<?=$student->regno;?>)" class="btn btn-danger">Del</button>
                                <button type="button" onclick="editStudent(<?=$student->regno;?>)" class="btn btn-primary">Edit</button>
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
