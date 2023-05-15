## Installation Laravel

- Run composer install
  ```bash
  $ composer install
  ```
- Copy the `.env.example` to `.env` file and update the file accordingly.
- Generate key
  ```bash
  $ php artisan key:generate
  ```
- Run the migration process

  ```bash
  $ php artisan migrate:fresh --seed
  ```

- Testing

  ```bash
  $ php artisan test
  ```

- Serve
  ```bash
  $ php artisan serve
  ```

## Installation React

- Open client

  ```bash
  $ cd client
  ```

- Install all dependencies
  ```bash
  $ npm install
  ```
- Run Application

  ```bash
  $ npm run dev
  ```
