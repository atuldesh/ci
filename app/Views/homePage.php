<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaikuntha Computers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
     <link rel="stylesheet" href="assets/css/style.css">
     
</head>
<body >
<div class="container-fluid px-0 pt-0">
<header class="sticky-top">
    <?php echo $header;?>
       <div id="nav">
       <?php echo $menu; ?>
     </div>
</header>
      <div class="mx-3" id="main">
        <?php echo $main;?>
      </div>
      <div>
        <?php echo $footer; ?>
      </div> 
  </div>
    <!-- Login Form -->
    <?php echo $loginForm;?>
     
  <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
  function $(id) { return document.getElementById(id); }

function chkLogin()
{
    let lid = $('loginId').value;
    let pwd = $('pwd').value;
    obj = {'lid':lid,'pwd':pwd};
//    console.log(obj);
    fetch("chkLogin",{
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(obj),
 
 /*   }).then(function(response) 
    {return response.text().then(function(text) {console.log(text)})})*/
    }).then(response => response.json())
    .then(data => { 
//        console.log(data);
        if(data['status']!=0){
            $('msg').innerText="Invalid Login id or Password";
        } else {
            var myModalEl = document.getElementById('loginModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();           
            st='<span class="text-white">Welcome <span id="uname"><?php echo $uname; ?> </span></span>';
      //      st = "Welcome "+ data['uname'];
            st=st+'<span class="px-2" id="logBtn"><a href="logout" class="btn btn-warning" >LogOut</a></span>';
            $('userFld').innerHTML = st;
            $('nav').innerHTML = data['menu'];
        }
        
    });     
  }

</script>
  </body>
</html>

