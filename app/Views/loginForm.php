<div class="modal" id="loginModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verify your Identity</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="loginId" placeholder="login id">
              <label for="loginId">Enter Login Id</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="pwd" placeholder="password">
              <label for="pwd">Enter Password</label>
            </div>
            <button type="button" class="btn btn-primary mb-3" onclick="chkLogin();">
                Confirm identity</button>
                <span style="font-weight: bold; color: red;" id="msg"></span>
          </form>
        </div>
      </div>
    </div>
  </div> 
