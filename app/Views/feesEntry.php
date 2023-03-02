<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-entry-tab" data-bs-toggle="tab" data-bs-target="#nav-entry" type="button" role="tab" aria-controls="nav-entry" aria-selected="true">Entry</button>
      <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false" onclick="feesList()">List</button>
    </div>
</nav>       
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-entry" role="tabpanel" aria-labelledby="nav-entry-tab" tabindex="0">
        <form id="feesForm">
        <div class="row justify-content-start">
            <div class="col-3 col-md-2 ">
                <span for="regno">Reg. No.</span>
                <input class="form-control w-50" type="number" readonly name="regno" id="regno" value="0000"/>
            </div>
            <div class="col-3 col-md-2 ">
                <span for="regno">Rec. No.</span>
                <input type="number" class="form-control w-50" readonly name="recno" id="recno" value="0000"/>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-4">
                <span class="text-primary fw-bold" id="feesdtls"></span>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 col-md-1">
                <label for="sname">Name</label>
            </div>
            <div class="col-6 col-sm-5 col-md-4">
                <input class="form-control" list="students" onblur="getRegNo()" id="sname">
                <span id="clist"></span>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 col-md-1">
                <label for="fdate">Date</label>
            </div>
            <div class="col-6 col-sm-5 col-md-4">
                <input class="form-control" type="date" value=<?php echo date("Y-m-d");?> name="fdate" id="fdate" />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 col-md-1">
                <label for="amt">Amount</label>
            </div>
            <div class="col-6 col-sm-5 col-md-4">
                <input class="form-control" type="number" name="amount" id="amount" />
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 col-md-1">
                <label for="remark">Remark</label>
            </div>
            <div class="col-6 col-sm-5 col-md-4">
                <input type="text" class="form-control" name="remark" id="remark" />
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <div class="btn-group" role="group" >
                    <button type="button" class="btn btn-primary" onclick="saveFees()">Save</button>
                    <button type="reset" class="btn btn-warning" onclick="clearFeesFrom()">Clear</button>
                </div>                
            </div>
        </div>  
        </form>
    </div>
    <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab" tabindex="0">
    </div>
</div>
<script> 
   studentsStr = <?php print_r($studentsList);?>;
    st = "";
    if(studentsStr!=null)
    {
        st = '<datalist id="students">';
         students= JSON.parse(studentsStr);
         students.forEach(element =>{
            st=st+"<option>"+element.regno + "-" + element.sname+"</option>";
         } );
         st=st+"</datalist>";
    }
    clist.innerHTML=st;    

function getRegNo()
{
    st = $('sname').value;
    arr = st.split("-");
    sname.value=arr[1];
    regno.innerText = arr[0];
        let obj = {"regno":arr[0]};
        fetch('getBalance',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(obj),
 /*     }).then(function(response) 
    {return response.text().then(function(text) {console.log(text)})}) */
        }).then(response => response.json())
        .then(data => { 
          console.log(data);
          $('feesdtls').innerText = "Fees: "+data['fees']+"  Paid: "+data['fees collected']+"    Balance: "+data['balance'];
          $('regno').value = arr[0];
    })
    }    
    function saveFees()
    {
        form = $("feesForm");
        fd= new FormData(form);
    //    fd['regno'] = "566";return;
    //    console.log(fd);return;
        feesObj = {};
        for (let [key, value] of fd) {
            feesObj[key] = value;
        }
 //       console.log(feesObj)
        fetch('saveReceipt',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(feesObj),
        }).then(function(response) 
        {return response.text().then(function(text) {
    //        alert(text);
            form.reset();
        })})        
    }
    function feesList(page=1,searchOpt=0)
    {
        psname="";
        pfdate="";
        pamount=0;
        premark="";
        if(searchOpt>0){
            psname = $('tsname').value.trim() ;
            pfdate = $('tfdate').value ;
            pamount = $('tamount').value.trim();
            premark = $('tremark').value.trim() ;
        }
        idataObj = {'perPage':10,'page':page,'psname':psname,'pfdate':pfdate,'pamount':pamount,'premark':premark};        
        fetch('listReceipts',{
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
            } else if(searchOpt==2){
                tbox = $("tfdate");
            //    $("tcourse").focus();
            } else if(searchOpt==3){
                tbox = $("tamount");
            //    $("tcourse").focus();
            }else if(searchOpt==4){
                tbox = $("tremark");
            //    $("tcourse").focus();
            }
            if(searchOpt>0){
            let l = (tbox.value).length;
            tbox.focus();
            tbox.setSelectionRange(l+1, l+1);  
            }         
        })})

    }    
    function editReceipt(precno)
    {
        let obj = {"recno":precno};
        fetch('getReceipt',{
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

        $('recno').value=data.recno;
        $('regno').value=data.regno;
        $('sname').value=data.sname;
        $('amount').value =data.amount;
        $('remark').value = data.remark;
        $('fdate').value=data.fdate;
        var sel = document.querySelector('#nav-entry-tab');
        bootstrap.Tab.getOrCreateInstance(sel).show();
        });
    }
    function delReceipt(precno)
    {
        let obj = {"recno":precno};
        fetch('delReceipt',{
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(obj),
        }).then(function(response) 
        {return response.text().then(function(text) {
            console.log(text);
            if(text=="Deleted") {
                feesList();
            }

        })})     
    }        
</script>
