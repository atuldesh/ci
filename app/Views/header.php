<div style="background-color:#31076c ;" class="text-white text-xl-left px-3 pb-2">
    <h1 class="my-0">Vaikuntha Computers</h1>
    <div class="row my-0 py-0">
        <div class="col-9">Behind BHJ College, Basant Nagar Road, Gondia</div>
        <div class="col-3" id="userFld" style="text-align: right;">
            <span>Welcome <span id="uname"><?php echo $uname; ?> </span></span>
            <?php if($role !=="G" ){ ?>
            <span class="px-2" id="logBtn">
            <span class="px-2"><a href="logout" class="btn btn-warning" >LogOut</a></span>              
            </span>
        <?php } else { ?>  
          
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
            login
          </button> <?php } ?>
        </div>
    </div>
</div>


