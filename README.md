# QCM Sprint DEV

This project is an interactive web application developed for the **Sprint DEV** course. It allows users to participate in multiple-choice quizzes (QCMs), track their statistics, and includes advanced features for administrators.

## Main Features

### For Users:
- Secure registration and login.
- Participation in quizzes with score calculation.
- History of past results displayed in a table format.
- Average score calculation.

### For Administrators:
- Search results by username.
- View the complete history of results.

## Technologies Used
- **Backend**: PHP (with PDO for database interaction).
- **Database**: MySQL (tables for users, results, and questions).
- **Frontend**: HTML5, CSS3, JavaScript.
- **Dark Mode**: Supports dark mode via `prefers-color-scheme`.

## Installation

### Prerequisites
- Web server supporting PHP (e.g., XAMPP, WAMP, MAMP).
- MySQL database.

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/qcm-sprintdev.git
   ```
2. Place the folder in your web server's root directory.
3. Import the SQL file into your database:
   - The `database/qcm.sql` file contains the structure and initial data.
   - Use phpMyAdmin or a similar tool to import it.
4. Configure the database connection in the `includes/db.php` file:
   ```php
   $host = 'localhost';
   $dbname = 'qcm';
   $username = 'root';
   $password = '';
   ```
   Adjust these values based on your setup.

5. Access the application via your browser:
   - Default URL: `http://localhost/qcm-sprintdev/`

## Project Structure
```
qcm-sprintdev/
│
├── css/
│   └── style.css        # Stylesheet (light and dark mode included)
├── database/
│   └── qcm.sql          # SQL file for structure and initial data
├── includes/
│   └── db.php           # Database connection script
├── js/
│   └── script.js        # JavaScript scripts (if applicable)
├── views/
│   ├── home.php         # Dashboard after login
│   ├── quiz.php         # Page for taking quizzes
│   ├── results.php      # Results of the current quiz
│   ├── my_results.php   # User's personal results (average and history)
│   ├── admin.php        # Admin dashboard
│   ├── login.php        # Login page
│   └── register.php     # Registration page
├── index.php            # Redirects to the dashboard
└── README.md            # Project documentation (EN)
```

## Upcoming Features
- Enhanced statistics with interactive charts.
- Ability for admins to add/modify questions.

## Authors
- **Lukas Mauffré** - Lead Developer.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🌍 Languages
- [🇫🇷 Version française du README](README_FR.md)