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
- Static Application Security Testing (SAST) using Snyk Code to identify any insecure coding patterns
- Dynamic Application Security Testing (DAST) using Burp Suite to scans for any dependencies for known vulnerabilities
- Manual testing for common vulnerabilities such as SQL Injection, Cross‑Site Scripting (XSS), and Cross‑Site Request Forgery (CSRF)

## Commit Evidence
Each security‑related activity, including scan evidence and documentation updates, was committed to the repository with clear commit messages to maintain traceability and accountability.
