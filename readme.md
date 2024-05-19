### FlexStation Admin Invitation System

#### Description
This project is aimed at creating an admin invitation system for FlexStation, a platform built with Laravel version 10. The system utilizes Laravel Livewire for interactive UI components and integrates basic API functionalities.

#### Requirements
- PHP >= 8.1.17
- Composer
- Laravel 10
- Laravel Livewire

#### Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/NafMn/backend-flextation.git
    ```
2. Navigate to the project directory:
    ```bash
    cd flexstation-admin-invitation
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration and other necessary settings.
5. Generate an application key:
    ```bash
    php artisan key:generate
    ```
6. Run migrations:
    ```bash
    php artisan migrate
    ```
7. Start the development server:
    ```bash
    php artisan serve
    ```

#### Usage
- Access the admin invitation system via the browser at `http://localhost:8000`.
- Admin users can invite new users by filling out the invitation form.
- Invited users will receive an email with an invitation link.
- Users can accept the invitation by clicking on the invitation link and completing the registration process.

#### API Endpoints
- **POST /api/invite**: Endpoint to create a new invitation.
    - Parameters:
        - `email` (string): Email address of the user to be invited.
    - Response: JSON object with the invitation details.

#### Configuration
- **Database**: Update the `.env` file with the appropriate database credentials.
- **Mail**: Configure the mail settings in the `.env` file for sending invitation emails.
- **API**: Additional API routes and functionalities can be added in the `routes/api.php` file.

#### Contributing
Contributions are welcome! Please fork the repository and create a pull request for any improvements or additional features.

#### License
This project is licensed under the [MIT License](LICENSE).

#### Credits
- Laravel: [https://laravel.com](https://laravel.com)
- Livewire: [https://laravel-livewire.com](https://laravel-livewire.com)

#### Author
[NafMn-GitNaf] - [nafis@nafisdvlp.my.id]

#### Acknowledgements
Special thanks to the Laravel and Livewire communities for their support and contributions.
