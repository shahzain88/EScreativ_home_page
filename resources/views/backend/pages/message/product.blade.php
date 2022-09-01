
    <div class="modal fade" id="modal-admin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Admin Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('changeRole')}}" method="POST">
              @csrf
            <div class="modal-body">
              <p id="modalName"></p>
  
           
                
                  <input type="hidden" name="id" id="adminID" value="">
                  <select class="form-control" name="role" id="selectRole">
                      <option value="">Select Role</option>
                      <option value="0">New</option>
                      <option value="1">Super Admin</option>
                      <option value="2">Admin</option>
                  </select>
             
  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Role</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  