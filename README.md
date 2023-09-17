# API Documentation

This document provides an overview of the endpoints and functionality of the Tuna Online Store API.

## Product Endpoints

| Endpoint                     | Method | Description                     |
| ---------------------------- | ------ | ---------------------------------|
| `/api/Product/getAllProducts`| GET    | Get all products.               |
| `/api/Product/{id}`          | GET    | Get a product by ID.           |
| `/api/Product/searchProducts` | GET    | Search for products by keyword. |
 
### Parameters

- `ascending` (optional): A boolean parameter to specify sorting order for product listing (`true` for ascending, `false` for descending).
- `keyword` (required for search): A keyword to search for products by name.

## Member Endpoints

| Endpoint                      | Method | Description                   |
| ------------------------------ | ------ | -------------------------------|
| `/api/public/add`              | POST   | Add a new member.             |
| `/api/public/update/{id}`      | PUT    | Update a member by ID.       |
| `/api/public/delete/{id}`      | DELETE | Delete a member by ID.       |
| `/api/public/login`            | POST   | Member login.                 |

### Request Body

- `/api/public/add`:  for adding a new member.
- `/api/public/update/{id}`:  for updating an existing member.
- `/api/public/login`:  for member login.

## Authentication

Authentication is required for some endpoints. Provide a valid JWT token in the `Authorization` header to access protected resources.

### Sample Usage

#### Get all products (sorted by name):

```http
GET /api/Product/getAllProducts?ascending=true
