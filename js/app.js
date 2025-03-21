// Adiciona confirmação de exclusão
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function (e) {
        if (!confirm('Você tem certeza que deseja excluir esta tarefa?')) {
            e.preventDefault(); // Impede a ação de exclusão se o usuário cancelar
        }
    });
});

// Filtra as tarefas (pendentes, concluídas ou todas)
document.addEventListener('DOMContentLoaded', () => {
    const filterPendingBtn = document.getElementById('filter-pending');
    const filterCompletedBtn = document.getElementById('filter-completed');
    const filterAllBtn = document.getElementById('filter-all');
    const taskList = document.getElementById('task-list');

    filterPendingBtn.addEventListener('click', () => {
        filterTasks('pendente'); // Filtra tarefas pendentes
    });

    filterCompletedBtn.addEventListener('click', () => {
        filterTasks('concluida'); // Filtra tarefas concluídas
    });

    filterAllBtn.addEventListener('click', () => {
        filterTasks('todos'); // Exibe todas as tarefas
    });

    function filterTasks(status) {
        const tasks = taskList.querySelectorAll('.task-item');
        tasks.forEach(task => {
            const taskStatus = task.getAttribute('data-status'); // Obtém o status da tarefa (pendente ou concluida)

            if (status === 'todos' || taskStatus === status) {
                task.style.display = 'block'; // Exibe a tarefa
            } else {
                task.style.display = 'none'; // Oculta a tarefa
            }
        });
    }
});
