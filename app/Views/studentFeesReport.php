<div>
    <form id="reportForm">
        <div class="row justify-content-start">
            <div class="col-3 col-sm-2 col-md-1 mb-4  form-floating p-0">
                <input type="number" id="lamt" value="0" aria-label="Above Rs."
                    placeholder="Above Rs." class="form-control" >
                <label for="lamt">Above Rs.</label>
            </div>
            <div class="col-3 col-sm-2 col-md-1 mb-4  form-floating p-0">
                <input type="number" id="uamt" value="0"   aria-label="Below Rs."
                    placeholder="Below Rs." class="form-control" >
                <label for="lamt">Below Rs.</label>
            </div>
            <div class="col-3 col-sm-2 col-md-1 mb-4  form-floating p-0">
                <input type="date" id="adate" value=<?php echo date("Y-m-d");?>
                  aria-label="Admitted After"
                    placeholder="Admitted After" class="form-control" >
                <label for="adate">Admitted After</label>
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-primary " onclick="studFees()">Show</button>
            </div>
         </div>
    </form>
</div>

<div id="repoDtls">
    <table class="table" id="feesRepoTbl">
        <tr>
            <th>Name</th><th>Adm.Date</th><th>Amount</th>
        </tr>
        <tbody>
        </tbody>    
    </table>
    <div id="pgLinks">
    </div>
</div>
<script>
let regNo =0;
function studFees(page=1)
{
    idataObj = {
//        'perPage':PER_PAGE,
        'page':page
    };    
    idataObj['lamt']  = $('lamt').value;
    idataObj['uamt'] = $('uamt').value;
    idataObj['adate'] = $('adate').value;
    fetch('getStudFees',{
        method:'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify(idataObj),
    })
    .then(function(response) 
    {return response.text().then(function(text) {
//        console.log(text);
        $('repoDtls').innerHTML = text;
    })})

}

</script>