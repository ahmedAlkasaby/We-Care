<form action="{{ route('pages.destroy',['page'=>$page->id]) }}" method="post">
    @csrf
    @method('delete')
 <div class="modal fade" id="exampleModal" tabindex="-1"
 aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('site.are_you_sure_from_delete')</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal"
                 aria-label="Close"></button>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary"
                 data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Delete</button>
         </div>
     </div>
 </div>
</div>
 </form>
