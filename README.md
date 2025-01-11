
# API Documentation


## Authentication Endpoints

### User Signup
- **Endpoint**: `api/user/auth/signup`
- **Method**: `POST`
- **Description**: Registers a new user account.
- **Request Body**:
  ```json
  {
    "name": "string",
    "email": "string",
    "password": "string"
  }
  ```
- **Responses**:
  - **201 Created**:
    ```json
    {
      "status": "success",
      "message": "Account user created successfully"
    }
    ```
  - **400 Bad Request**:
    ```json
    {
      "status": "error",
      "message": "Validation errors",
      "errors": {
        "field_name": ["Error message"]
      }
    }
    ```

### User Signin
- **Endpoint**: `api/user/auth/signin`
- **Method**: `POST`
- **Description**: Authenticates a user and returns a token.
- **Request Body**:
  ```json
  {
    "email": "string",
    "password": "string"
  }
  ```
- **Responses**:
  - **200 OK**:
    ```json
    {
      "status": "success",
      "message": "Login successful",
      "token": "string"
    }
    ```
  - **401 Unauthorized**:
    ```json
    {
      "status": "error",
      "message": "Invalid email or password"
    }
    ```

### User Signout
- **Endpoint**: `api/user/auth/signout`
- **Method**: `GET`
- **Description**: Logs out the authenticated user.
- **Headers**:
  - `Authorization: Bearer {token}`
- **Responses**:
  - **200 OK**:
    ```json
    {
      "status": "success",
      "message": "Logout successful"
    }
    ```
  - **401 Unauthorized**:
    ```json
    {
      "status": "error",
      "message": "Token is required"
    }
    ```

### Get User Profile
- **Endpoint**: `api/user/profile`
- **Method**: `GET`
- **Description**: Retrieves the authenticated user's profile data.
- **Headers**:
  - `Authorization: Bearer {token}`
- **Responses**:
  - **200 OK**:
    ```json
    {
      "status": "success",
      "message": "User data retrieved successfully",
      "data": {
        "id": "integer",
        "name": "string",
        "email": "string",
        "role": "string",
        "created_at": "string (datetime)",
        "updated_at": "string (datetime)"
      }
    }
    ```
  - **401 Unauthorized**:
    ```json
    {
      "status": "error",
      "message": "Token is required"
    }
    ```
  - **401 Unauthorized**:
    ```json
    {
      "status": "error",
      "message": "Invalid token"
    }
    ```



# Volunteer API Specification

## Base URL
`/api/user/volunteerAPI`

---

### 1. Get All Volunteers
**Endpoint**: `GET /`

**Description**: Retrieve a list of all volunteers with optional limit.

**Query Parameters**:
- `limit` (optional): Limit the number of volunteers returned.

**Response**:
- **200 OK**:
```json
{
    "status": "success",
    "message": "Data volunteers retrieved successfully",
    "data": [
        {
            "id": 1,
            "title": "Volunteer Title",
            "description": "Volunteer Description",
            "category": "Category",
            "contact_phone": "1234567890",
            "contact_instagram": "@instagram",
            "registration_url": "http://example.com",
            "image_url": "http://example.com/image.png",
            "status": "Aktif",
            "created_at": "2023-01-01",
            "updated_at": "2023-01-02"
        }
    ]
}
```

---

### 2. Create a Volunteer
**Endpoint**: `POST /`

**Description**: Create a new volunteer.

**Request Body**:
- `title` (string, required): Title of the volunteer.
- `description` (string, required): Description of the volunteer.
- `category` (string, optional): Category of the volunteer.
- `contact_phone` (string, optional): Contact phone number.
- `contact_instagram` (string, optional): Instagram handle.
- `registration_url` (string, optional): Registration URL.
- `image_url` (file, optional): Image file for the volunteer.
- `status` (string, optional): Status of the volunteer (`Aktif` or `Non-Aktif`).

