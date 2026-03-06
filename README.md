# Laravel Inactive User Reminder

This project automatically detects inactive users and sends a reminder once per day using Laravel's scheduler and queue system.

---

## **Setup Instructions**

1. Clone the repository:

```bash
git clone https://github.com/Marziul01/laravel-assignment.git

2. Install dependencies: 

composer install

3. Copy .env.example to .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_intern_project
DB_USERNAME=root
DB_PASSWORD=
INACTIVE_USER_DAYS=7

4. Generate the application key:

php artisan key:generate

5. Run migrations:

php artisan migrate

6. Create new users using sql or seed , and add the last_login_at

sql code :

INSERT INTO users (name,email,password,last_login_at)
VALUES ('John','john@test.com','123678', '2024-01-01');

7. now run the Schedule 

php artisan app:check-inactive-users  ( It will run the schedule to check and put reminder jobs to queue )

8. run the queue

php artisan queue:work 

9. You can check the laravel.log or database , in both case i am saving everyday the reminder message

# finger crossed it will run 🤞🤞