<!-- Modal -->
<div class="modal fade" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirme operacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="delete-users-form" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <h4 id="title-delete"></h4>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger" form="delete-users-form">Eliminar</button>
      </div>
    </div>
  </div>
</div><?php /**PATH /home/vagrant/code/sortealo/resources/views/raffles/partials/_delete.blade.php ENDPATH**/ ?>