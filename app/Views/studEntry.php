
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-entry-tab" data-bs-toggle="tab" data-bs-target="#nav-entry" type="button" role="tab" aria-controls="nav-entry" aria-selected="true">Entry</button>
      <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false" onclick="studList()">List</button>
    </div>
</nav>       
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-entry" role="tabpanel" aria-labelledby="nav-entry-tab" tabindex="0">
        <div class="container">
        <form id="studEntryForm" >
        <div class="row justify-content-start mt-1">
           <div class="col-6  col-md-3 form-floating">
                <input type="number" class="form-control" name="regno" aria-label="Reg.No."
                 placeholder="Reg.No." id="regno" value="0" readonly />
                <label for="regno" class="px-3">Reg.No.</label>               
            </div>
        </div>
        <div class="row justify-content-start mt-1">
            <div class="col-12  col-md-6 form-floating">
                <input type="text" class="form-control" name="sname" id="sname" 
                aria-label="Student Name" placeholder="Student Name"  />
                <label for="sname" class="px-3">Student Name</label>               

            </div>
        </div>
        <div class="row justify-content-start mt-1">
             <div class="col-12  col-md-6 form-floating">
                <input list="courses" class="form-control" name="course" id="course"
                aria-label="Course" placeholder="Course" onblur="getCourseFees()">
                <label for="course" class="px-3">Course</label> 
                <span id="clist"></span>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-6 col-md-3 form-floating">
                <input type="number" class="form-control" name="fees" id="fees"
                aria-label="fees" placeholder="fees">
                <label  for="fees" class="px-3">Fees</label>
            </div>
            <div class="col-6 col-md-3 form-floating">
                <input type="date" class="form-control" value=<?php echo date("Y-m-d");?>
                 name="admDate" id="admDate" aria-label="Adm. Date" placeholder="Adm. Date" >
                <label for="admDate" class="px-3">Adm. Date</label>
            </div>
        </div>
        <div class="row mt-1 ">
            <div class="col-6 col-md-3 form-floating">
                <input type="date" class="form-control" name="bdate" id="bdate"
                aria-label="B. Date" placeholder="B. Date">
                <label  for="bdate" class="px-3">B. Date</label>
            </div>
            <div class="col-6 col-md-3 form-floating">
                <input type="phone" class="form-control" name="phone" id="phone" 
                aria-label="Phone" placeholder="Phone"/>
                <label for="phone" class="px-3">Phone</label>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12  col-md-6 form-floating" >
                <input type="text" class="form-control" name="address" id="addr" 
                aria-label="Address" placeholder="Address"/>
                <label  for="addr" class="px-3">Address</label>
            </div>
        </div>

        <div class="row mt-3 ">
            <div class="col-12 col-md-6">
                <div class="btn-group" role="group" >
                    <button type="button" class="btn btn-primary" onclick="saveStudent()">Save</button>
                    <button type="reset" class="btn btn-warning" >Clear</button>
                </div>                
            </div>
        </div>  
        </form>
</div>
    </div>
    <div class="tab-pane fade " id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab" tabindex="0"> 
    </div>
</div>
</div>
<script>
    coursesStr = <?php print_r($courseList);?>;
    st = "";
    let regStatus = new Set(); // To keep track of change in `Registered` Status in students list.
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
    //-------------------------------------------------------------
    function getCourseFees()
    {
        let vcourse = $('course').value ;
        courses.forEach(element =>{
            if(element.course==vcourse){
                $('fees').value = element.fees;
            }
        });
    }
    //-------------------------------------------------------------
    function changeRegStatus(vregno)
    {
        regStatus.add(vregno);
    }
    //-------------------------------------------------------------
    function updateRegStatus()
    {
        console.log(regStatus);
        onArr=[];offArr=[];
        regStatus.forEach(function(rno){
            if($('c'+rno).checked){
                onArr.push(rno);
            } else {
                offArr.push(rno);
            }

 /*           item = {"regno":rno,'registered':($('c'+rno).checked)?1:0};
            arr.push(item);*/
        });
        obj = {'on':onArr,'off':offArr};
 //       console.log(obj);console.log(JSON.stringify(obj));
        fetch('updateStudRegStatus',{
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj),
        }).then(function(response) 
        {return response.text().then(function(text) {alert(text)})}) 
    }
//-------------------------------------------------------------
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
//-------------------------------------------------------------
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
 //-------------------------------------------------------------   
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
//-------------------------------------------------------------  
    function studList(page=1, searchOpt=0,perPage=25)
    {
        psname="";
        pcourse="";
        padmDate="";
        pregistered=2;  // Will display both registered and non registered 
        regStatus.clear(); // remove all elements from the array regStatus
        if(searchOpt>0){
            psname = $('tsname').value.trim() ;
            pcourse = $('tcourse').value.trim() ;
            padmDate = $('tadmDate').value;
            if($('tAll').checked){
                pregistered = 2;
            }else{
                pregistered = ($('tregistered').checked)?1:0;
            }
            
        }
        idataObj = {'perPage':25,'page':page,'psname':psname,'pcourse':pcourse,
            'padmDate':padmDate,'pregistered':pregistered};
//        console.log(idataObj);
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
                tbox.focus();
            } else if(searchOpt==2) {
                tbox = $("tcourse");
                tbox.focus();
            }
            if(searchOpt==1 || searchOpt==2){
            let l = (tbox.value).length;
            tbox.setSelectionRange(l+1, l+1);
            }
        })})

    }
 </script>