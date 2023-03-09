<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">ATTENZIONE</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         Sei sicuro di voler cancellare l'elemento selezionato? <span id="modal-item-title"></span> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-square btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <form class="d-inline-block" action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-square btn-danger">
                Elimina
            </button>
        </form>
        </div>
      </div>
    </div>
</div>