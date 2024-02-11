# Assessment Test Backend SDT

## Installation

Follow these steps to set up and run the project locally.

### 1. Clone the Repository
Clone this repository:
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

### 2. Configure Environment Variables
Copy the .env.example file to .env:
```bash
cp .env.example .env
```
Edit the .env file and add your configuration settings and database credentials.
Change the hour in HOUR_SEND value to send at that hour.

### 3. Import Demo SQL
Import the demo.sql file into your database.

### 4. Install Dependencies
```bash
composer install
npm install
```

### 5. Run the Application
```bash
php artisan serve
```
Note : If you need user seeder run
```bash
php artisan db:seed --class=EmailContactSeeder
```

### 6. Login to Admin Panel
Visit http://localhost:8000/admin and log in with the following credentials:

Username: admin
Password: admin

### 7. Run Cron Job
```bash
* * * * * curl -s http://localhost:8000/queue-work
*/2 * * * * curl -s http://localhost:8000/cron/run
```

### 8. check API Documentation
After logging in, navigate to the API documentation section to explore the available APIs:

Visit http://localhost:8000/api/documentation

Explore and use the provided API documentation to understand and interact with the available APIs.

Feel free to reach out if you encounter any issues during the installation process or have questions about the API documentation.