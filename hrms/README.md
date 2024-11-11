<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


Introduction#

PHP installation
Start your PHP server (Windows)
PHP comes with its own basic web server, which can be used for development and testing. To start the server:
Open the Command Prompt then navigate to C:\www.
Run the following command: php -S localhost:8000 
You should see output like this:
C:\www> php -S localhost:8000
PHP 8.x Development Server started at $date, $time
Listening on http://localhost:8000
Document root is C:\www
Press Ctrl-C to quit.
Test your PHP server (Windows)
Point your web browser to http://localhost:8000/hello.php.
If your PHP server is working, a plain white page with “Hello World” at the top should appear. If not, follow the troubleshooting instructions on the PHP site.
Setup complete!


	Composer installation
Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

	Installation - Windows#
Using the Installer#
This is the easiest way to get Composer set up on your machine.

Download and run Composer-Setup.exe. It will install the latest Composer version and set up your PATH so that you can call composer from any directory in your command line.

	1.creating a laravel app using composer
composer create-project laravel/laravel hrms

	after creating app
cd hrms
 
	start the server to check if it works
php artisan serve


	2.Set Up MySQL Database
mysql -u root -p

mysql> SHOW DATABASES;

mysql> CREATE DATABASE hrms;

php artisan migrate   #to create relevant tables in db

php artisan serve     # to check if database is connected well

	3: Create Database Migrations e.g
php artisan make:migration create_employees_table --create=employees

	4: Run Migrations:
Run the migrations to create the tables in the database:
 
 php artisan migrate        
  
 php artisan migrate:fresh        
 
 
 migrate the seeders
 
 php artisan migrate:fresh --seed        
  
php artisan make:model Employee



	5: Set Up Models and Relationships
	
php artisan make:model Employee

		DB::table('books')->insert(['id' => 13999, 'name' => 'whatever']);
        DB::table('books')->where('id', 13999)->delete();

 show columns from users;




6: Set Up Authentication and Authorization
Use Laravel Breeze or Laravel Fortify:

composer require laravel/breeze --dev

php artisan breeze:install



 #install nvm
 https://github.com/coreybutler/nvm-windows
 
 
 
 nvm -v
 1.1.12
 
nvm install latest
nvm use 22.8.0

powershell(admin)
Set-ExecutionPolicy Unrestricted

 
npm -v
10.8.2
npm install
npm run build or
npm run dev to update changes live

php artisan migrate


7: Add Roles and Permissions:

Install spatie/laravel-permission package to manage roles and permissions:
bash
composer require spatie/laravel-permission


8: Next, publish the package's configuration and migration files:
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan migrate




SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect date value





SQLSTATE[42S22]: Column not found: 1054 Unknown column 'roles.user_id' in 'where clause'






                    <a href="{{ route('leaves.approve', $leaf->id) }}" class="btn btn-success">Approve</a>


        <a href="{{ route('leaves.pending') }}" class="btn btn-primary">Pending Leaves</a>





 $table->unsignedBigInteger('role_id')->nullable();


$table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');






php artisan migrate --path=/database/migrations/

 0001_01_01_000000_create_users_table ..................................................................................................... Pending
 0001_01_01_000001_create_cache_table ..................................................................................................... Pending
 0001_01_01_000002_create_jobs_table ...................................................................................................... Pending
 2024_09_04_094929_create_employees_table ................................................................................................. Pending
 2024_09_04_112344_create_salaries_table .................................................................................................. Pending
 2024_09_04_130525_create_leave_information_table ......................................................................................... Pending
 2024_09_05_090622_create_trainings_table ................................................................................................. Pending
 2024_09_05_091348_create_roles_table ..................................................................................................... Pending
 2024_09_05_091628_create_notifications_table ............................................................................................. Pending
 2024_09_05_092948_create_audit_logs_table ................................................................................................ Pending





No security vulnerability advisories found.
Using version ^2.2 for laravel/breeze
Using version ^6.9 for spatie/laravel-permission

2024_09_04_094929_create_employees_table.php


->constrained('roles')



corporate services
domestic tax
customs
internal audit
internal affairs
ict













php artisan make:controller LeaveApprovalController

