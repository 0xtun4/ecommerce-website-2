# Kế Hoạch Chuyển Đổi Sang C# và React.js

## 📋 Mục Lục
1. [Tổng Quan](#1-tổng-quan)
2. [Kiến Trúc Hệ Thống Mới](#2-kiến-trúc-hệ-thống-mới)
3. [Cấu Trúc Thư Mục](#3-cấu-trúc-thư-mục)
4. [Backend - ASP.NET Core](#4-backend---aspnet-core)
5. [Frontend - React.js](#5-frontend---reactjs)
6. [Database Migration](#6-database-migration)
7. [API Endpoints](#7-api-endpoints)
8. [Các Bước Thực Hiện](#8-các-bước-thực-hiện)
9. [Nguyên Tắc SOLID & KISS](#9-nguyên-tắc-solid--kiss)
10. [Code Mẫu](#10-code-mẫu)

---

## 1. Tổng Quan

### 1.1 Hiện Trạng
- **Frontend hiện tại**: React Native (Mobile App)
- **Backend hiện tại**: Node.js + Express + MongoDB / PHP + MySQL
- **Database**: MongoDB (backend) + MySQL (web)

### 1.2 Mục Tiêu
- **Frontend mới**: React.js (Web Application)
- **Backend mới**: ASP.NET Core 8.0 (C#)
- **Database**: SQL Server hoặc PostgreSQL
- **Chia tách rõ ràng**: Frontend và Backend là 2 dự án độc lập

### 1.3 Lợi Ích
- ✅ Dễ bảo trì và mở rộng
- ✅ Type-safe với C# và TypeScript
- ✅ Hiệu suất cao với .NET Core
- ✅ Cộng đồng lớn, nhiều tài liệu
- ✅ Phù hợp cho người mới học

---

## 2. Kiến Trúc Hệ Thống Mới

```
┌─────────────────────────────────────────────────────────────┐
│                      NGƯỜI DÙNG                              │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                   FRONTEND (React.js)                        │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  Components  │  Pages  │  Services  │  Redux Store   │   │
│  └──────────────────────────────────────────────────────┘   │
│                    Port: 3000                                │
└───────────────────────────┬─────────────────────────────────┘
                            │ HTTP/REST API (JSON)
                            ▼
┌─────────────────────────────────────────────────────────────┐
│              BACKEND (ASP.NET Core Web API)                  │
│  ┌──────────────────────────────────────────────────────┐   │
│  │ Controllers │ Services │ Repositories │ DTOs │ Models │  │
│  └──────────────────────────────────────────────────────┘   │
│                    Port: 5000                                │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                  DATABASE (SQL Server)                       │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  Users  │  Products  │  Categories  │  Orders        │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
```

---

## 3. Cấu Trúc Thư Mục

### 3.1 Backend (C# ASP.NET Core)

```
ecommerce-backend/
├── ECommerce.API/                    # Web API Project
│   ├── Controllers/                  # Xử lý HTTP requests
│   │   ├── ProductsController.cs
│   │   ├── CategoriesController.cs
│   │   ├── UsersController.cs
│   │   └── OrdersController.cs
│   ├── DTOs/                         # Data Transfer Objects
│   │   ├── ProductDto.cs
│   │   ├── CategoryDto.cs
│   │   ├── UserDto.cs
│   │   └── OrderDto.cs
│   ├── Middleware/                   # Xử lý trung gian
│   │   └── ErrorHandlingMiddleware.cs
│   ├── Program.cs                    # Entry point
│   ├── appsettings.json              # Cấu hình
│   └── ECommerce.API.csproj
│
├── ECommerce.Core/                   # Business Logic Layer
│   ├── Entities/                     # Domain Models
│   │   ├── Product.cs
│   │   ├── Category.cs
│   │   ├── User.cs
│   │   └── Order.cs
│   ├── Interfaces/                   # Abstractions
│   │   ├── IProductService.cs
│   │   ├── ICategoryService.cs
│   │   ├── IUserService.cs
│   │   └── IOrderService.cs
│   └── ECommerce.Core.csproj
│
├── ECommerce.Services/               # Service Layer
│   ├── ProductService.cs
│   ├── CategoryService.cs
│   ├── UserService.cs
│   └── OrderService.cs
│
├── ECommerce.Infrastructure/         # Data Access Layer
│   ├── Data/
│   │   └── AppDbContext.cs           # EF Core DbContext
│   ├── Repositories/
│   │   ├── ProductRepository.cs
│   │   ├── CategoryRepository.cs
│   │   ├── UserRepository.cs
│   │   └── OrderRepository.cs
│   └── ECommerce.Infrastructure.csproj
│
└── ECommerce.sln                     # Solution file
```

### 3.2 Frontend (React.js)

```
ecommerce-frontend/
├── public/
│   ├── index.html
│   └── favicon.ico
│
├── src/
│   ├── components/                   # Reusable UI Components
│   │   ├── common/                   # Shared components
│   │   │   ├── Button.jsx
│   │   │   ├── Input.jsx
│   │   │   ├── Card.jsx
│   │   │   └── Loading.jsx
│   │   ├── layout/                   # Layout components
│   │   │   ├── Header.jsx
│   │   │   ├── Footer.jsx
│   │   │   └── Sidebar.jsx
│   │   └── product/                  # Product components
│   │       ├── ProductCard.jsx
│   │       └── ProductList.jsx
│   │
│   ├── pages/                        # Page components
│   │   ├── Home.jsx
│   │   ├── ProductDetail.jsx
│   │   ├── Cart.jsx
│   │   ├── Checkout.jsx
│   │   ├── Login.jsx
│   │   └── Register.jsx
│   │
│   ├── services/                     # API calls
│   │   ├── api.js                    # Axios instance
│   │   ├── productService.js
│   │   ├── categoryService.js
│   │   ├── userService.js
│   │   └── orderService.js
│   │
│   ├── store/                        # Redux state management
│   │   ├── index.js
│   │   ├── slices/
│   │   │   ├── productSlice.js
│   │   │   ├── cartSlice.js
│   │   │   └── userSlice.js
│   │   └── hooks.js
│   │
│   ├── hooks/                        # Custom React hooks
│   │   ├── useProducts.js
│   │   └── useAuth.js
│   │
│   ├── utils/                        # Helper functions
│   │   ├── formatCurrency.js
│   │   └── validation.js
│   │
│   ├── styles/                       # CSS/SCSS files
│   │   ├── global.css
│   │   └── variables.css
│   │
│   ├── App.jsx
│   ├── index.js
│   └── routes.js
│
├── package.json
└── README.md
```

---

## 4. Backend - ASP.NET Core

### 4.1 Cài Đặt Ban Đầu

```bash
# Tạo solution
dotnet new sln -n ECommerce

# Tạo các projects
dotnet new webapi -n ECommerce.API
dotnet new classlib -n ECommerce.Core
dotnet new classlib -n ECommerce.Services
dotnet new classlib -n ECommerce.Infrastructure

# Thêm projects vào solution
dotnet sln add ECommerce.API
dotnet sln add ECommerce.Core
dotnet sln add ECommerce.Services
dotnet sln add ECommerce.Infrastructure

# Thêm references
dotnet add ECommerce.API reference ECommerce.Core
dotnet add ECommerce.API reference ECommerce.Services
dotnet add ECommerce.API reference ECommerce.Infrastructure
dotnet add ECommerce.Services reference ECommerce.Core
dotnet add ECommerce.Infrastructure reference ECommerce.Core
```

### 4.2 Packages Cần Thiết

```bash
# ECommerce.API
dotnet add package Microsoft.AspNetCore.Authentication.JwtBearer
dotnet add package AutoMapper.Extensions.Microsoft.DependencyInjection

# ECommerce.Infrastructure
dotnet add package Microsoft.EntityFrameworkCore
dotnet add package Microsoft.EntityFrameworkCore.SqlServer
dotnet add package Microsoft.EntityFrameworkCore.Tools
```

---

## 5. Frontend - React.js

### 5.1 Cài Đặt Ban Đầu

```bash
# Tạo project React với Vite (nhanh hơn CRA)
npm create vite@latest ecommerce-frontend -- --template react

# Di chuyển vào thư mục
cd ecommerce-frontend

# Cài đặt dependencies
npm install

# Cài đặt thêm các packages cần thiết
npm install axios react-router-dom @reduxjs/toolkit react-redux
npm install react-hook-form yup @hookform/resolvers
npm install react-icons react-toastify
```

### 5.2 Packages Chính

| Package | Mô tả |
|---------|-------|
| axios | Gọi API |
| react-router-dom | Routing |
| @reduxjs/toolkit | State management |
| react-hook-form | Form handling |
| react-toastify | Notifications |

---

## 6. Database Migration

### 6.1 Mapping Từ MySQL Sang SQL Server

| MySQL Table | SQL Server Table | Entity (C#) |
|-------------|------------------|-------------|
| tbl_sanpham | Products | Product |
| tbl_danhmuc | Categories | Category |
| tbl_dangky | Users | User |
| tbl_giohang | Carts | Cart |
| tbl_cart_detail | CartItems | CartItem |
| tbl_admin | Admins | (merged into Users) |
| tbl_shipping | ShippingAddresses | ShippingAddress |

### 6.2 Script Migration

```sql
-- Tạo database mới
CREATE DATABASE ECommerceDB;
GO

USE ECommerceDB;
GO

-- Bảng Categories
CREATE TABLE Categories (
    Id INT PRIMARY KEY IDENTITY(1,1),
    Name NVARCHAR(100) NOT NULL,
    DisplayOrder INT NOT NULL DEFAULT 0,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    UpdatedAt DATETIME2 DEFAULT GETDATE()
);

-- Bảng Products
CREATE TABLE Products (
    Id INT PRIMARY KEY IDENTITY(1,1),
    Name NVARCHAR(200) NOT NULL,
    Code NVARCHAR(50) NOT NULL,
    Description NVARCHAR(MAX),
    Price DECIMAL(18,2) NOT NULL,
    Quantity INT NOT NULL DEFAULT 0,
    ImageUrl NVARCHAR(500),
    CategoryId INT NOT NULL,
    IsActive BIT DEFAULT 1,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    UpdatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (CategoryId) REFERENCES Categories(Id)
);

-- Bảng Users
CREATE TABLE Users (
    Id INT PRIMARY KEY IDENTITY(1,1),
    FullName NVARCHAR(200) NOT NULL,
    Username NVARCHAR(100) NOT NULL UNIQUE,
    Email NVARCHAR(100) NOT NULL UNIQUE,
    PasswordHash NVARCHAR(500) NOT NULL,
    Phone NVARCHAR(20),
    Address NVARCHAR(500),
    Role NVARCHAR(20) DEFAULT 'Customer',
    IsActive BIT DEFAULT 1,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    UpdatedAt DATETIME2 DEFAULT GETDATE()
);

-- Bảng Orders
CREATE TABLE Orders (
    Id INT PRIMARY KEY IDENTITY(1,1),
    UserId INT NOT NULL,
    TotalAmount DECIMAL(18,2) NOT NULL,
    Status NVARCHAR(50) DEFAULT 'Pending',
    PaymentMethod NVARCHAR(50),
    ShippingAddress NVARCHAR(500),
    Note NVARCHAR(500),
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    UpdatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (UserId) REFERENCES Users(Id)
);

-- Bảng OrderItems
CREATE TABLE OrderItems (
    Id INT PRIMARY KEY IDENTITY(1,1),
    OrderId INT NOT NULL,
    ProductId INT NOT NULL,
    Quantity INT NOT NULL,
    UnitPrice DECIMAL(18,2) NOT NULL,
    FOREIGN KEY (OrderId) REFERENCES Orders(Id),
    FOREIGN KEY (ProductId) REFERENCES Products(Id)
);
```

---

## 7. API Endpoints

### 7.1 Products API

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| GET | /api/products | Lấy danh sách sản phẩm |
| GET | /api/products/{id} | Lấy chi tiết sản phẩm |
| GET | /api/products/category/{categoryId} | Lấy sản phẩm theo danh mục |
| POST | /api/products | Tạo sản phẩm mới |
| PUT | /api/products/{id} | Cập nhật sản phẩm |
| DELETE | /api/products/{id} | Xóa sản phẩm |

### 7.2 Categories API

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| GET | /api/categories | Lấy danh sách danh mục |
| GET | /api/categories/{id} | Lấy chi tiết danh mục |
| POST | /api/categories | Tạo danh mục mới |
| PUT | /api/categories/{id} | Cập nhật danh mục |
| DELETE | /api/categories/{id} | Xóa danh mục |

### 7.3 Users API

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | /api/auth/register | Đăng ký |
| POST | /api/auth/login | Đăng nhập |
| GET | /api/users/profile | Lấy thông tin user |
| PUT | /api/users/profile | Cập nhật thông tin |

### 7.4 Orders API

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| GET | /api/orders | Lấy danh sách đơn hàng |
| GET | /api/orders/{id} | Lấy chi tiết đơn hàng |
| POST | /api/orders | Tạo đơn hàng mới |
| PUT | /api/orders/{id}/status | Cập nhật trạng thái |

---

## 8. Các Bước Thực Hiện

### Giai Đoạn 1: Chuẩn Bị (1-2 tuần)

- [ ] **1.1** Thiết lập môi trường phát triển
  - Cài đặt .NET 8 SDK
  - Cài đặt Node.js 18+
  - Cài đặt SQL Server (hoặc PostgreSQL)
  - Cài đặt Visual Studio Code / Visual Studio

- [ ] **1.2** Tạo cấu trúc project
  - Tạo solution .NET
  - Tạo React project
  - Cấu hình Git repositories

### Giai Đoạn 2: Backend Core (2-3 tuần)

- [ ] **2.1** Tạo Entity Models
- [ ] **2.2** Cấu hình Entity Framework Core
- [ ] **2.3** Tạo Repositories
- [ ] **2.4** Tạo Services
- [ ] **2.5** Tạo Controllers
- [ ] **2.6** Cấu hình Authentication (JWT)
- [ ] **2.7** Viết Unit Tests

### Giai Đoạn 3: Database (1 tuần)

- [ ] **3.1** Tạo database schema mới
- [ ] **3.2** Viết script migrate dữ liệu từ MySQL
- [ ] **3.3** Kiểm tra dữ liệu

### Giai Đoạn 4: Frontend Core (2-3 tuần)

- [ ] **4.1** Tạo cấu trúc project React
- [ ] **4.2** Tạo các components cơ bản
- [ ] **4.3** Cấu hình Redux store
- [ ] **4.4** Tạo services gọi API
- [ ] **4.5** Tạo các pages chính
- [ ] **4.6** Tạo routing

### Giai Đoạn 5: Tích Hợp (1-2 tuần)

- [ ] **5.1** Kết nối Frontend với Backend
- [ ] **5.2** Xử lý CORS
- [ ] **5.3** Testing end-to-end
- [ ] **5.4** Sửa lỗi

### Giai Đoạn 6: Hoàn Thiện (1-2 tuần)

- [ ] **6.1** Tối ưu performance
- [ ] **6.2** Viết documentation
- [ ] **6.3** Deploy thử nghiệm
- [ ] **6.4** Bàn giao

---

## 9. Nguyên Tắc SOLID & KISS

### 9.1 SOLID Principles

#### S - Single Responsibility (Đơn trách nhiệm)
> Mỗi class chỉ làm một việc duy nhất

```csharp
// ❌ SAI - Một class làm quá nhiều việc
public class ProductManager
{
    public void CreateProduct() { }
    public void SendEmail() { }
    public void LogActivity() { }
}

// ✅ ĐÚNG - Mỗi class một nhiệm vụ
public class ProductService
{
    public void CreateProduct() { }
}

public class EmailService
{
    public void SendEmail() { }
}

public class LogService
{
    public void LogActivity() { }
}
```

#### O - Open/Closed (Mở cho mở rộng, đóng cho sửa đổi)
> Mở rộng bằng cách thêm code mới, không sửa code cũ

```csharp
// ✅ ĐÚNG - Sử dụng interface để mở rộng
public interface IPaymentMethod
{
    void ProcessPayment(decimal amount);
}

public class CashPayment : IPaymentMethod
{
    public void ProcessPayment(decimal amount) 
    { 
        // Xử lý thanh toán tiền mặt
    }
}

public class CardPayment : IPaymentMethod
{
    public void ProcessPayment(decimal amount) 
    { 
        // Xử lý thanh toán thẻ
    }
}

// Muốn thêm phương thức thanh toán mới? 
// Chỉ cần tạo class mới, không sửa code cũ
public class MomoPayment : IPaymentMethod
{
    public void ProcessPayment(decimal amount) 
    { 
        // Xử lý thanh toán Momo
    }
}
```

#### L - Liskov Substitution (Thay thế Liskov)
> Class con có thể thay thế class cha mà không làm hỏng chương trình

#### I - Interface Segregation (Phân tách Interface)
> Chia nhỏ interface, không ép class implement những method không cần

```csharp
// ❌ SAI - Interface quá lớn
public interface IWorker
{
    void Work();
    void Eat();
    void Sleep();
}

// ✅ ĐÚNG - Chia nhỏ interface
public interface IWorkable
{
    void Work();
}

public interface IEatable
{
    void Eat();
}
```

#### D - Dependency Inversion (Đảo ngược phụ thuộc)
> Phụ thuộc vào abstraction (interface), không phụ thuộc vào implementation

```csharp
// ❌ SAI - Phụ thuộc trực tiếp vào class cụ thể
public class ProductController
{
    private ProductService _service = new ProductService();
}

// ✅ ĐÚNG - Phụ thuộc vào interface
public class ProductController
{
    private readonly IProductService _service;
    
    public ProductController(IProductService service)
    {
        _service = service;
    }
}
```

### 9.2 KISS Principle (Keep It Simple, Stupid)

> Giữ code đơn giản, dễ hiểu

```csharp
// ❌ SAI - Code phức tạp không cần thiết
public bool IsEligibleForDiscount(Customer customer)
{
    return customer != null 
        && customer.IsActive == true 
        && customer.Orders != null 
        && customer.Orders.Count() > 0 
        && customer.Orders.Sum(o => o.Total) >= 1000000 
        ? true 
        : false;
}

// ✅ ĐÚNG - Code đơn giản, dễ đọc
public bool IsEligibleForDiscount(Customer customer)
{
    // Kiểm tra khách hàng hợp lệ
    if (customer == null || !customer.IsActive)
        return false;
    
    // Tính tổng tiền đã mua
    var totalSpent = customer.Orders?.Sum(o => o.Total) ?? 0;
    
    // Giảm giá cho khách hàng chi tiêu trên 1 triệu
    decimal minimumSpent = 1_000_000;
    return totalSpent >= minimumSpent;
}
```

---

## 10. Code Mẫu

### 10.1 Backend - Entity Model

```csharp
// File: ECommerce.Core/Entities/Product.cs

namespace ECommerce.Core.Entities;

/// <summary>
/// Entity đại diện cho sản phẩm trong hệ thống
/// </summary>
public class Product
{
    /// <summary>
    /// ID của sản phẩm (tự động tăng)
    /// </summary>
    public int Id { get; set; }

    /// <summary>
    /// Tên sản phẩm
    /// </summary>
    public string Name { get; set; } = string.Empty;

    /// <summary>
    /// Mã sản phẩm (ví dụ: SP001)
    /// </summary>
    public string Code { get; set; } = string.Empty;

    /// <summary>
    /// Mô tả chi tiết sản phẩm
    /// </summary>
    public string? Description { get; set; }

    /// <summary>
    /// Giá sản phẩm
    /// </summary>
    public decimal Price { get; set; }

    /// <summary>
    /// Số lượng trong kho
    /// </summary>
    public int Quantity { get; set; }

    /// <summary>
    /// Đường dẫn hình ảnh
    /// </summary>
    public string? ImageUrl { get; set; }

    /// <summary>
    /// ID của danh mục
    /// </summary>
    public int CategoryId { get; set; }

    /// <summary>
    /// Danh mục sản phẩm (navigation property)
    /// </summary>
    public Category? Category { get; set; }

    /// <summary>
    /// Trạng thái hoạt động
    /// </summary>
    public bool IsActive { get; set; } = true;

    /// <summary>
    /// Ngày tạo
    /// </summary>
    public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

    /// <summary>
    /// Ngày cập nhật
    /// </summary>
    public DateTime UpdatedAt { get; set; } = DateTime.UtcNow;
}
```

### 10.2 Backend - Interface Service

```csharp
// File: ECommerce.Core/Interfaces/IProductService.cs

namespace ECommerce.Core.Interfaces;

/// <summary>
/// Interface định nghĩa các phương thức xử lý sản phẩm
/// </summary>
public interface IProductService
{
    /// <summary>
    /// Lấy tất cả sản phẩm
    /// </summary>
    Task<IEnumerable<Product>> GetAllAsync();

    /// <summary>
    /// Lấy sản phẩm theo ID
    /// </summary>
    Task<Product?> GetByIdAsync(int id);

    /// <summary>
    /// Lấy sản phẩm theo danh mục
    /// </summary>
    Task<IEnumerable<Product>> GetByCategoryAsync(int categoryId);

    /// <summary>
    /// Tạo sản phẩm mới
    /// </summary>
    Task<Product> CreateAsync(Product product);

    /// <summary>
    /// Cập nhật sản phẩm
    /// </summary>
    Task<Product?> UpdateAsync(int id, Product product);

    /// <summary>
    /// Xóa sản phẩm
    /// </summary>
    Task<bool> DeleteAsync(int id);
}
```

### 10.2.1 Backend - Repository Interface

```csharp
// File: ECommerce.Core/Interfaces/IProductRepository.cs

namespace ECommerce.Core.Interfaces;

/// <summary>
/// Interface định nghĩa các phương thức truy cập dữ liệu sản phẩm
/// Repository pattern giúp tách biệt logic truy cập data khỏi business logic
/// </summary>
public interface IProductRepository
{
    /// <summary>
    /// Lấy tất cả sản phẩm từ database
    /// </summary>
    Task<IEnumerable<Product>> GetAllAsync();

    /// <summary>
    /// Lấy sản phẩm theo ID
    /// </summary>
    Task<Product?> GetByIdAsync(int id);

    /// <summary>
    /// Lấy sản phẩm theo danh mục
    /// </summary>
    Task<IEnumerable<Product>> GetByCategoryAsync(int categoryId);

    /// <summary>
    /// Thêm sản phẩm mới vào database
    /// </summary>
    Task<Product> CreateAsync(Product product);

    /// <summary>
    /// Cập nhật thông tin sản phẩm
    /// </summary>
    Task<Product> UpdateAsync(Product product);

    /// <summary>
    /// Xóa sản phẩm khỏi database
    /// </summary>
    Task<bool> DeleteAsync(int id);
}
```

### 10.3 Backend - Service Implementation

```csharp
// File: ECommerce.Services/ProductService.cs

using ECommerce.Core.Entities;
using ECommerce.Core.Interfaces;

namespace ECommerce.Services;

/// <summary>
/// Service xử lý logic nghiệp vụ cho sản phẩm
/// </summary>
public class ProductService : IProductService
{
    // Repository để truy cập database
    private readonly IProductRepository _repository;

    /// <summary>
    /// Constructor - Inject repository thông qua Dependency Injection
    /// </summary>
    public ProductService(IProductRepository repository)
    {
        _repository = repository;
    }

    /// <summary>
    /// Lấy tất cả sản phẩm đang hoạt động
    /// </summary>
    public async Task<IEnumerable<Product>> GetAllAsync()
    {
        // Gọi repository để lấy dữ liệu
        var products = await _repository.GetAllAsync();
        
        // Chỉ trả về sản phẩm đang hoạt động
        return products.Where(p => p.IsActive);
    }

    /// <summary>
    /// Lấy sản phẩm theo ID
    /// </summary>
    public async Task<Product?> GetByIdAsync(int id)
    {
        // Kiểm tra ID hợp lệ
        if (id <= 0)
        {
            return null;
        }

        return await _repository.GetByIdAsync(id);
    }

    /// <summary>
    /// Lấy sản phẩm theo danh mục
    /// </summary>
    public async Task<IEnumerable<Product>> GetByCategoryAsync(int categoryId)
    {
        // Kiểm tra categoryId hợp lệ
        if (categoryId <= 0)
        {
            return Enumerable.Empty<Product>();
        }

        return await _repository.GetByCategoryAsync(categoryId);
    }

    /// <summary>
    /// Tạo sản phẩm mới
    /// </summary>
    public async Task<Product> CreateAsync(Product product)
    {
        // Đặt thời gian tạo
        product.CreatedAt = DateTime.UtcNow;
        product.UpdatedAt = DateTime.UtcNow;
        product.IsActive = true;

        return await _repository.CreateAsync(product);
    }

    /// <summary>
    /// Cập nhật sản phẩm
    /// </summary>
    public async Task<Product?> UpdateAsync(int id, Product product)
    {
        // Tìm sản phẩm cần cập nhật
        var existingProduct = await _repository.GetByIdAsync(id);
        
        if (existingProduct == null)
        {
            return null;
        }

        // Cập nhật các trường
        existingProduct.Name = product.Name;
        existingProduct.Code = product.Code;
        existingProduct.Description = product.Description;
        existingProduct.Price = product.Price;
        existingProduct.Quantity = product.Quantity;
        existingProduct.ImageUrl = product.ImageUrl;
        existingProduct.CategoryId = product.CategoryId;
        existingProduct.UpdatedAt = DateTime.UtcNow;

        return await _repository.UpdateAsync(existingProduct);
    }

    /// <summary>
    /// Xóa sản phẩm (soft delete)
    /// </summary>
    public async Task<bool> DeleteAsync(int id)
    {
        var product = await _repository.GetByIdAsync(id);
        
        if (product == null)
        {
            return false;
        }

        // Soft delete: đánh dấu không hoạt động thay vì xóa thật
        product.IsActive = false;
        product.UpdatedAt = DateTime.UtcNow;
        
        await _repository.UpdateAsync(product);
        return true;
    }
}
```

### 10.4 Backend - Controller

```csharp
// File: ECommerce.API/Controllers/ProductsController.cs

using Microsoft.AspNetCore.Mvc;
using ECommerce.Core.Interfaces;
using ECommerce.API.DTOs;

namespace ECommerce.API.Controllers;

/// <summary>
/// Controller xử lý các API liên quan đến sản phẩm
/// </summary>
[ApiController]
[Route("api/[controller]")]
public class ProductsController : ControllerBase
{
    private readonly IProductService _productService;

    /// <summary>
    /// Constructor
    /// </summary>
    public ProductsController(IProductService productService)
    {
        _productService = productService;
    }

    /// <summary>
    /// Lấy danh sách tất cả sản phẩm
    /// GET: api/products
    /// </summary>
    [HttpGet]
    public async Task<ActionResult<IEnumerable<ProductDto>>> GetAll()
    {
        var products = await _productService.GetAllAsync();
        
        // Chuyển đổi Entity sang DTO
        var productDtos = products.Select(p => new ProductDto
        {
            Id = p.Id,
            Name = p.Name,
            Code = p.Code,
            Description = p.Description,
            Price = p.Price,
            Quantity = p.Quantity,
            ImageUrl = p.ImageUrl,
            CategoryId = p.CategoryId,
            CategoryName = p.Category?.Name
        });

        return Ok(productDtos);
    }

    /// <summary>
    /// Lấy chi tiết một sản phẩm
    /// GET: api/products/5
    /// </summary>
    [HttpGet("{id}")]
    public async Task<ActionResult<ProductDto>> GetById(int id)
    {
        var product = await _productService.GetByIdAsync(id);

        if (product == null)
        {
            return NotFound(new { message = "Không tìm thấy sản phẩm" });
        }

        var productDto = new ProductDto
        {
            Id = product.Id,
            Name = product.Name,
            Code = product.Code,
            Description = product.Description,
            Price = product.Price,
            Quantity = product.Quantity,
            ImageUrl = product.ImageUrl,
            CategoryId = product.CategoryId,
            CategoryName = product.Category?.Name
        };

        return Ok(productDto);
    }

    /// <summary>
    /// Tạo sản phẩm mới
    /// POST: api/products
    /// </summary>
    [HttpPost]
    public async Task<ActionResult<ProductDto>> Create([FromBody] CreateProductDto createDto)
    {
        // Validate input - kiểm tra các trường bắt buộc
        var validationErrors = new List<string>();

        if (string.IsNullOrWhiteSpace(createDto.Name))
        {
            validationErrors.Add("Tên sản phẩm không được để trống");
        }

        if (string.IsNullOrWhiteSpace(createDto.Code))
        {
            validationErrors.Add("Mã sản phẩm không được để trống");
        }

        if (createDto.Price < 0)
        {
            validationErrors.Add("Giá sản phẩm không được âm");
        }

        if (createDto.CategoryId <= 0)
        {
            validationErrors.Add("Danh mục không hợp lệ");
        }

        if (validationErrors.Count > 0)
        {
            return BadRequest(new { 
                message = "Dữ liệu không hợp lệ", 
                errors = validationErrors 
            });
        }

        // Tạo entity từ DTO
        var product = new Product
        {
            Name = createDto.Name,
            Code = createDto.Code,
            Description = createDto.Description,
            Price = createDto.Price,
            Quantity = createDto.Quantity,
            ImageUrl = createDto.ImageUrl,
            CategoryId = createDto.CategoryId
        };

        var createdProduct = await _productService.CreateAsync(product);

        // Trả về 201 Created với location header
        return CreatedAtAction(
            nameof(GetById), 
            new { id = createdProduct.Id }, 
            createdProduct);
    }

    /// <summary>
    /// Cập nhật sản phẩm
    /// PUT: api/products/5
    /// </summary>
    [HttpPut("{id}")]
    public async Task<ActionResult<ProductDto>> Update(int id, [FromBody] UpdateProductDto updateDto)
    {
        var product = new Product
        {
            Name = updateDto.Name,
            Code = updateDto.Code,
            Description = updateDto.Description,
            Price = updateDto.Price,
            Quantity = updateDto.Quantity,
            ImageUrl = updateDto.ImageUrl,
            CategoryId = updateDto.CategoryId
        };

        var updatedProduct = await _productService.UpdateAsync(id, product);

        if (updatedProduct == null)
        {
            return NotFound(new { message = "Không tìm thấy sản phẩm" });
        }

        return Ok(updatedProduct);
    }

    /// <summary>
    /// Xóa sản phẩm
    /// DELETE: api/products/5
    /// </summary>
    [HttpDelete("{id}")]
    public async Task<ActionResult> Delete(int id)
    {
        var result = await _productService.DeleteAsync(id);

        if (!result)
        {
            return NotFound(new { message = "Không tìm thấy sản phẩm" });
        }

        return NoContent();
    }
}
```

### 10.5 Frontend - Product Service

```javascript
// File: src/services/productService.js

import api from './api';

/**
 * Service xử lý các API calls liên quan đến sản phẩm
 */
const productService = {
  /**
   * Lấy tất cả sản phẩm
   * @returns {Promise<Array>} Danh sách sản phẩm
   */
  getAll: async () => {
    try {
      const response = await api.get('/products');
      return response.data;
    } catch (error) {
      console.error('Lỗi khi lấy danh sách sản phẩm:', error);
      throw error;
    }
  },

  /**
   * Lấy sản phẩm theo ID
   * @param {number} id - ID của sản phẩm
   * @returns {Promise<Object>} Chi tiết sản phẩm
   */
  getById: async (id) => {
    try {
      const response = await api.get(`/products/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Lỗi khi lấy sản phẩm ID ${id}:`, error);
      throw error;
    }
  },

  /**
   * Lấy sản phẩm theo danh mục
   * @param {number} categoryId - ID của danh mục
   * @returns {Promise<Array>} Danh sách sản phẩm
   */
  getByCategory: async (categoryId) => {
    try {
      const response = await api.get(`/products/category/${categoryId}`);
      return response.data;
    } catch (error) {
      console.error(`Lỗi khi lấy sản phẩm danh mục ${categoryId}:`, error);
      throw error;
    }
  },

  /**
   * Tạo sản phẩm mới
   * @param {Object} productData - Dữ liệu sản phẩm
   * @returns {Promise<Object>} Sản phẩm đã tạo
   */
  create: async (productData) => {
    try {
      const response = await api.post('/products', productData);
      return response.data;
    } catch (error) {
      console.error('Lỗi khi tạo sản phẩm:', error);
      throw error;
    }
  },

  /**
   * Cập nhật sản phẩm
   * @param {number} id - ID của sản phẩm
   * @param {Object} productData - Dữ liệu cập nhật
   * @returns {Promise<Object>} Sản phẩm đã cập nhật
   */
  update: async (id, productData) => {
    try {
      const response = await api.put(`/products/${id}`, productData);
      return response.data;
    } catch (error) {
      console.error(`Lỗi khi cập nhật sản phẩm ${id}:`, error);
      throw error;
    }
  },

  /**
   * Xóa sản phẩm
   * @param {number} id - ID của sản phẩm
   * @returns {Promise<void>}
   */
  delete: async (id) => {
    try {
      await api.delete(`/products/${id}`);
    } catch (error) {
      console.error(`Lỗi khi xóa sản phẩm ${id}:`, error);
      throw error;
    }
  },
};

export default productService;
```

### 10.6 Frontend - Product Card Component

```jsx
// File: src/components/product/ProductCard.jsx

import React from 'react';
import { formatCurrency } from '../../utils/formatCurrency';

/**
 * Component hiển thị thông tin sản phẩm dạng card
 * 
 * @param {Object} props
 * @param {Object} props.product - Thông tin sản phẩm
 * @param {Function} props.onAddToCart - Callback khi thêm vào giỏ
 * @param {Function} props.onViewDetail - Callback khi xem chi tiết
 */
function ProductCard({ product, onAddToCart, onViewDetail }) {
  // Xử lý khi click nút "Thêm vào giỏ"
  const handleAddToCart = () => {
    if (onAddToCart) {
      onAddToCart(product);
    }
  };

  // Xử lý khi click xem chi tiết
  const handleViewDetail = () => {
    if (onViewDetail) {
      onViewDetail(product.id);
    }
  };

  return (
    <div className="product-card">
      {/* Hình ảnh sản phẩm */}
      <div className="product-card__image" onClick={handleViewDetail}>
        <img 
          src={product.imageUrl || '/images/placeholder.png'} 
          alt={product.name}
        />
      </div>

      {/* Thông tin sản phẩm */}
      <div className="product-card__info">
        {/* Tên sản phẩm */}
        <h3 
          className="product-card__name" 
          onClick={handleViewDetail}
        >
          {product.name}
        </h3>

        {/* Danh mục */}
        <p className="product-card__category">
          {product.categoryName}
        </p>

        {/* Giá */}
        <p className="product-card__price">
          {formatCurrency(product.price)}
        </p>
      </div>

      {/* Nút hành động */}
      <div className="product-card__actions">
        <button 
          className="btn btn-primary"
          onClick={handleAddToCart}
          disabled={product.quantity <= 0}
        >
          {product.quantity > 0 ? 'Thêm vào giỏ' : 'Hết hàng'}
        </button>
      </div>
    </div>
  );
}

export default ProductCard;
```

### 10.7 Frontend - Product List Page

```jsx
// File: src/pages/Products.jsx

import React, { useState, useEffect } from 'react';
import ProductCard from '../components/product/ProductCard';
import Loading from '../components/common/Loading';
import productService from '../services/productService';
import { useDispatch } from 'react-redux';
import { addToCart } from '../store/slices/cartSlice';
import { useNavigate } from 'react-router-dom';
import { toast } from 'react-toastify';

/**
 * Trang hiển thị danh sách sản phẩm
 */
function Products() {
  // State lưu danh sách sản phẩm
  const [products, setProducts] = useState([]);
  
  // State loading
  const [loading, setLoading] = useState(true);
  
  // State lỗi
  const [error, setError] = useState(null);

  // Hooks
  const dispatch = useDispatch();
  const navigate = useNavigate();

  // Lấy danh sách sản phẩm khi component mount
  useEffect(() => {
    fetchProducts();
  }, []);

  /**
   * Hàm lấy danh sách sản phẩm từ API
   */
  const fetchProducts = async () => {
    try {
      setLoading(true);
      setError(null);
      
      const data = await productService.getAll();
      setProducts(data);
    } catch (err) {
      setError('Không thể tải danh sách sản phẩm. Vui lòng thử lại.');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  /**
   * Xử lý thêm sản phẩm vào giỏ hàng
   */
  const handleAddToCart = (product) => {
    dispatch(addToCart({
      id: product.id,
      name: product.name,
      price: product.price,
      imageUrl: product.imageUrl,
      quantity: 1
    }));
    
    toast.success('Đã thêm vào giỏ hàng!');
  };

  /**
   * Xử lý xem chi tiết sản phẩm
   */
  const handleViewDetail = (productId) => {
    navigate(`/products/${productId}`);
  };

  // Hiển thị loading
  if (loading) {
    return <Loading message="Đang tải sản phẩm..." />;
  }

  // Hiển thị lỗi
  if (error) {
    return (
      <div className="error-container">
        <p className="error-message">{error}</p>
        <button onClick={fetchProducts}>Thử lại</button>
      </div>
    );
  }

  // Hiển thị danh sách sản phẩm
  return (
    <div className="products-page">
      <h1>Sản Phẩm</h1>
      
      {products.length === 0 ? (
        <p>Không có sản phẩm nào.</p>
      ) : (
        <div className="products-grid">
          {products.map((product) => (
            <ProductCard
              key={product.id}
              product={product}
              onAddToCart={handleAddToCart}
              onViewDetail={handleViewDetail}
            />
          ))}
        </div>
      )}
    </div>
  );
}

export default Products;
```

### 10.8 Frontend - Redux Cart Slice

```javascript
// File: src/store/slices/cartSlice.js

import { createSlice } from '@reduxjs/toolkit';

/**
 * Initial state cho giỏ hàng
 */
const initialState = {
  items: [],      // Danh sách sản phẩm trong giỏ
  totalItems: 0,  // Tổng số lượng sản phẩm
  totalPrice: 0,  // Tổng tiền
};

/**
 * Redux slice quản lý giỏ hàng
 */
const cartSlice = createSlice({
  name: 'cart',
  initialState,
  reducers: {
    /**
     * Thêm sản phẩm vào giỏ
     */
    addToCart: (state, action) => {
      const newItem = action.payload;
      
      // Tìm xem sản phẩm đã có trong giỏ chưa
      const existingItem = state.items.find(item => item.id === newItem.id);
      
      if (existingItem) {
        // Nếu có rồi, tăng số lượng
        existingItem.quantity += newItem.quantity || 1;
      } else {
        // Nếu chưa có, thêm mới
        state.items.push({
          ...newItem,
          quantity: newItem.quantity || 1
        });
      }
      
      // Cập nhật tổng
      updateTotals(state);
    },

    /**
     * Xóa sản phẩm khỏi giỏ
     */
    removeFromCart: (state, action) => {
      const productId = action.payload;
      state.items = state.items.filter(item => item.id !== productId);
      updateTotals(state);
    },

    /**
     * Cập nhật số lượng sản phẩm
     */
    updateQuantity: (state, action) => {
      const { productId, quantity } = action.payload;
      const item = state.items.find(item => item.id === productId);
      
      if (item) {
        item.quantity = quantity;
        
        // Nếu số lượng = 0, xóa khỏi giỏ
        if (quantity <= 0) {
          state.items = state.items.filter(item => item.id !== productId);
        }
      }
      
      updateTotals(state);
    },

    /**
     * Xóa toàn bộ giỏ hàng
     */
    clearCart: (state) => {
      state.items = [];
      state.totalItems = 0;
      state.totalPrice = 0;
    },
  },
});

/**
 * Hàm helper để cập nhật tổng số lượng và tổng tiền
 */
function updateTotals(state) {
  state.totalItems = state.items.reduce(
    (total, item) => total + item.quantity, 
    0
  );
  
  state.totalPrice = state.items.reduce(
    (total, item) => total + (item.price * item.quantity), 
    0
  );
}

// Export actions
export const { 
  addToCart, 
  removeFromCart, 
  updateQuantity, 
  clearCart 
} = cartSlice.actions;

// Export reducer
export default cartSlice.reducer;
```

### 10.9 Frontend - Utility Function

```javascript
// File: src/utils/formatCurrency.js

/**
 * Format số tiền sang định dạng tiền Việt Nam
 * 
 * @param {number} amount - Số tiền cần format
 * @returns {string} Chuỗi đã format (ví dụ: 1.000.000đ)
 * 
 * @example
 * formatCurrency(1000000) // "1.000.000đ"
 * formatCurrency(0)       // "0đ"
 * formatCurrency(null)    // "0đ"
 */
export function formatCurrency(amount) {
  // Xử lý trường hợp null hoặc undefined
  if (amount == null) {
    return '0đ';
  }

  // Chuyển sang số
  const number = Number(amount);

  // Kiểm tra số hợp lệ
  if (isNaN(number)) {
    return '0đ';
  }

  // Format với dấu chấm ngăn cách hàng nghìn
  const formatted = number.toLocaleString('vi-VN');

  // Thêm ký hiệu tiền tệ
  return `${formatted}đ`;
}

/**
 * Parse chuỗi tiền tệ thành số
 * 
 * @param {string} currencyString - Chuỗi tiền tệ
 * @returns {number} Số tiền (luôn dương cho giá cả sản phẩm)
 * 
 * @example
 * parseCurrency("1.000.000đ") // 1000000
 * parseCurrency("-500.000đ")  // 500000 (giá không âm)
 */
export function parseCurrency(currencyString) {
  if (!currencyString) {
    return 0;
  }

  // Loại bỏ tất cả ký tự không phải số
  // Lưu ý: Giá sản phẩm luôn dương nên ta bỏ qua dấu âm
  const cleanString = currencyString.replace(/[^\d]/g, '');
  
  // Parse thành số, trả về 0 nếu không hợp lệ
  const result = parseInt(cleanString, 10);
  
  return isNaN(result) ? 0 : result;
}
```

---

## 📚 Tài Liệu Tham Khảo

### Backend (C#/.NET)
- [Microsoft Learn - ASP.NET Core](https://learn.microsoft.com/en-us/aspnet/core/)
- [Entity Framework Core Documentation](https://learn.microsoft.com/en-us/ef/core/)

### Frontend (React.js)
- [React Official Documentation](https://react.dev/)
- [Redux Toolkit Guide](https://redux-toolkit.js.org/)
- [React Router v6](https://reactrouter.com/)

### Database
- [SQL Server Documentation](https://learn.microsoft.com/en-us/sql/)

---

## 📞 Liên Hệ

Nếu có thắc mắc hoặc cần hỗ trợ, vui lòng tạo Issue trên GitHub repository.

---

*Tài liệu được cập nhật lần cuối: Tháng 11/2024*