**Response**:
- **201 Created**:
```json
{
    "status": "success",
    "message": "Volunteer created successfully",
    "data": {
        "id": 1,
        "title": "Volunteer Title",
        "description": "Volunteer Description",
        "category": "Category",
        "contact_phone": "1234567890",
        "contact_instagram": "@instagram",
        "registration_url": "http://example.com",
        "image_url": "http://example.com/image.png",
        "status": "Aktif",
        "created_at": "2023-01-01",
        "updated_at": "2023-01-02"
    }
}
```

---

### 3. Get a Volunteer by ID
**Endpoint**: `GET /{id}`

**Description**: Retrieve details of a specific volunteer.

**Path Parameters**:
- `id` (integer, required): ID of the volunteer.

**Response**:
- **200 OK**:
```json
{
    "status": "success",
    "message": "Volunteer data retrieved successfully",
    "data": {
        "id": 1,
        "title": "Volunteer Title",
        "description": "Volunteer Description",
        "category": "Category",
        "contact_phone": "1234567890",
        "contact_instagram": "@instagram",
        "registration_url": "http://example.com",
        "image_url": "http://example.com/image.png",
        "status": "Aktif",
        "created_at": "2023-01-01",
        "updated_at": "2023-01-02"
    }
}
```
- **404 Not Found**:
```json
{
    "status": "error",
    "message": "Volunteer not found"
}
```

---

### 4. Update a Volunteer
**Endpoint**: `PUT /{id}`

**Description**: Update details of a specific volunteer.

**Path Parameters**:
- `id` (integer, required): ID of the volunteer.

**Request Body**:
- `title` (string, optional): Title of the volunteer.
- `description` (string, optional): Description of the volunteer.
- `category` (string, optional): Category of the volunteer.
- `contact_phone` (string, optional): Contact phone number.
- `contact_instagram` (string, optional): Instagram handle.
- `registration_url` (string, optional): Registration URL.
- `image_url` (file, optional): Image file for the volunteer.
- `status` (string, optional): Status of the volunteer (`Aktif` or `Non-Aktif`).

**Response**:
- **200 OK**:
```json
{
    "status": "success",
    "message": "Volunteer updated successfully",
    "data": {
        "id": 1,
        "title": "Updated Title",
        "description": "Updated Description",
        "category": "Updated Category",
        "contact_phone": "1234567890",
        "contact_instagram": "@instagram",
        "registration_url": "http://example.com",
        "image_url": "http://example.com/image.png",
        "status": "Non-Aktif",
        "created_at": "2023-01-01",
        "updated_at": "2023-01-02"
    }
}
```
- **404 Not Found**:
```json
{
    "status": "error",
    "message": "Volunteer not found"
}
```

---

### 5. Delete a Volunteer
**Endpoint**: `DELETE /{id}`

**Description**: Delete a specific volunteer.

**Path Parameters**:
- `id` (integer, required): ID of the volunteer.

**Response**:
- **200 OK**:
```json
{
    "status": "success",
    "message": "Volunteer deleted successfully"
}
```
- **404 Not Found**:
```json
{
    "status": "error",
    "message": "Volunteer not found"
}
```


# Donation API Specification

## Base URL
`/api/user/donationControllerAPI`

---

### 1. Get All Donations
**Endpoint**: `GET /`

**Description**: Retrieve a list of all donations with optional limit.

