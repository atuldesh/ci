<!--<div style="background-color:#31076c ;" class="text-white text-xl-left px-3 pb-2">
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
</div>  -->
<header class="sticky-top">
    <div id="headerSection">
        <div class="d-flex align-items-center justify-content-between border border-sucess"
            style="background:repeating-linear-gradient(180deg, var(--primary), transparent 100px);">
            <span class="d-flex align-items-center" style="color:white">
      <!--           <img src="" alt="Logo" class="rounded float-left" style="width:5em">  -->
                <h2 class="mx-3">Vaikuntha <small class="text-light">Computers</small> </h2>
            </span>
            <div class="col-3 px-2" id="userFld" style="text-align: right;">
                <span class="text-white">Welcome <span id="uname"><?php echo $uname; ?> </span></span>
                <?php if($role !=="G" ){ ?>
                <span class="px-2" id="logBtn">
                <span class="px-2"><a href="logout" class="btn btn-warning" >LogOut</a></span>              
                </span>
            <?php } else { ?>  
            
                <button type="button" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    login
                </button> <?php } ?>
            </div>
        </div>
    </div>
</header>


