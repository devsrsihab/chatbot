@extends('admin.app')
@section('title','User Keyword Respponse View')
@section('content')  
               
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <p class="mb-4">User Message info</p>
    <p class="mb-4">This table displays a list of messages sent by users. You can use the buttons in the 'Action' column to delete individual messages if necessary.</p>
     --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-0 font-weight-bold text-primary">User Keyword Response Group View</h6>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-info open-modal" modal-link="{{ route('reponse.create') }}" modal-title="Blog Category Create" modal-type="create" modal-size="large" modal-class="rubberBand animated" selector="categoryCreate">Add</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Keyword</th>
                            <th>Response</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Keyword</th>
                            <th>Response</th>
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
