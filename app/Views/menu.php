  <?php if($role != "G"){ ?>
 <nav class="navbar navbar-expand-lg bg-light mt-0" style="visibility: visible;">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home">Home</a>
          </li>
    <?php   if($role=='F' || $role=='A'){  ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="studEntry">Student Entry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="feesEntry">Fees Entry</a>
          </li> 
          <?php } ?>

          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Reports</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="studLedger" href="#">Student Ledger</a></li>
              <?php  if($role=='A'){ ?>
              <li><a class="dropdown-item" href="collectionReport" href="#">Collection Report</a></li>
              <li><a class="dropdown-item" href="courseWise" href="#">Course Wise Collection</a></li>
              <?php } ?>

            </ul>
          </li>

        </ul>
      </div>
  </nav>
  <?php } ?>
 
  