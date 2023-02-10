<?php
        $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
   
?>
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
<div id="pgLinks">
    <?php
    for($i=1;$i<=$pages;$i++){
        echo ("<span class='px-2'><a href='#' onclick='studList(".$i.",1)'>".$i."</a></span>");
    }
    
    ?>
</div>
