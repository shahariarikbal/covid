## About Project

COVID Vaccine Registration System (Laravel 10). and Follow these steps to set up and run the project.

- Clone the project from the provided repository link.
- Copy the env.example file, rename it to .env, and set the following database credentials, DB_DATABASE=covid DB_USERNAME=root DB_PASSWORD=test.
- Run `composer update` to install dependencies
- Run `php artisan key:generate` to generate the application key
- Run `php artisan migrate:fresh --seed` to set up the database with the latest migrations and seed data.
- If you are using Docker, the project includes Dockerfile and docker-compose.yml files. To start Docker, run the command `docker compose up -d`
- Run `php artisan serve` to start the local development server
- Open a browser and visit `http://localhost:8000/` for the project
- Open a browser and visit `http://localhost:4500/` for phpMyAdmin
- To configure email notifications for sending reminders to users the night before their scheduled vaccination date at 9 PM, set the following in your .env file, `MAIL_MAILER=smtp`, `MAIL_HOST=sandbox.smtp.mailtrap.io`, `MAIL_PORT=2525`, `MAIL_USERNAME=username`, `MAIL_PASSWORD=password`.
- To process emails and scheduled tasks, run the following commands `php artisan queue:work` and `php artisan schedule:run`
- To check your vaccination date, navigate to the Vaccine List menu at the top. Enter your NID number in the search input field and view the results.
