@extends('admin.app')
@section('title','User Keyword View')
@section('content')  
               
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">User Keyword Group View</h6>
                <a title="Create" class=" BootModal btn btn-info float-end" href="{{ route('keywords.create') }}" actionUrl="{{ route('keywords.store') }}">Add New Keyword</a>
            </div>
        </div>

        <div class="keyword-table-parent">
        
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
       </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

{{-- custom js --}}
@section('script')
<script >
    $(document).ready(function() {



        // csrf protection
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let dialog = '';
        let formId = '';
        let actionUrl = '';
        let modalUrl = '';
        let msg = '';

        // bootbox modal show
        $(document).on('click', '.BootModal', function(e) {
            e.preventDefault();

            modalUrl = $(this).attr('href');
            actionUrl = $(this).attr('actionUrl');
            let modaltitle = $(this).attr('title');

            $.ajax({
                type: "GET",
                url: modalUrl,
                success: function(res) {
                    console.log('pok');
                    dialog = bootbox.dialog({
                        title: 'Keyword '+modaltitle,
                        message: "<div id='keywordModelContent'></div>",
                        size: 'large',
                    });
                    $('#keywordModelContent').html(res);
                    formId = '#' + $('#keywordModelContent').find('form').attr('id');
                }
            });
        });

        // form submit
        $(document).on('submit', formId, function(e) {
            e.preventDefault();
            let formData = new FormData($(formId)[0]);
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    if (res.status === 400) {
                        $('.errors').html('');
                        $('.errors').removeClass('d-none');
                        $('.chat_keyword_error').text(res.errors.chat_keyword)

                    } else {
                        dialog.modal('hide');
                        $('.errors').html('');
                        $('.errors').addClass('d-none');
                        formId === '#createkeyWordForm' ? msg = 'Created' : msg = 'Updated';
                        toastr.success('Keywords Successfully ' + msg + '!', 'Keywords ' +
                            msg + '');
                       // $('.keyword-table-parent').load(location.href + ' .keyword-table-parent');
                        $('#dataTable').load(location.href + ' #dataTable');
                    }
                }
            });
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
                                formId !== '#createkeyWordForm' || formId !== '#editkeyWordForm' ? msg = 'Deleted' : msg = '';
                                toastr.success('Keyword Successfullly ' + msg + '!', 'Keyword ' + msg + '');
                                $('#dataTable').load(location.href + ' #dataTable');


                            } else {
                                toastr.danger('Keyword Not Found!', 'Keyword 404');

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
            url: "keyword/pagination?page="+page,
            success: function (res) {
                $('.keyword-table-parent').html(res);
                
            }
         });
            
        });

    }); 

</script>

@endsection
