package com.tuna.Models;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity(name = "Product")
@Table(name = "SP", schema = "cuahang")
public class Product {
    @Id
    @Column(name = "MA_SP", length = 45)
    private String id;
    @Column(name = "TEN_SP", length = 255)
    private String productName;
    @Column(name = "MA_LOAISP", length = 255)
    private String productType;
    @Column(name = "MA_HANGSX", length = 255)
    private String productBrand;
    @Column(name = "MIEUTA_SP", length = 255)
    private String productDescription;
    @Column(name = "HINHANH_SP", length = 255)
    private String productImage;
    @Column(name = "GIA", length = 255)
    private int productPrice;

    public Product() {
    }

    public Product(String id, String productName, String productType, String productBrand, String productDescription, String productImage, int productPrice) {
        this.id = id;
        this.productName = productName;
        this.productType = productType;
        this.productBrand = productBrand;
        this.productDescription = productDescription;
        this.productImage = productImage;
        this.productPrice = productPrice;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getProductName() {
        return productName;
    }

    public void setProductName(String productName) {
        this.productName = productName;
    }

    public String getProductType() {
        return productType;
    }

    public void setProductType(String productType) {
        this.productType = productType;
    }

    public String getProductBrand() {
        return productBrand;
    }

    public void setProductBrand(String productBrand) {
        this.productBrand = productBrand;
    }

    public String getProductDescription() {
        return productDescription;
    }

    public void setProductDescription(String productDescription) {
        this.productDescription = productDescription;
    }

    public String getProductImage() {
        return productImage;
    }

    public void setProductImage(String productImage) {
        this.productImage = productImage;
    }

    public int getProductPrice() {
        return productPrice;
    }

    public void setProductPrice(int productPrice) {
        this.productPrice = productPrice;
    }

    @Override
    public String toString() {
        return "Product{" +
                "id='" + id + '\'' +
                ", productName='" + productName + '\'' +
                ", productType='" + productType + '\'' +
                ", productBrand='" + productBrand + '\'' +
                ", productDescription='" + productDescription + '\'' +
                ", productImage='" + productImage + '\'' +
                ", productPrice=" + productPrice +
                '}';
    }
}