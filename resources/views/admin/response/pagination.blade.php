<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Keyword</th>
                    <th>Reponse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Serial</th>
                    <th>Keyword</th>
                    <th>Reponse</th>
                    <th>Action</th>             
                </tr>
            </tfoot>
            <tbody>

                @forelse ($responses as $key=>$response )

                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $response->chat_keyword }}</td>
                    <td>{{ $response->chat_response }}</td>
                    <td>
      

                        <a title="Edit" actionUrl="{{ route('responses.update',$response->id) }}"
                            class="BootModal btn btn-success" href="{{ route('responses.edit',$response->id) }}"><i class="fa-regular fa-pen-to-square"></i></a>

                        <form title="Delete" action="{{ route('responses.destroy',$response->id) }}" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <a class= "btn btn-danger" href=""><i class="fa-regular fa-trash-can"></i></a>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="3"><b class="text-danger">No Data Found</b></td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $responses->links() }}
    </div>
</div>