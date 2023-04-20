
<div class="panel-body">
    <form id="editResponseForm" class="form-horizontal"  method="POST">
        @csrf
        @method('PUT')
        <fieldset class="content-group">
            <legend class="text-bold"></legend>
            <div class="form-group">
                <label class="control-label col-lg-2">Keyword</label>
                <div class="col-lg-10">
                    <select name="keywords_id" class="form-control">

                        <option value="">Select Keyword</option>
                        @foreach ($keywords as $key => $keyword)
                            <option {{ $keyword->id == $response->keywords_id  ? 'selected' : '' }}  value="{{ $keyword->id }}">{{ $keyword->chat_keyword }}</option>
                        @endforeach
                    </select>
                    <div class="keywords_id_error errors text-danger d-none"></div>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Response</label>
                <div class="col-lg-10">
                    <textarea name="chat_response" class="form-control" placeholder="Write Kewyord Here">{{ $response->chat_response }}</textarea>
                </div>
                <div class="chat_response_error errors text-danger d-none"></div>

            </div>

            <div class="buttons text-right">
                <button type="button" class="btn btn-danger bootbox-close-button ">Close</button>
                <button type="submit" class="btn btn-info">Save</button>
            </div>

        </fieldset>

    </form>
</div>
       