**Query Parameters**:
- `limit` (optional): Limit the number of donations returned.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Data donations retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Donation Title",
      "description": "Donation Description",
      "category": "Donation Category",
      "donation_url": "[invalid URL removed]",
      "web_url": "[http://example.com](http://example.com)",
      "registration_url": "[invalid URL removed]",
      "image_url": "[invalid URL removed]",
      "status": "Aktif",
      "created_at": "2023-01-01",
      "updated_at": "2023-01-02"
    }
  ]
}
```

---

### 2. Create a Donation
**Endpoint**: `POST /`

**Description**: Create a new donation.

**Request Body**:
- `title` (string, required): Title of the donation.
- `description` (string, required): Description of the donation.
- `category` (string, optional): Category of the donation.
- `donation_url` (string, optional): URL of the donation page.
- `web_url` (string, optional): URL of the donor's website.
- `registration_url` (string, optional): URL for donation registration.
- `image_url` (file, optional): Image file for the donation.
- `status` (string, optional): Status of the donation (`Aktif` or `Non-Aktif`).

**Response**:
- **201 Created**:
```json
{
  "status": "success",
  "message": "Donation created successfully",
  "data": {
    "id": 1,
    "title": "Donation Title",
    "description": "Donation Description",
    "category": "Donation Category",
    "donation_url": "[invalid URL removed]",
    "web_url": "[http://example.com](http://example.com)",
    "registration_url": "[invalid URL removed]",
    "image_url": "[invalid URL removed]",
    "status": "Aktif",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```

---

### 3. Get a Donation by ID
**Endpoint**: `GET /{id}`

**Description**: Retrieve details of a specific donation.

**Path Parameters**:
- `id` (integer, required): ID of the donation.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Donation data retrieved successfully",
  "data": {
    "id": 1,
    "title": "Donation Title",
    "description": "Donation Description",
    "category": "Donation Category",
    "donation_url": "[invalid URL removed]",
    "web_url": "[http://example.com](http://example.com)",
    "registration_url": "[invalid URL removed]",
    "image_url": "[invalid URL removed]",
    "status": "Aktif",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Donation not found"
}
```

---

### 4. Update a Donation
**Endpoint**: `PUT /{id}`

**Description**: Update details of a specific donation.

**Path Parameters**:
- `id` (integer, required): ID of the donation.

**Request Body**:
- `title` (string, optional): Title of the donation.
- `description` (string, optional): Description of the donation.
- `category` (string, optional): Category of the donation.
- `donation_url` (string, optional): URL of the donation page.
- `web_url` (string, optional): URL of the donor's website.
- `registration_url` (string, optional): URL for donation registration.
- `image_url` (file, optional): Image file for the donation.
- `status` (string, optional): Status of the donation (`Aktif` or `Non-Aktif`).

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Donation updated successfully",
  "data": {
    "id": 1,
    "title": "Updated Title",
    "description": "Updated Description",
    "category": "Updated Category",
    "donation_url": "[invalid URL removed]",
    "web_url": "[http://example.com](http://example.com)",
    "registration_url": "[invalid URL removed]",
    "image_url": "[invalid URL removed]",
    "status": "Non-Aktif",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Donation not found"
}
```

---

### 5. Delete a Donation
**Endpoint**: `DELETE /{id}`

**Description**: Delete a specific donation.

**Path Parameters**:
- `id` (integer, required): ID of the donation.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Donation deleted successfully"
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Donation not found"
}
```



# Testimonial API Specification

## Base URL
`/api/user/testimonialControllerAPI`

---

### 1. Get All Testimonials
**Endpoint**: `GET /`

**Description**: Retrieve a paginated list of testimonials.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Data testimonials retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "position": "CEO",
      "content": "This is a testimonial.",
      "photo_url": "[invalid URL removed]",
      "created_at": "2023-01-01",
      "updated_at": "2023-01-02"
    },
    // ... other testimonials
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 3,
    "total": 9,
    "next_page_url": "[invalid URL removed]",
    "prev_page_url": null 
  }
}
```

---

### 2. Create a Testimonial
**Endpoint**: `POST /`

**Description**: Create a new testimonial.

**Request Body**:
- `name` (string, optional): Name of the person giving the testimonial.
- `position` (string, optional): Position of the person giving the testimonial.
- `content` (string, optional): Content of the testimonial.
- `photo_url` (file, optional): Image file of the person giving the testimonial.

**Response**:
- **201 Created**:
```json
{
  "status": "success",
  "message": "Testimonial created successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "position": "CEO",
    "content": "This is a testimonial.",
    "photo_url": "[invalid URL removed]",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```

---

### 3. Get a Testimonial by ID
**Endpoint**: `GET /{id}`

**Description**: Retrieve details of a specific testimonial.

**Path Parameters**:
- `id` (integer, required): ID of the testimonial.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Testimonial data retrieved successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "position": "CEO",
    "content": "This is a testimonial.",
    "photo_url": "[invalid URL removed]",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Testimonial not found"
}
```

---

### 4. Update a Testimonial
**Endpoint**: `PUT /{id}`

**Description**: Update details of a specific testimonial.

**Path Parameters**:
- `id` (integer, required): ID of the testimonial.

**Request Body**:
- `name` (string, optional): Name of the person giving the testimonial.
- `position` (string, optional): Position of the person giving the testimonial.
- `content` (string, optional): Content of the testimonial.
- `photo_url` (file, optional): Image file of the person giving the testimonial.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Testimonial updated successfully",
  "data": {
    "id": 1,
    "name": "Updated Name",
    "position": "Updated Position",
    "content": "Updated Testimonial",
    "photo_url": "[invalid URL removed]",
    "created_at": "2023-01-01",
    "updated_at": "2023-01-02"
  }
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Testimonial not found"
}
```

---

### 5. Delete a Testimonial
**Endpoint**: `DELETE /{id}`

**Description**: Delete a specific testimonial.

**Path Parameters**:
- `id` (integer, required): ID of the testimonial.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Testimonial deleted successfully"
}
```
- **404 Not Found**:
```json
{
  "status": "error",
  "message": "Testimonial not found"
}
```



