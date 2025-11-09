

## Contributing

Thank you for considering contributing to the# TSW Project Management System

A comprehensive project management system built with Laravel, designed to help teams manage projects, customers, and employees efficiently.

## 🚀 Features

- **User Authentication**
  - Secure login/logout functionality
  - Protected routes for authenticated users

- **Dashboard**
  - Overview of key metrics and activities
  - Quick access to important functions

- **Employee Management**
  - Add, edit, and remove employees
  - View employee list

- **Customer Management**
  - Add, edit, and remove customers
  - Search functionality for customers
  - Customer details management

- **Project Management**
  - Create and manage projects
  - Track project status
  - Assign projects to team members

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x
- **Frontend**: 
  - HTML5, CSS3
  - JavaScript (ES6+)
  - Tailwind CSS 4.0
- **Database**: MySQL
- **Build Tool**: Vite
- **PHP**: 8.2+

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone [your-repository-url]
   cd tsw-project-management
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   - Copy `.env.example` to `.env`
   - Generate application key:
     ```bash
     php artisan key:generate
     ```
   - Configure your database settings in `.env`

5. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # If you have seeders
   ```

6. **Compile Assets**
   ```bash
   npm run build
   # or for development:
   # npm run dev
   ```

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```

8. **Access the Application**
   - Open `http://localhost:8000` in your browser
   - Login with your credentials

## 🔒 Authentication
- Default login route: `/login`
- Protected routes require authentication
- Logout functionality available

## 📂 Project Structure

```
tsw-project-management/
├── app/                # Application code
├── config/             # Configuration files
├── database/           # Database migrations and seeders
├── public/             # Publicly accessible files
├── resources/          # Views and uncompiled assets
├── routes/             # Application routes
├── storage/            # Storage directory
└── tests/              # Test files
```

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

Built with ❤️ by TSW Team

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
