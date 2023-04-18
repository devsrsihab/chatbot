
<div class="panel-body">
    <form class="form-horizontal" action="{{ route('keyword.store') }}" method="POST">
        @csrf

        <fieldset class="content-group">
            <legend class="text-bold"></legend>
            <div class="form-group">
                <label class="control-label col-lg-2">Keyword</label>
                <div class="col-lg-10">
                    <textarea name="chat_keyword" class="form-control" placeholder="Write Kewyord Here"></textarea>
                </div>
            </div>
        </fieldset>

    </form>
</div>
       
