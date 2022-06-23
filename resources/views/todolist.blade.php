<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar TASK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body onload="initialyze()">
    <div class="container">
        <form>
            @csrf
            <label for="todolistInput">Descrição</label> <br />
            <input type="text" id="todolistInput" name="title"> <br />
            <br>

            <label for="todoName">Nome</label> <br />
            <input type="text" id="todoName" name="name"> <br />
            <br>
            
            <label for="todoDeadline">Deadline</label> <br />
            <input type="text" value="2022-05-03" id="todoDeadline" name="deadline"> <br />
            <br>
            
        </form>
        <button onclick="savetodolist()">Salvar</button>


        <div class="modal-header">
                            <h5 class="modal-title" id="editionModalLabel">Task edition</h5>
            </div>
            <div class="modal-body">
                <form>
                
                    <input type="hidden" id="task-id">
                    <label for="task-description" class="col-form-label">Description:</label>
                    <input type="text" class="form-control" id="task-description">
                
                </form>
            </div>
        <br>
        <button onclick="deletetodolist()">Delete</button>
    </div>

    <script type="text/javascript">
        function initialyze() {
            gettodolist();
        }

        function gettodolist() {
            $.ajax({
                type: "GET",
                url: "/todolist",
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        const table = document.getElementsByTagName('tbody')[0];
                        table.innerHTML = "";
                        for (var i = 0; i < data.length; i++) {
                            try {
                                const row = table.insertRow(i);
                                const cell1 = row.insertCell(0);
                                const cell2 = row.insertCell(1);
                                const cell3 = row.insertCell(2);
                                const cell4 = row.insertCell(3);
                                cell1.innerHTML = data[i].id;
                                cell2.innerHTML = data[i].description;
                                cell3.innerHTML = `<button class="btn btn-primary" onclick="openEditModal(${data[i].id},'${data[i].description}')"><i class="fa fa-edit"></i></button>`;
                                cell4.innerHTML = '<button class="btn btn-danger" onclick="deleteTask(' + data[i].id + ')"><i class="fa fa-trash"></i></button>';
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    } else {
                        var row = table.insertRow(0);
                        var cell = row.insertCell(0);
                        cell.innerHTML = 'No tasks';
                    }
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function savetodolist() {
            alert('hey');
            const task = document.getElementById('todolistInput').value;
            const name = document.getElementById('todoName').value;
            const deadline = document.getElementById('todoDeadline').value;
            // console.log(task);
            $.ajax({
                type: "POST",
                url: "/todolist",
                data: {
                    title: name,
                    description: task,
                    deadline: deadline,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // alert('success on save')
                    console.log(data);
                    // getTasks();
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            });
        }

        function deletetodolist(id) {
            $.ajax({
                type: "DELETE",
                url: `/todolist/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
                    getTasks();
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function openEditModal(id, description) {
            $('#editionModal').modal('show');
            $('#todolist-id').val(id);
            $('#task-description').val(description);
        }

        function edit() {
            var id = $('#task-id').val();
            var description = $('#task-description').val();
            $.ajax({
                type: "PUT",
                url: `/todolist/${id}`,
                data: {
                    description: description
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
                    gettodolist();
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            })
        }

    </script>
</body>
</html>