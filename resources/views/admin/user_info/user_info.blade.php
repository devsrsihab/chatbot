@extends('admin.app')
@section('title','User IP List')
@section('content')  
               
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">User Message info</p>
    <p class="mb-4">This table displays a list of messages sent by users. You can use the buttons in the 'Action' column to delete individual messages if necessary.</p>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User SMS Datatable</h6>
        </div>
        <div class="user_parent_table">
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
    </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

{{-- custom js --}}
@section('script')
<script>
$(document).ready(function () {

            // csrf protection
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


            // confirmation delete
            $(document).on('click', '.delete-form', function(e) {
            e.preventDefault();

            //token
            let csrf = $(this).find('input[name="_token"]').val();
            //delete link
            let deleteLink = $(this).attr('action');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    //ajax 
                    $.ajax({
                        type: "POST",
                        url: deleteLink,
                        data: {
                            '_token': csrf,
                            '_method': 'DELETE'
                        },

                        success: function(response) {

                            if (response.status === 200) {
                            
                                toastr.success('User Info Successfullly deleted!', 'User Info deleted');
                                $('.user_parent_table').load(location.href + ' .user_parent_table');


                            } else {
                                toastr.error('User Info Not Found!', 'User Info 404');

                            }

                        }
                    });

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });

              // pagination
      $(document).on('click','.page-link', function (e) {
            e.preventDefault();
         let page = $(this).attr('href').split('page=')[1];
         
         $.ajax({
            type: "GET",
            url: "userInfo/pagination?page="+page,
            success: function (res) {
                $('.user_parent_table').html(res);
                
            }
         });
            
        });
});
</script> 
@endsection
