<!-- Modal -->
<div class="modal fade" id="updateCategories" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Actualizar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update-users-form" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="row">
              <div class="form-group col-12">
                <label for="name" class="col-md-4 h4 text-md-left">Nombre</label>

                <div class="col-md-12">
                    <input id="name" type="text" class="form-control form-control-lg" name="name" value="" required>
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger" form="update-users-form">Actualizar</button>
      </div>
    </div>
  </div>
</div><?php /**PATH /home/vagrant/code/sortealo/resources/views/raffleCategories/partials/_update.blade.php ENDPATH**/ ?>