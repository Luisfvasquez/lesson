$(document).ready(function(){
    let edit=false;
    $('#task-result').hide();
    fechtTasks();


    $('#search').keyup(function(e){//La "e" toma el evento que se esta ejecutando
       if($('#search').val()){
        let search =$('#search').val();
        $.ajax({
            url:'Models/task-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                let tasks=JSON.parse(response);
                let tepmplate='';

                tasks.forEach(task => {
                    tepmplate+=`<li>
                    ${task.Nombre}
                    </li>`
                });

                $('#container').html(tepmplate);
                $('#task-result').show();
            }
        });
       }
    });

    $('#task-form').submit(function(e){
        const posData={
            name: $('#name').val(),
            description: $('#description').val(),
            id: $('#taskId').val()
        };

        let url= edit ===false ? 'Models/task-add.php' : 'Models/task-edit.php';
       

        $.post(url, posData, function(responde){
            fechtTasks();
            $('#task-form').trigger('reset');
        });
        e.preventDefault();//Cancela el evento por defecto de un formulario
    });

   function fechtTasks(){
    $.ajax({
        url:'Models/task-list.php',
        type: 'GET',
        success: function (response){
            let tasks =JSON.parse(response);
            let tepmplate='';
            tasks.forEach(task => {
                tepmplate+=`
                <tr taskId="${task.Id}" >
                    <td>
                       ${task.Id}
                    </td>
                    <td>
                        <a href="#" class="task-item">${task.Nombre}</a>
                    </td>
                    <td>${task.Descripcion}</td>
                    <td>
                        <button class="task-delete btn btn-danger">
                        Delete
                    </button>
                    </td>
                </tr>`
            });

            $('#tasks').html(tepmplate);
        }
    });
   }

   $(document).on('click', '.task-delete', function(){
        if(confirm('Are you sure you want to delete it?')){
            let element=$(this)[0].parentElement.parentElement;
            let id=$(element).attr('taskId');
           $.post('Models/task-delete.php', {id}, function(response){
             fechtTasks();
             });
        }
   });

   $(document).on('click', '.task-item', function(){
    let element=$(this)[0].parentElement.parentElement;
    let id=$(element).attr('taskId');
        $.post('Models/task-single.php', {id}, function(response){
            const task=JSON.parse(response);
            $('#name').val(task.Nombre);
            $('#description').val(task.Descripcion);
            $('#taskId').val(task.Id);
            edit=true;
        });
   });

});