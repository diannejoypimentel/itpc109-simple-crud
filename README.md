# ITPC 109 Simple CRUD Application

A simple Student Records Management web app. It lets you add, view, edit, and delete students.

## Technologies
- PHP (PDO)
- MySQL
- Apache
- Docker / Docker Compose
- Git / GitHub

## Run
```
docker compose up -d --build
```

## Application
http://localhost:8080

## phpMyAdmin
http://localhost:8081

- Server: `db`
- Username: `student_user`
- Password: `student_pass`

## Stop
```
docker compose down
```
## Testing
   - Create: added a new student and confirmed it appeared in the list
   - Read: refreshed the page and confirmed the record remained
   - Update: edited the student's course and confirmed the change
   - Delete: deleted the test student and confirmed it was removed
   - Validation: submitted a blank field and confirmed the server rejected it