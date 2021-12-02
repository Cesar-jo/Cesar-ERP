<!-- Modal -->
<div class="modal fade" id="share_game_modal" tabindex="-1" role="dialog" aria-labelledby="ModalVideojuego" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Compartir producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="do_submit_share_game">
          <input type="hidden" name="id_videojuego" value="<?php echo $g['id']; ?>">
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="mensaje">Mensaje personalizado</label>
            <textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar mensaje</button>
            <button type="reset" class="btn btn-default">Cancelar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>