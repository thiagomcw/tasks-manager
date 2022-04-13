# Tasks Manager

## Dependencies

- Docker: >= 20;
- Docker Compose: >= 1.29;

## Setup

<p>Run the following command on your terminal to start the project:</p>

- `docker-compose up --build`;

<p>Wait Docker finishes all the processes. This happens when you see the following information:</p>

```
tasks-manager-php-build exited with code 0
```

## Automated tests

Use the following commands to run the automated tests:

**Enter the application container:**

```
docker exec -it tasks-manager-php bash
```

**Run the tests:**

```
composer tests
```
