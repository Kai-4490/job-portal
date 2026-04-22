
# Job Portal Web Application

A role-based Job Portal built using PHP and MySQL where employers can post jobs and manage applicants, and job seekers can apply and track their application status.

---

## Features

### Job Seeker
- Register and login
- Browse available jobs
- Apply for jobs
- Withdraw applications (only if pending)
- Track application status:
  - Pending
  - Accepted
  - Rejected

### Employer
- Login
- Post new jobs
- Manage job listings (edit/delete)
- View applicants for each job
- Accept or reject applications

---

## Workflow

1. Job seeker applies for a job  
2. Employer reviews applicants  
3. Employer accepts or rejects  
4. Job seeker sees updated status  

---

## Tech Stack

- Frontend: HTML, CSS (Bootstrap)
- Backend: PHP
- Database: MySQL
- Server: XAMPP (Apache)

---

## Project Structure

job-portal/
├── db.php
├── login.php
├── register.php
├── logout.php
├── jobseeker_dashboard.php
├── jobs.php
├── my_applications.php
├── employer_dashboard.php
├── add_job.php
├── manage_jobs.php
├── view_applicants.php
├── navbar.php
├── navbar_employer.php
├── styles.css
└── README.md

## Setup Instructions

### 1. Clone the repository


git clone https://github.com/Kai-4490/job-portal


---

### 2. Move to XAMPP directory

Place the project inside:


C:\xampp\htdocs\


---

### 3. Start XAMPP

- Start Apache  
- Start MySQL  

---

### 4. Setup Database

1. Open phpMyAdmin  
2. Create database: `job_portal`  
3. Import the SQL file  

---

### 5. Configure Database Connection

Edit `db.php`:

```php
$conn = new mysqli("localhost", "root", "", "job_portal");
6. Run the Project

Open in browser:

http://localhost/job-portal/


-----
