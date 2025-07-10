# API-webnode

This project is a REST API for order management built with Symfony, Doctrine, and MySQL. It provides basic CRUD for orders and their items, supports fixtures, and automated tests.

---

## Requirements

-   Docker and Docker Compose
-   (optional) Make, Adminer

---

## How to Run the Project

1. **Clone the repository:**

    ```sh
    git clone <repo-url>
    cd API-webnode
    ```

2. **Prepare environment variables:**

    - Copy the contents of `.env.delete` into a new file named `.env`:
        ```sh
        cp .env.delete .env
        ```
    - Open `.env` and fill in the required values (database credentials, secrets, etc.).

3. **Start Docker containers:**

    ```sh
    docker compose up -d
    ```

4. **Install dependencies:**

    ```sh
    docker compose exec php composer install
    ```

5. **Create the database and schema:**

    ```sh
    docker compose exec php php bin/console doctrine:migrations:migrate
    ```

6. **(Optional) Load fixtures (sample data):**

    ```sh
    docker compose exec php php bin/console doctrine:fixtures:load
    ```

7. **Open Adminer for DB management:**  
   [http://localhost:8080](http://localhost:8080)  
   Credentials can be found in your `.env` file (`MYSQL_USER`, `MYSQL_PASSWORD`, DB: `symfony`).

8. **The API is available at:**  
   [http://localhost:8000/api/orders](http://localhost:8000/api/orders)

---

## Testing

1. **Create the test database (only once):**

    ```sh
    docker compose exec db mysql -u root -p
    # In MySQL:
    CREATE DATABASE symfony_test;
    GRANT ALL PRIVILEGES ON symfony_test.* TO 'symfony'@'%';
    FLUSH PRIVILEGES;
    EXIT;
    ```

2. **Create the schema in the test DB:**

    ```sh
    docker compose exec php php bin/console doctrine:migrations:migrate --env=test
    ```

3. **(Optional) Load fixtures into the test DB:**

    ```sh
    docker compose exec php php bin/console doctrine:fixtures:load --env=test
    ```

4. **Run tests:**
    ```sh
    docker compose exec php php bin/phpunit
    ```

---

## API Example

-   **GET /api/orders/{id}**  
    Returns order details including items.

---

## Tips

-   If you change `.env` or `.env.test`, restart the containers:
    ```sh
    docker compose down
    docker compose up -d
    ```
-   Use Postman or curl to test the API.

---

## Project Structure

-   `src/Entity` – Doctrine entities
-   `src/Controller/Api` – API controllers
-   `src/Application/Order` – Order service logic
-   `src/DataFixtures` – Fixtures for sample data
-   `tests/` – Automated tests

---

## Conclusion

-   Time requirement: Due to the necessity of working to complete the project I was hired to do, I was able to devote about two hours to the project, for which reason I used the symfony framework and its extensions to quickly complete the API endpoint and write its test
-   Assignment: The assignment was understandable and clear, and not at all challenging, I don't think I have anything to criticize.

---
