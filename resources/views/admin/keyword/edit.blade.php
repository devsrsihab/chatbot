
<div class="panel-body">
    <form class="form-horizontal" id="editkeyWordForm"  method="POST">
        @csrf
        @method('PUT')

        <fieldset class="content-group">
            <div class="form-group">
                <label class="control-label col-lg-2">Keyword</label>
                <div class="col-lg-10">
                    <textarea name="chat_keyword" class="chat_keyword form-control" placeholder="Write Kewyord Here">{{ $keyword->chat_keyword }}</textarea>
                    <div class="errors text-danger chat_keyword_error d-none"></div>
                </div>
            </div>

            <div class="buttons text-right">
                <button type="button" class="btn btn-danger bootbox-close-button ">Close</button>
                <button type="submit" class="btn btn-info">Save</button>
            </div>

        </fieldset>

    </form>
</div>
       
