<p align="center"><a href="[https://laravel.com](https://www.istqb.org/)" target="_blank"><img src="https://scontent-cgk2-1.xx.fbcdn.net/v/t39.30808-6/326706255_739381017343512_9052986784671981328_n.png?_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_ohc=IL80xXjF5VsQ7kNvgFZkboR&_nc_ht=scontent-cgk2-1.xx&oh=00_AfBySi9lLWp2N8q2COQoEGZqKfLBwYRZwThFK1tsiUqDzg&oe=66423FF9" width="400"></a></p>


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

### Setting Up ISTQBright App

Follow these steps to set up application:

1. **Install Dependencies:**
   ```bash
   composer install
2. **Setup Env File:**
   ```bash
   cp .env.example .env
3. **Create SQL Database:**
   
   Ensure you have a SQL database set up. Update the .env file with your database credentials.

5. **Run Migrations::**
   ```
   php artisan migrate
6. **Seed Database (Optional):**
   ```bash
   php artisan db:seed
7. **enerate Application Key:**
   ```bash
   php artisan key:generate
8. **Start the Development Server:**
   ```bash
   php artisan serve
