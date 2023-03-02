
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-entry-tab" data-bs-toggle="tab" data-bs-target="#nav-entry" type="button" role="tab" aria-controls="nav-entry" aria-selected="true">Entry</button>
      <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false" onclick="studList()">List</button>
    </div>
</nav>       
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-entry" role="tabpanel" aria-labelledby="nav-entry-tab" tabindex="0">
        <form id="studEntryForm">
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 ">
                <label for="regno">Reg. No.</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="number" class="form-control" name="regno" id="regno" value="0" readonly />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2  ">
                <label for="sname">Name:</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="text" class="form-control" name="sname" id="sname" />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2">
                <label for="course">course</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input list="courses" class="form-control" name="course" id="course" onblur="getCourseFees()">
                <span id="clist"></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label  for="fees">Fees</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="number" class="form-control" name="fees" id="fees">
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label for="admDate">Adm. Date</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="date" class="form-control" value=<?php echo date("Y-m-d");?> name="admDate" id="admDate" >
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label  for="bdate">B. Date</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="date" class="form-control" name="bdate" id="bdate">
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-sm-2 ">
                <label for="addr">Address</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="text" class="form-control" name="address" id="addr" />
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-sm-2">
                <label for="phone">Phone</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="phone" class="form-control" name="phone" id="phone" />
            </div>
        </div>   
        <div class="row">
            <div class="col-3 col-sm-2 "></div>
            <div class="col-8 col-sm-6 col-md-4">
                <div class="btn-group" role="group" >
                    <button type="button" class="btn btn-primary" onclick="saveStudent()">Save</button>
                    <button type="reset" class="btn btn-warning" >Clear</button>
                </div>                
            </div>
        </div>  
        </form>
    </div>
    <div class="tab-pane fade " id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab" tabindex="0"> 
    </div>
</div>
</div>
<script>
    coursesStr = <?php print_r($courseList);?>;
    st = "";
    if(coursesStr!=null)
    {
        st = '<datalist id="courses">';
         courses= JSON.parse(coursesStr);
         courses.forEach(element =>{
            st=st+"<option>"+element.course+"</option>";
         } );
         st=st+"</datalist>";
    }
    clist.innerHTML=st;
    function getCourseFees()
    {
        let vcourse = $('course').value ;
        courses.forEach(element =>{
            if(element.course==vcourse){
                $('fees').value = element.fees;
            }
        });
    }
    function editStudent(pregno)
    {
        let obj = {"regno":pregno};
        fetch('getStudent',{
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj),
/*  }).then(function(response) 
{return response.text().then(function(text) {console.log(text)})}) */
        }).then(response => response.json())
        .then(data => { 
//         console.log(data.regno);return;
        $('regno').value=data.regno;
        $('sname').value=data.sname;
        $('course').value =data.course;
        $('fees').value = data.fees;
        $('admDate').value=data.admDate;
        $('bdate').value=data.bdate;
        $('addr').value=data.address;$('phone').value = data.phone;  
        var sel = document.querySelector('#nav-entry-tab');
        bootstrap.Tab.getOrCreateInstance(sel).show();
        });
    }
    function delStudent(pregno)
    {
        let obj = {"regno":pregno};
        fetch('delStudent',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(obj),
        }).then(function(response) 
        {return response.text().then(function(text) {
            console.log(text);
            if(text=="Deleted") {
                studList();
            }

        })})     
    }        
    
    function saveStudent()
    {
        form = $("studEntryForm");
        fd= new FormData(form);
    //    fd['regno'] = "566";return;
   //     console.log(fd);
        studObj = {};
        for (let [key, value] of fd) {
            studObj[key] = value;
        }
        studObj['batch'] = 0;
        studObj['password']="password";
//        console.log(studObj)
        fetch('saveStudent',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(studObj),
        }).then(function(response) 
        {return response.text().then(function(text) {
        //    alert(text);
            form.reset();
        })})
    }        
    function studList(page=1, searchOpt=0)
    {
        psname="";
        pcourse="";
        if(searchOpt>0){
            psname = $('tsname').value.trim() ;
            pcourse = $('tcourse').value.trim() ;
        }
        idataObj = {'perPage':10,'page':page,'psname':psname,'pcourse':pcourse};
        fetch('listStudents',{
            method:'POST',
            'Content-Type': 'application/json',
            body: JSON.stringify(idataObj),
        })
        .then(function(response) 
        {return response.text().then(function(text) {
            $('nav-list').innerHTML = text;
            let tbox;
            if(searchOpt==1){
                tbox = $("tsname");
            //    $("tsname").focus();
            } else {
                tbox = $("tcourse");
            //    $("tcourse").focus();
            }
            if(searchOpt>1){
            let l = (tbox.value).length;
            tbox.focus();
            tbox.setSelectionRange(l+1, l+1);
            }
        })})

    }
 </script>