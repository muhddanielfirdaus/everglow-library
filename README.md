## Project Description
The Everglow Library repository hosts the source code for a Laravel‑based web application developed for managing library resources. The project follows the Model–View–Controller (MVC) architecture and includes user authentication, routing, database migrations, and frontend assets.

## Development / Testing Environment
- XAMPP: Local server environment to run Apache, PHP, and MySQL
- PHP / Laravel Framework: Backend application logic
- Browser (Chrome/Chromium): For UI interaction and testing
- Composer: PHP dependency management


## Technologies Used
- PHP (Laravel Framework)
- MySQL
- HTML, CSS, JavaScript
- Composer
- Git & GitHub

## Security‑Related Files in Repository
- .env.example – Environment variable template (no secrets exposed)
- composer.lock – Dependency version locking
- package-lock.json – JavaScript dependency locking
- .gitignore – Prevents sensitive files from being committed

## Security Testing Tools
This repository serves as the target application for:
- Static Application Security Testing (SAST) using Snyk Code to identify any insecure coding patterns.
- Dynamic Application Security Testing (DAST) using Burp Suite to scans for any dependencies for known vulnerabilities.
-. Manual testing for common vulnerabilities such as SQL Injection, Cross‑Site Scripting (XSS), and Cross‑Site Request Forgery (CSRF)

## Security Implementation
The Everglow Library application has implemented multiple security measures to protect user data and ensure safe operation. The security implementation focuses on best practices that are inspired by the OWASP Top 10 vulnerabilities including the authentication, access control and request validation.

Key Security Measures:

 1. Authentication:
    - The users must register and log in before accessing the restricted parts of the application.
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

## Commit Evidence
Each security‑related activity, including scan evidence and documentation updates, was committed to the repository with clear commit messages to maintain traceability and accountability.
