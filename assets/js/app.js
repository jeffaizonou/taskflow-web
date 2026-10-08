const projectId = 1;

async function loadTasks() {
    const response = await fetch(`api/tasks.php?project_id=${projectId}`);
    const tasks = await response.json();

    const list = document.getElementById('taskList');
    list.innerHTML = '';

    tasks.forEach(task => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';

        const badgeClass = task.status === 'done' ? 'bg-success'
            : task.status === 'doing' ? 'bg-warning'
            : 'bg-secondary';

        li.innerHTML = `
            <span>${task.title} <span class="badge ${badgeClass}">${task.status}</span></span>
            <span>
                <button class="btn btn-sm btn-outline-success" onclick="markDone(${task.id})">✓</button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteTask(${task.id})">🗑</button>
            </span>
        `;
        list.appendChild(li);
    });
}

async function markDone(id) {
    await fetch('api/tasks.php', {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, status: 'done' })
    });
    loadTasks();
}

async function deleteTask(id) {
    await fetch(`api/tasks.php?id=${id}`, { method: 'DELETE' });
    loadTasks();
}

document.getElementById('taskForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const title = document.getElementById('title').value;

    await fetch('api/tasks.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ project_id: projectId, title: title })
    });

    document.getElementById('title').value = '';
    loadTasks();
});

loadTasks();