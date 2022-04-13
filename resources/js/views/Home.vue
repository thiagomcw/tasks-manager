<script>
import Tasks from "../api/endpoints/Tasks";

export default {
    name: "AppHome",

    data() {
        return {
            tasks: [],
            newTaskTitle: ''
        }
    },

    methods: {
        loadTasks() {
            Tasks.index()
                .then((response) => this.tasks = response.data)
        },

        storeTask() {
            Tasks
                .store({title: this.newTaskTitle})
                .then(() => {
                    this.loadTasks();
                    this.newTaskTitle = '';
                });
        },

        updateTask(task) {
            Tasks
                .update(task.id, {completed: !task.completed})
                .then(() => this.loadTasks());
        },

        deleteTask(taskId) {
            Tasks
                .destroy(taskId)
                .then(() => this.loadTasks());
        }
    },

    created() {
        this.loadTasks();
    }
}
</script>
