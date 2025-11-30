# idlerVPS

idlerVPS is a Laravel-based application designed to manage and monitor VPS services. Built with [FilamentPHP](https://filamentphp.com/), it provides a robust administration panel for managing domains, servers, and other resources.

![Dashboard Screenshot](public/screenshot/hompage.png)

## Features

*   **Service Management**: Manage Domains, Servers, Shared Hosting, and Miscellaneous services.
*   **Expiration Monitoring**: Automatically checks for expired services and sends notifications.
*   **Notification Channels**: Supports notifications via Discord, Telegram, and Email (configured via settings).
*   **Filament Admin Panel**: Clean and intuitive interface for management.

## Requirements

*   PHP 8.2+
*   Composer
*   Database (MySQL, MariaDB, or SQLite)

## Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/AchmadBudy/idler-vps.git
    cd idler-vps
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Environment Setup**
    Copy the example environment file and configure your database credentials:
    ```bash
    cp .env.example .env
    ```
    Update the `.env` file with your database settings (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Create Admin User**
    Since this uses Filament, you'll need a user to access the panel:
    ```bash
    php artisan make:filament-user
    ```

## Deployment & Automation

This project uses a standard Laravel deployment process.

### Automated Checks (Cron)

The application includes a custom command `check-expired` that checks for expired services and sends notifications. This command is designed to run once every 24 hours.

Since there is no complex queue or scheduler setup, you simply need to add a single cron entry on your server:

```bash
# Run check-expired command every day at midnight (00:00)
0 0 * * * cd /path/to/idler-vps && php artisan check-expired >> /dev/null 2>&1
```

Replace `/path/to/idler-vps` with the actual path to your project on the server.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
