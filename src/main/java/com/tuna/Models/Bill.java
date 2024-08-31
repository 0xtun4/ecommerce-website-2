package com.tuna.Models;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity(name = "Bill")
@Table(name = "HOADON", schema = "cuahang")
public class Bill {
    @Id
    @Column(name = "MA_HD", length = 45)
    private long id;
    @Column(name = "MA_KH", length = 45)
    private long customerId;
    @Column(name = "TONGTIEN", length = 45)
    private long total;
    @Column(name = "TRANGTHAI", length = 45)
    private String status;

    public Bill() {
    }

    public Bill(int id, int customerId, int total, String status) {
        this.id = id;
        this.customerId = customerId;
        this.total = total;
        this.status = status;
    }

    public long getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public long getCustomerId() {
        return customerId;
    }

    public void setCustomerId(int customerId) {
        this.customerId = customerId;
    }

    public long getTotal() {
        return total;
    }

    public void setTotal(int total) {
        this.total = total;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    @Override
    public String toString() {
        return "Bill{" +
                "id=" + id +
                ", customerId=" + customerId +
                ", total=" + total +
                ", status='" + status + '\'' +
                '}';
    }
}
