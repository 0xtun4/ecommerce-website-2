//package com.tuna.Model;
//
//import jakarta.persistence.*;
//
//@Entity
//public class Product {
//    @Id
//    private String id; // Trường ID kiểu String
//
//    @Column(nullable = false, unique = true, length = 100)
//    private String productName;
//
//    @Column(length = 100)
//    private String productType;
//
//    @Column(length = 100)
//    private String productBrand;
//
//    @Column(length = 1000)
//    private String productDescription;
//
//    private String productImageUrl;
//
//    private int productPrice; // Added productPrice field
//
//    public Product() {
//    }
//
//    public Product(String id, String productName, String productType, String productBrand, String productDescription, String productImageUrl, int productPrice) {
//        this.id = id;
//        this.productName = productName;
//        this.productType = productType;
//        this.productBrand = productBrand;
//        this.productDescription = productDescription;
//        this.productImageUrl = productImageUrl;
//        this.productPrice = productPrice; // Initialize productPrice
//    }
//
//    // Getter and setter methods for all fields (generated automatically or write them manually)
//
//    public String getId() {
//        return id;
//    }
//
//    public void setId(String id) {
//        this.id = id;
//    }
//
//    public String getProductName() {
//        return productName;
//    }
//
//    public void setProductName(String productName) {
//        this.productName = productName;
//    }
//
//    public String getProductType() {
//        return productType;
//    }
//
//    public void setProductType(String productType) {
//        this.productType = productType;
//    }
//
//    public String getProductBrand() {
//        return productBrand;
//    }
//
//    public void setProductBrand(String productBrand) {
//        this.productBrand = productBrand;
//    }
//
//    public String getProductDescription() {
//        return productDescription;
//    }
//
//    public void setProductDescription(String productDescription) {
//        this.productDescription = productDescription;
//    }
//
//    public String getProductImageUrl() {
//        return productImageUrl;
//    }
//
//    public void setProductImageUrl(String productImageUrl) {
//        this.productImageUrl = productImageUrl;
//    }
//
//    public int getProductPrice() {
//        return productPrice;
//    }
//
//    public void setProductPrice(int productPrice) {
//        this.productPrice = productPrice;
//    }
//}
