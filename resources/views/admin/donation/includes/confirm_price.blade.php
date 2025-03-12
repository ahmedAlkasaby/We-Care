<div class="modal fade" id="confirsmModalPrice" tabindex="-1" aria-labelledby="confisrmModalLabelPrice" aria-hidden="true">
    {!! Form::open(['route' => ['donations.confirm', ['donation' => 1]], 'method' => 'post']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirsmModalPrice">@lang('site.are_you_sure_from_confirm')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="type" id="type">
            <input type="hidden" name="doner_id" id="doner_id">
            <input type="hidden" name="case_id" id="case_id">
            
            <div id="image" style="margin-top: 20px; text-align: center;">
                <img id="image" src="" alt="Image Preview" style="max-width: 50%; border: 1px solid #ccc; padding: 10px; border-radius: 10px;">
            </div>

            <div class="modal-footer">
                {!! Form::button(__('site.close'), ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal', 'type'
                => 'button']) !!}
                {!! Form::button(__('site.confirm'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    </form>
</div>