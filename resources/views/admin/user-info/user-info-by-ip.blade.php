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
                                <button class="btn btn-danger text-uppercase">delete</button>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="3"><b class="text-danger">No Data Found</b></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

{{-- custom js --}}
@section('script')
<script>

</script> 
@endsection
