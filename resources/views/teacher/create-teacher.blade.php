<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Ajax Crud</title>
</head>

<body>
    <div style="padding: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        All teacher
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Institute</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Fcub</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger ml-3"
                                            onclick="deleteData(3);">Delete</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="addT">Add New Teacher</span>
                        <span id="upadteT">Update Teacher</span>
                    </div>
                    <div class="card-body">
                        <form>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                                <span class="text-danger" id="nameError"></span>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title">
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Institute</label>
                                    <input type="text" class="form-control" id="institute">
                                    <span class="text-danger" id="instituteError"></span>
                                </div>
                                <input type="hidden" id="id">
                                <button type="button" id="addButton" onclick="addData()"
                                    class="btn btn-primary">Add</button>
                                <button type="button" id="updateButton" onclick="updateData()"
                                    class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
    <script>
        $('#addT').show();
        $('#upadteT').hide();
        $('#addButton').show();
        $('#updateButton').hide();
        // var num = $('#addT')
        // console.log(num);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // <!----------------------------get all data from start------------------------->

        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/teacher/all",
                success: function(response) {
                    var data = ""
                    $.each(response, function(key, value) {
                        data = data + "<tr>"
                        data = data + "<td>" + value.id + "</td>"
                        data = data + "<td>" + value.name + "</td>"
                        data = data + "<td>" + value.title + "</td>"
                        data = data + "<td>" + value.institute + "</td>"
                        data = data + "<td>"
                        data = data + "<button class='btn btn-sm btn-primary' onclick = 'editData(" +
                            value.id + ")'>Edit</button>"
                        data = data + "<button class='btn btn-sm btn-danger' onclick = 'deleteData(" +
                            value.id + ")' >Delete</button>"
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('tbody').html(data);
                }
            })
        }
        allData();
        // <!----------------------------get all data from end------------------------->
        // <!----------------------------clear data start------------------------->
        function clearData() {
            $('#name').val('');
            $('#title').val('');
            $('#institute').val('');

            $('#nameError').text('');
            $('#titleError').text('');
            $('#instituteError').text('');
        }
        // <!----------------------------clear data end------------------------->
        // <!----------------------------store  data start------------------------->
        function addData() {
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "/teacher/store/",
                success: function(data) {
                    clearData();
                    allData();
                    // start sweet alart
                    const Msg = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'successfully data added',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    Msg.fire({
                        type: 'success',
                        title: 'successfully data added',
                    })
                    // end sweet alart
                    console.log('successfully data added');
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);

                }
            })
        }
        // <!-- -- -- -- -- -- -- -- -- -- -- -- -- --store data end-- -- -- -- -- -- -- -- -- -- -- -- - >

        // =====================================start edit Data===========================================
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/teacher/edit/" + id,
                success: function(data) {

                    $('#addT').hide();
                    $('#upadteT').show();
                    $('#addButton').hide();
                    $('#updateButton').show();
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#title').val(data.title);
                    $('#institute').val(data.institute);
                    console.log(data);
                }
            });
        }
        // =====================================end edit Data=============================================

        // ----------------------------------------Updte data Start------------------------------------------
        function updateData() {
            var id = $('#id').val();
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "/teacher/update/" + id,
                success: function(data) {
                    $('#addT').show();
                    $('#upadteT').hide();
                    $('#addButton').show();
                    $('#updateButton').hide();
                    clearData();
                    allData();
                    // start sweet alart
                    const Msg = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'successfully data update',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    Msg.fire({
                        type: 'success',
                        title: 'successfully data update',
                    })
                    // end sweet alart
                    console.log('data updated');
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);
                }
            })

        }
        // ----------------------------------------Updte data End------------------------------------------

        // -------------------------------------------Delete Data  start-----------------------------------------
        function deleteData(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                type: "GET",
                dataType: "json",
                url: "/teacher/destroy/" + id,
                success: function(data) {

                    $('#addT').hide();
                    $('#upadteT').show();
                    $('#addButton').hide();
                    $('#updateButton').show();

                    clearData();
                    allData();
                     // start sweet alart
                     const Msg = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'successfully data update',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    Msg.fire({
                        type: 'success',
                        title: 'successfully data deleted',
                    })
                    // end sweet alart
                    console.log('deleted');
                },
                error: function(error) {
                    console.log(error);
                }
            })

                    } else {
                        swal("Canceled!");
                    }
                });

        }
        // -------------------------------------------Delete Data  END-----------------------------------------
    </script>
</body>

</html>
