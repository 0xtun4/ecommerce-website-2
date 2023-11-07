# API Documentation

This document provides an overview of the endpoints and functionality of the Tuna Online Store API.

## Product Endpoints

| Endpoint                     | Method | Description                     |
| ---------------------------- | ------ |---------------------------------|
| `/api/Product/getAllProducts`| GET    | Get all products.               |
| `/api/Product/{id}`          | GET    | Get a product by ID.            |
| `/api/Product/searchProducts` | GET    | Search for products by keyword. |
| `/api/Product/getAllCategory` | GET    | Get all category.               |

 
### Parameters

- `ascending` (optional): A boolean parameter to specify sorting order for product listing (`true` for ascending, `false` for descending).
- `keyword` (required for search): A keyword to search for products by name.
## Member Endpoints

| Endpoint                      | Method | Description            |
| ------------------------------ | ------ |------------------------|
| `/api/public/register`         | POST   | Add a new member.      |
| `/api/public/update/{id}`      | PUT    | Update a member by ID. |
| `/api/public/delete/{id}`      | DELETE | Delete a member by ID. |
| `/api/public/login`            | POST   | Member login.          |
| `/api/public/changePassword/{id}`            | POST   | Change password by ID. |

### Request Body

- `/api/public/register`:  for register a new member.
- `/api/public/update/{id}`:  for updating an existing member.
- `/api/public/login`:  for member login.

## Authentication

Authentication is required for some endpoints. Provide a valid JWT token in the `Authorization` header to access protected resources.

### Some Sample Usage
#### Get all products (sorted by name):

```http
GET http:localhost:/api/Product/getAllProducts?ascending=true
```
### Response

```javascript
[
  {
    "product_id": 1,
    "product_name": "Tuna",
    "product_price": 10,
    "product_description": "Tuna is a saltwater fish that belongs to the tribe Thunnini, a subgrouping of the Scombridae family. The Thunnini comprise 15 species across five genera, the sizes of which vary greatly, ranging from the bullet tuna up to the Atlantic bluefin tuna.",
    "product_image": example.jpg,
    "product_category": "Fish",
    "product_quantity": 100
  }
]
```

#### Resister a new member:

```http
POST http:localhost:/api/public/register
```
### Request Body

```javascript
[
{
  "member_name": "John",
  "email": "john@tuna.com",
  "password": "123456"
}
]
```
### Login:

```http
POST http:localhost:/api/public/login
```
### Request Body

```javascript
[
{
  "email": "john@tuna.com",
  "password": "123456"
}
]
```
### Response

```javascript
[
{
  success: true,
}
]
```