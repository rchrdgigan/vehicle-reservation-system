# vehicle-reservation-system

## Installation

Before you use the Vehicle Reservation System make sure that you install it in your computer.

-   First open your git bash and clone this reporsitory

```bash
git clone https://github.com/rchrdgigan/vehicle-reservation-system.git
```

-   Second change your working directory

```bash
cd bgy-management
```

-   Third install the laravel dependencies and libraries required

```bash
composer install
```

-   Fourth copy the environment file and change the values according to your development environment

```bash
cp .env.example .env
```

-   And to generate laravel key

```bash
php artisan key:generate
```

-   To migrate and seed the database
    > Note! make it sure that you have already created a database before doing this and configure or assign it to your .env file

```bash
php artisan migrate --seed
```

-   Create the symbolic links configured for the application

```bash
php artisan storage:link
```
