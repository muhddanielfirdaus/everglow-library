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

 6. Run the database migrations:
    - php artisan migrate

## Security Features Summary
The Everglow Library application has implemented multiple security measures to protect user data and ensure safe operation. The security implementation focuses on best practices that are inspired by the OWASP Top 10 vulnerabilities including the authentication, access control and request validation.

1. Authentication:
    - The users must register and log in before accessing the restricted parts of the
      application.
    - The passwords are hashed using a secure algorithm (bcrypt/argon2) to prevent the
      exposure of plaintext credentials.
    - All of the login attempts are monitored closely to mitigate any brute force attacks.

 2. Role-Based Access Control (RBAC):
    - The users has their own assigned roles (e.g., Admin, Regular User) with each their own
      specific permissions.
    - All of the sensitive actions, such as managing books or user accounts are restricted to
      authorized roles only.
      
 3. Cross-Site Request Forgery (CSRF) Protection:
    - All forms must include CSRF tokens to ensure that any malicious requests from third
      party sites cannot execute any actions on behalf of authenticated users.
    - Laravel CSRF middleware is used to validate all of the requests.
   
 4. Input Validation & Sanitization:
    - User inputs are validated and sanitized in order to prevent SQL Injection and Cross-Site
      Scripting (XSS) attacks.
    - Backend and frontend validations are used to ensure the data integrity.

 5. Sensitive Information Handling:
    - Environment files (e.g., .env) and secret keys are not committed to the repository.
    - Sensitive data such as passwords, tokens and API keys are never exposed in frontend side
      of code or logs.

 6. Security Testing Tools
    - Static Application Security Testing (SAST) using Snyk Code to identify any insecure 
      coding patterns.
    - Dynamic Application Security Testing (DAST) using Burp Suite to scans for any
      dependencies for known vulnerabilities.
    - Manual testing for common vulnerabilities such as SQL Injection, Cross‑Site Scripting
      (XSS) and Cross‑Site Request Forgery (CSRF).
  
 7. Commit Evidence
      Each security‑related activity, including scan evidence and documentation updates, was
      committed to the repository with clear commit messages to maintain traceability and
      accountability.

## How To Run The App
 1. Start the Laravel development server:
    - php artisan serve 

 2. Open the browser and visit:
    - http://127.0.0.1:8000

 3. Log in with a default account (if available) or register as a new user.

 4. Admin users can access the restricted functionalities such as book management and user
    account management.

## Dependencies
 - Backend: PHP >= 8.1, Laravel Framework 10.x
 - Database: MySQL 8.x
 - Frontend: HTML, CSS & JavaScript
 - Package Management: Composer & npm
 - Version Control: Git & GitHub
