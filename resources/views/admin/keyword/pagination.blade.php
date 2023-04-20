<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Keyword</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Serial</th>
                    <th>Keyword</th>
                    <th>Action</th>             
                </tr>
            </tfoot>
            <tbody>

                @forelse ($keywords as $key=>$keyword )

                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $keyword->chat_keyword }}</td>
                    <td>
                        <a title="View" class="BootModal btn btn-info" href="{{ route('keywords.show',$keyword->id) }}"><i class="fa-regular fa-eye"></i></a>

                        <a title="Edit" actionUrl="{{ route('keywords.update',$keyword->id) }}"
                            class="BootModal btn btn-success" href="{{ route('keywords.edit',$keyword->id) }}"><i class="fa-regular fa-pen-to-square"></i></a>

                        <form title="Delete" action="{{ route('keywords.destroy',$keyword->id) }}" class="d-inline delete-form">
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

        {{ $keywords->links() }}
    </div>
</div>