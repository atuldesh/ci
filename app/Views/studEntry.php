
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
                <input type="number" name="regno" id="regno" value="0" readonly />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2  ">
                <label for="sname">Name:</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="text" name="sname" id="sname" />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2">
                <label for="course">course</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input list="courses" name="course" id="course" onblur="getCourseFees()">
                <span id="clist"></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label  for="fees">Fees</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="number" name="fees" id="fees">
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label for="admDate">Adm. Date</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="date" name="admDate" id="admDate" >
            </div>
        </div>
        <div class="row ">
            <div class="col-3 col-sm-2 ">
                <label  for="bdate">B. Date</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="date" name="bdate" id="bdate">
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-sm-2 ">
                <label for="addr">Address</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="text" name="address" id="addr" />
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-sm-2">
                <label for="phone">Phone</label>
            </div>
            <div class="col-8 col-sm-6 col-md-4">
                <input type="phone" name="phone" id="phone" />
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
        <div>
            <table class="table" id="studtbl">
                <tr>
                    <th>Reg.No.</th><th>Name</th><th>Course</th><th>Action</th>
                </tr>
                <tbody>

                </tbody>
            </table>
        </div>           
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
    function saveStudent()
    {
        form = $("studEntryForm");
        fd= new FormData(form);
        console.log(fd);
        studObj = {};
        for (let [key, value] of fd) {
            studObj[key] = value;
        }
        console.log(studObj)
        fetch('saveStudent',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(studObj),
        }).then(function(response) 
        {return response.text().then(function(text) {
            alert(text);
            form.reset();
        })})
    }        

 </script>