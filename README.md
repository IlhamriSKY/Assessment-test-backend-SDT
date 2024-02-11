# Assessment Test Backend SDT

## Installation

Follow these steps to set up and run the project locally.

### 1. Clone the Repository
Begin by cloning this repository:
```bash
git clone https://github.com/IlhamriSKY/Assessment-test-backend-SDT.git
cd Assessment-test-backend-SDT
```

### 2. Configure Environment Variables
Copy the .env.example file to .env:
```bash
cp .env.example .env
```
Open the .env file and input your configuration settings and database credentials. Ensure to modify the HOUR_SEND value to the desired hour for scheduled sending.

### 3. Import Demo SQL
Import the demo.sql file into your database.

### 4. Install Dependencies
Install the necessary dependencies using:
```bash
composer install
```

### 5. Run the Application
Initiate the application with:
```bash
php artisan serve
```
Note : If you need user seeder run
```bash
php artisan db:seed --class=EmailContactSeeder
```

### 6. Login to Admin Panel
Navigate to http://localhost:8000/admin and log in using the following credentials:

Username: admin
Password: admin

### 7. Run Cron Job
Set up cron jobs for automated tasks:
```bash
* * * * * curl -s http://localhost:8000/queue-work
*/2 * * * * curl -s http://localhost:8000/cron/run
```

### 8. Add SMTP GATEWAY
Access http://localhost:8000/admin/mail/gateways and provide the necessary SMTP credentials.

### 9. check API Documentation
After logging in, visit http://localhost:8000/api/documentation to access and comprehend the available APIs.

Explore the API documentation to understand and interact with the functionalities.

Feel free to reach out if you encounter any issues during the installation process or have questions about the API documentation.