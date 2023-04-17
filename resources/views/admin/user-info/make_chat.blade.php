@extends('admin.app')
@section('content')
<form action="">
    <div class="form-group">
        <input name="chat_group" type="text" class="form-control" placeholder="Write Group">
        <textarea name="chat_keywords" id="" class="form-control" cols="30" rows="10" placeholder="Write Keywords"></textarea>
        <textarea name="chat_reponses" id="" class="form-control" cols="30" rows="10" placeholder="Write Responses"></textarea>

        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
    
@endsection