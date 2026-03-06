# Laravel Inactive User Reminder

This project automatically detects inactive users and sends a reminder once per day using Laravel's scheduler and queue system.

---

## **Setup Instructions**

1. Clone the repository:

git clone https://github.com/Marziul01/laravel-assignment.git

cd laravel-assignment

2. Install dependencies: 

composer install

3. copy the .env.example and create a new file ".env" and remove the comments "#" from the details below

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

6. Create new users using SQL or seed, and add the last_login_at

SQL code :

INSERT INTO users (name,email,password,last_login_at)
VALUES ('John','john@test.com','123678', '2026-01-01');

7. Now run the Schedule 

php artisan app:check-inactive-users  ( It will run the schedule to check and put reminder jobs to the queue )

8. run the queue

php artisan queue:work 

9. You can check the storage/logs/laravel.log
   or
   database table "reminders" , in both case i am saving the reminder message every day

# fingers crossed it will run 🤞🤞
