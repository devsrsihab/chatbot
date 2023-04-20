<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>User Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>Action</th>              
                </tr>
            </tfoot>
            <tbody>

                @forelse ($userListIpes as $userListIp )

                <tr>
                    <td>{{ $userListIp->id }}</td>
                    <td>{{ $userListIp->user_ip_adress }}</td>
                    <td>
                        @if (empty($userListIp->user_message))
                           <b class="text-danger">  {{ 'No Message' }} </b> 
                        @else                                    
                            {{ $userListIp->user_message }}
                        @endif
                    </td>
                    <td>
                        
                        <form title="Delete" action="{{ route('deleteUserInfo',$userListIp->id) }}" class="d-inline delete-form">
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
        {{ $userListIpes->links() }}
    </div>
</div> 