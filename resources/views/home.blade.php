<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasks Manager</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="antialiased">

<div class="container" id="app">
    <app-home inline-template>
        <div class="w-9">
            <form class="form-inline my-3" @submit.prevent="storeTask">
                <div class="input-group flex-fill">
                    <input type="text" placeholder="New task" class="form-control" v-model="newTaskTitle" required>
                    <div class="input-group-append">
                        <input type="submit" name="commit" value="+ Add" class="btn btn-primary">
                    </div>
                </div>
            </form>

            <ul class="list-group" v-cloak>
                <li class="list-group-item task-item" v-for="task in tasks"
                    :class="{completed: task.completed}">
                    <span @click="updateTask(task)">
                        @{{ task.title }}
                    </span>
                    <button type="button" class="btn btn-danger float-right" @click="deleteTask(task.id)">X</button>
                </li>
            </ul>
        </div>
    </app-home>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
