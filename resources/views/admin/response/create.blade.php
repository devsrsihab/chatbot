
<div class="panel-body">
    <form class="form-horizontal" action="{{ route('reponse.store') }}" method="POST">
        @csrf

        <fieldset class="content-group">
            <legend class="text-bold"></legend>
            <div class="form-group">
                <label class="control-label col-lg-2">Keyword</label>
                <div class="col-lg-10">
                    <select name="keywords_id" class="form-control">

                        <option value="">Select Keyword</option>
                        @foreach ($keywords as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->chat_keyword }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Response</label>
                <div class="col-lg-10">
                    <textarea name="chat_response" class="form-control" placeholder="Write Kewyord Here"></textarea>
                </div>
            </div>
        </fieldset>

    </form>
</div>
       
