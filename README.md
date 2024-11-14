# BeautyQueue API

BeautyQueue is a backend API designed to facilitate a salon booking system similar to Uber, providing users with a seamless experience to book services at various salons. This API supports functionality for users, salons, and stylists, handling appointment scheduling, user profiles, salon listings, and other essential features.

## Tech Stack
- **PHP Version:** 8.1.10
- **Node Version:** 19.8.1
- **Laravel Version:** 10.48.12

This project serves as the backend API only and is designed to connect with various frontend frameworks via RESTful endpoints.

## Features
- **User Management:** Registration, authentication, and profile management for customers and salon staff.
- **Salon Listings:** Allows salons to list their services and availability.
- **Booking System:** Enables users to book and manage appointments.
- **Notifications and Reminders:** Sends notifications to users about upcoming appointments.
- **Ratings and Reviews:** Allows users to rate and review their salon experiences.

## Installation

### Prerequisites
Ensure that the following are installed on your system:
- PHP 8.1.10
- Node.js 19.8.1
- Composer (latest version)
- MySQL (or your preferred database)

### Setup

1. **Clone the Repository**
   Clone the project repository to your local machine and navigate into the project directory:
   ```bash
   git clone https://github.com/Jody-Heid/beautyqueue.git
   cd beautyqueue
2. **Install Dependencies**
   Install the project dependencies using Composer:
   ```bash
   composer install
3. **Setup Laravel**
   Run the following command to set up the Laravel project:
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
4. **Start the Server**
   Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   The server will be running at http://localhost:8000. You can now access the API endpoints using a tool like Postman or cURL.
