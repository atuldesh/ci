<?php
        $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<script>
    
 /*   function showPages(curPage,pages)
    {
        alert("X");
        fromPage = Math.floor(curPage/10)+1;
        toPage = if(fromPage+10<pages?fromPage:pages);

        st="x";
        if(fromPage>1) {
            st = st+"<a href='#' onclick='showPages("fromPage-10+","+pages+")'>"+<<+"</a>";
        }
        for(i=fromPage;i<=toPage;i++){
            st=st+"<a href='#' onclick='studList("+i+",1)'>"+i+"</a>";
        }
        if(toPage<pages){
            st = st + "<a href='#' onclick='showPages("fromPage+10+","+pages+")>"+>>+"</a>";
        }
        console.log(st);
        $('pgLinks').innerHTML = st;
    } */
    </script>

<div>
    <table class="table border boder-2" id="studtbl">
        <thead>
            <tr class="mb-2" >
                <th></th>
                <th>
                    <input type="text" id="tsname" oninput="studList(1,1)" class="form-control w-70" value ='<?php echo(isset($psname) ? $psname : ""); ?>' placeholder="Search Name">
                </th>
                <th>
                    <input type="text" id="tcourse" oninput="studList(1,2)" class="form-control w-70" placeholder="Search Course" value ='<?php echo(isset($pcourse) ? $pcourse :""); ?>'>
                </th>
                 <th></th>
            </tr>
            <tr >
                <th>Reg.No.</th><th>Name</th><th>Course</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if($students): ?>
          <?php foreach($students as $student): ?>
            <tr>
                <td><?php echo $student['regno']; ?></td>
                <td><?php echo $student['sname']; ?></td>
                <td><?php echo $student['course']; ?></td>
                <td>
                    <button class='btn btn-primary'
                     onclick='editStudent(<?php echo $student["regno"]; ?>)'>
                    Edit</button>
                    <button class='btn btn-warning'
                    onclick='delStudent(<?php echo $student["regno"]; ?>)'>
                    Del</button>
                </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>   
<div class="mx-5" id="pgLinks">
    <?php
    $fromPage = max(1,$curPage-10);
    $toPage = min($fromPage+15,$pages);
    if($fromPage>1){
        echo "<span class='px-2'><a href='#' onclick='studList(".($fromPage-1).",1)'><<</a></span>";
    }
    for($i=$fromPage;$i<=$toPage;$i++){
        if($i==$curPage){
        echo ("<span class='px-2 '><a href='#' class='text-danger' onclick='studList(".$i.")'>".$i."</a></span>");
        } else {
            echo ("<span class='px-2'><a href='#' onclick='studList(".$i.",1)'>".$i."</a></span>");            
        }
    }
    if($toPage<$pages){
        echo "<span class='px-2'><a href='#' onclick='studList(".($toPage+1).",1)'>>></a></span>";
    }
    ?>
</div> 