# Program Search API Specification

## Base URL
`/api/user/programControllerAPI/search`

---

### 1. Search Programs

**Endpoint**: `POST`

**Description**: Search for programs (volunteers and donations) based on a keyword.

**Request Body**:
- `keyword` (string, required): Keyword to search for in program titles, descriptions, and categories.

**Response**:
- **200 OK**:
```json
{
  "status": "success",
  "message": "Search completed successfully",
  "data": [
    // Array of search results, combining volunteers and donations
    {
      "id": 1, 
      "title": "Volunteer Title 1", 
      "description": "Volunteer Description 1", 
      "category": "Volunteer Category 1", 
      // ... other volunteer fields
    },
    {
      "id": 2, 
      "title": "Donation Title 1", 
      "description": "Donation Description 1", 
      "category": "Donation Category 1", 
      // ... other donation fields
    },
    // ... more search results
  ]
}
```

**Note:**
- The `data` array will contain a mix of `Volunteer` and `Donation` objects. 
- The specific fields within each object will depend on the corresponding model. 
- Consider adding a field to distinguish between volunteer and donation objects in the search results (e.g., `type` with values "volunteer" or "donation").

**Example Request:**

```json
{
  "keyword": "education"
}
```

**Example Response:**

```json
{
  "status": "success",
  "message": "Search completed successfully",
  "data": [
    {
      "id": 1, 
      "title": "Volunteer in Schools", 
      "description": "Volunteer to teach children in underprivileged schools.", 
      "category": "Education", 
      // ... other volunteer fields
    },
    {
      "id": 2, 
      "title": "Education Fund", 
      "description": "Donate to support education programs.", 
      "category": "Education", 
      // ... other donation fields
    }
  ]
}
```

## Getting Started

### Prerequisites
- PHP >= 8.0
- Laravel Framework
- MySQL Database

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/your-project.git
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database and environment configurations.

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

### Testing
- Use Postman or similar tools to test API endpoints.

---

## Contribution
1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-branch-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature description"
   ```
4. Push to your branch:
   ```bash
   git push origin feature-branch-name
   ```
5. Open a pull request.

---

## License
This project is licensed under the [ALOPE WORLD](LICENSE) and developed by [Dikri Fauzan Amrulloh](https://github.com/dikrifzn).