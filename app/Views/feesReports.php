<div>
    <form id="reportForm">
        <div class="row justify-content-start">
            <?php
            if($repoNo==1){ ?>
                <div class="col-3 col-sm-2 col-md-1 mb-4">
                    <label for="sname">Name</label>
                </div>
                <div class="col-6 col-sm-5 col-md-4 mb-4">
                    <input class="form-control" list="students"  id="sname">
                    <span id="clist"></span>
                </div>
    <script>
    studentsStr = <?php print_r($studentsList);?>;
        st = "";
        if(studentsStr!=null)
        {
            st = '<datalist id="students">';
            students= JSON.parse(studentsStr);
            students.forEach(element =>{
                st=st+"<option>"+element.regno + "-" + element.sname+"-"+ element.course + "</option>";
            } );
            st=st+"</datalist>";
        }
        clist.innerHTML=st;    
    </script>
            <?php
            } else { ?>
            <div class="row justify-content-start">
                <div class="col-3 col-sm-2 col-md-1 mb-4 ">
                    <label for="sdate">From :</label>
                </div>
                <div class="col-8 col-sm-4 col-md-2 mb-4">
                    <input type="date" class="form-control" value=<?php echo date("Y-m-d");?> name="sdate" id="sdate" />
                </div>
                <div class="col-3 col-sm-2 col-md-1 mb-4 ">
                    <label for="edate">To :</label>
                </div>
                <div class="col-8 col-sm-4 col-md-2 mb-4">
                    <input type="date" class="form-control" value=<?php echo date("Y-m-d");?> name="edate" id="edate" />
                </div>
            <?php
            } ?>
            <div class="col-1">
                <button type="button" class="btn btn-primary " onclick="showReport(1)">Show</button>
            </div>
        </div>
    </form>
</div>

<div id="repoDtls">
    <table class="table" id="feesRepoTbl">
        <tr>
<?php      if($repoNo<3){ ?>
            <th>Rec.No.</th><th>Reg.No.</th><th>Name</th>    
            <th>Date</th><th>Amount</th><th>Remark</th>
<?php      } else { ?>
            <th>Course</th><th>Amount</th> 
<?php      } ?>
        </tr>
        <tbody>
        </tbody>    
    </table>
    <div id="pgLinks">
    </div>
</div>
<script>
let regNo =0;

function showReport(page=1)
{
    repoNo = <?php echo $repoNo; ?>;
    idataObj = {
            'perPage':5,
            'page':page,
            'repoNo':repoNo
    };
    if(repoNo==1){
        st = $('sname').value;
        arr = st.split("-");
        idataObj['regNo'] = arr[0];
    } else if(repoNo>=2 ) {
        idataObj['sdate'] = $('sdate').value;
        idataObj['edate'] = $('edate').value;
    }
    fetch('getFeesReport',{
        method:'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify(idataObj),
    })
    .then(function(response) 
    {return response.text().then(function(text) {
        console.log(text);
        $('repoDtls').innerHTML = text;
    })})

}
</script>