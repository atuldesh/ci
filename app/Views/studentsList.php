<?php
    
    $pages = ($total%$perPage>0)?intdiv($total,$perPage)+1 : $total/$perPage;
?>
<div>
    <table class="table" id="studtbl">
        <tr>
            <th>Reg.No.</th><th>Name</th><th>Course</th><th>Action</th>
        </tr>
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
        echo ("<span class='px-2'><a href='#' onclick='studList(".$i.")'>".$i."</a></span>");
    }
    ?>
</div>        
