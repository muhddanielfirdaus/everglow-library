## Project Description
The Everglow Library repository hosts the source code for a Laravel‑based web application developed for managing library resources. The project follows the Model–View–Controller (MVC) architecture and includes user authentication, routing, database migrations, and frontend assets.

## Installation Steps
 
 1. Clone the repository:
    - git clone https://github.com/muhddanielfirdaus/everglow-library.git

 2. Navigate to the project directory:
    - cd everglow-library
 
 3. Install dependencies:
    - composer install
    - npm install
      
 4. Copy the .env.example to .env and set up database credentials:
    - cp .env.example .env

 5. Generate the application key:
    - php artisan key:generate

 6. Run database migrations:
    - php artisan migrate
