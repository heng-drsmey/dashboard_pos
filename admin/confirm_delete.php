

<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered " role="document">
    <div class="modal-content ">
      <div class="modal-header  ">
        <h5 class="modal-title " id="Title">After delete you can not restore!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-danger " >
        <b>Are you sure you want to delete ?</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <a class="btn btn-primary btn-ok btn-sm">YES</a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
    });  
});



</script>
