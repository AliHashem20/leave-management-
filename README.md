# Leave Management System

This is a Leave Management System built with Laravel that allows employees to submit leave requests and admins to manage and approve or reject these requests. The system is designed with roles: **admin** and **employee**. Admins have access to view all leave requests, while employees can only view and manage their own leave requests.

## Features

### Employee:

-   Register as a new employee.
-   View and create leave requests.
-   Delete pending leave requests.
-   View leave request statuses (approved, pending, rejected).

### Admin:

-   View all leave requests from all employees.
-   Approve or reject leave requests.
-   Edit or delete any leave request.
-   Statistics display for approved, pending, and rejected leave requests.

## Technologies Used

-   **PHP** (Laravel framework)
-   **MySQL** (Database)
-   **Blade** (Frontend templating engine)
-   **Tailwind CSS** (Styling)
-   **Authentication** (Manual authentication for users)

## Installation

To get started, clone this repository to your local machine and follow the steps below.

### Prerequisites

Make sure you have the following installed:

-   PHP >= 7.4
-   Composer
-   MySQL or any other relational database
-   Node.js (for asset compilation)

### Steps

1. Clone the repository:

    ```bash
    git clone https://github.com/AliHashem20/leave-management-.git
    cd leave-management-system
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and update the environment variables (such as database credentials):

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Set up the database and run migrations:

    ```bash
    php artisan migrate --seed
    ```

    This will create the necessary tables and **seed the database with a default admin user**.

6. Run the development server:

    ```bash
    php artisan serve
    ```

    Visit `http://127.0.0.1:8000` in your browser to see the application.

## Usage

### Authentication

-   Admin credentials are added automatically via seeder.
-   Employees can register through the **Register** page.

### Views

#### Dashboard:

Admins can view a summary of all leave requests (approved, pending, rejected).

#### Leave Requests:

Employees can create, view, and edit their leave requests. Admins can view, approve, reject, or delete any leave request.

#### Request New Leave:

Employees can submit new leave requests, specifying the start date, end date, and reason for the leave.

## Roles and Permissions

### Admin Role:

-   Has access to view all leave requests, approve/reject them, and manage employees' leave requests.
-   Added automatically via database seeder.

### Employee Role:

-   Can register through the app.
-   Can view and manage their own leave requests.
-   Cannot delete requests that are already approved or rejected.
