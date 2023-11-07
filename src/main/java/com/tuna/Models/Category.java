package com.tuna.Models;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity(name = "Category")
@Table(name = "LOAISP", schema = "cuahang")
public class Category {
    @Id
    @Column(name = "MA_LOAISP", length = 45)
    private String id;
    @Column(name = "TEN_LOAISP", length = 255)
    private String typeName;

    public Category() {
    }

    public Category(String id, String typeName) {
        this.id = id;
        this.typeName = typeName;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getTypeName() {
        return typeName;
    }

    public void setTypeName(String typeName) {
        this.typeName = typeName;
    }

    @Override
    public String toString() {
        return "Category{" +
                "id='" + id + '\'' +
                ", typeName='" + typeName + '\'' +
                '}';
    }
}
