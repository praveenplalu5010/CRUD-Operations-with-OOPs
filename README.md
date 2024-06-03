# PHP Developer Technical Assignment Created by Praveen Prabhakaran

## Setup Instructions

1. Clone the repository:

    - git clone https://github.com/praveenplalu5010/PHP-Assignment.git
    - cd project

2. Import the database:
    - Create a MySQL database named `kelsius_db`.
    - Import the `kelsius_db.sql` file to create necessary tables. File is inside the root directory

3. Configure database connection:
    - Update the `classes/classDatabase.php` file with your database credentials.

4. Run the application:
    - Open the `index.php` file in your browser. Make sure you are running the project on a server. 



## Features

- User registration with password hashing.
- User login and session management.
- Profile page with update functionality.
- CRUD operations for managing items.
- Reviews for items.
- API endpoint for data retrieval.
- Admin role to manage users.
- Basic security measures including input sanitization.
- Basic CSS for styling and responsive design.
- Unit testing for database operations.

## Security and Validation

- Passwords are hashed using `password_hash`.
- User inputs are sanitized using `filter_var` and prepared statements.
- Basic validation is implemented in the form handling blocks.


## Using the API with Postman

To access the API endpoints using Postman, follow these steps:

1. Open Postman and create a new request.
2. Set the request type to `GET`.
3. Enter the API endpoint URL, e.g., `http://yourdomain.com/apis/list-blogs.php`.
4. Add the authentication token as a query parameter:
   - Key: `api_token`
   - Value: `[Your API Token]`
   - Some Valid API Tokens = "2K47aEsmX2dNqL0oPheWpZ7bC31V4fTl", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo"
5. Send the request to retrieve JSON data.

