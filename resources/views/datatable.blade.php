@extends('app')
@section('body')
    <div class="container">
        <button type="button" id="click" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Add Personal
        </button>
    </div><br/>
    <div class="container">
        <table class="table table-bordered user_datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Personal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="Form">
                    <div class="modal-body">
                        <input type="text" class="form-control" id="name" name="name" placeholder="username"><br/>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="surname"><br/>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="phone"><br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeSavingModal" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="saveButton" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLongupdate" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="FormUpdate">
                    <div class="modal-body">
                        <input type="text" class="form-control" id="nameUpdate" name="name" placeholder="username"><br/>
                        <input type="text" class="form-control" id="surnameUpdate" name="surname" placeholder="surname"><br/>
                        <input type="number" class="form-control" id="phoneUpdate" name="phone"
                               placeholder="phone"><br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeUpdateModal" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="updateButton" class="btn btn-primary">Update changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        $(function () {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('personal.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'phone', name: 'phone'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });

        $('#click').on('click', function () {
            $('#Form').trigger('reset');
            $('#saveButton').on('click', function (e) {
                e.preventDefault()
                $.ajax({
                    data: $('#Form').serialize(),
                    url: '{{route('personal.store')}}',
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        $('#createForm').trigger('reset');
                        $('#closeSavingModal').click();
                    },
                    error: function (data) {
                        console.log('error', data);
                    }
                })
            })
        })

        $('body').on('click', '#deletePersonal', function (message) {
            var personalID = $(this).data('id');
            $.ajax({
                url: "{{url('/api/personal/')}}" + '/' + personalID,
                type: 'DELETE',
                success: function (data) {
                    alert('successfully deleted', data)
                },
                error: function (data) {
                    console.log('error', data)
                }
            })
        })

        $('body').on('click', '#updatePersonal', function () {
            var personalID = $(this).data('id');
            $.get('{{url('/api/personal/')}}' + '/' + personalID + '/edit', function (data) {
                $('#nameUpdate').val(data.name);
                $('#surnameUpdate').val(data.surname);
                $('#phoneUpdate').val(data.phone);

                $('#updateButton').on('click', function () {
                    $.ajax({
                        data: $('#FormUpdate').serialize(),
                        url: '{{url('/api/personal')}}' + '/' + data.id,
                        dataType: 'json',
                        type: 'PUT',
                        success: function (data) {
                            $('#closeUpdateModal').click();
                        },
                        error: function (data) {
                            console.log('error', data)
                        }
                    })
                })
            })
        })
    </script>
@endsection
