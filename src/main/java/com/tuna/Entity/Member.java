package com.tuna.Entity;
import javax.persistence.*;
@Entity
@Table(name="kh")
public class Member {
    @Id
    @Column(name="MA_KH", length = 45)
    @GeneratedValue(strategy = GenerationType.AUTO)
    private int member_id;
    @Column(name="TEN_KH", length = 255)
    private String member_name;
    @Column(name="EMAIL", length = 255)
    private String email;
    @Column(name="MATKHAU", length = 255)
    private String password;
    @Column(name="SDT", length = 255)
    private String phone;
    @Column(name="DIACHI", length = 255)
    private String address;
    @Column(name="STATUS", length = 255)
    private boolean status;
    public Member() {
    }

    public Member(int member_id, String member_name, String email, String password, String phone, String address, boolean status) {
        this.member_id = member_id;
        this.member_name = member_name;
        this.email = email;
        this.password = password;
        this.phone = phone;
        this.address = address;
        this.status = status;
    }

    public int getMember_id() {
        return member_id;
    }

    public void setMember_id(int member_id) {
        this.member_id = member_id;
    }

    public String getMember_name() {
        return member_name;
    }

    public void setMember_name(String member_name) {
        this.member_name = member_name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public boolean isStatus() {
        return status;
    }

    public void setStatus(boolean status) {
        this.status = status;
    }
}
