package com.tuna.DTO;

public class MemberDTO {
    private int member_id;
    private String member_name;
    private String email;
    private String password;

    public MemberDTO() {
    }

    public MemberDTO(int member_id, String member_name, String email, String password) {
        this.member_id = member_id;
        this.member_name = member_name;
        this.email = email;
        this.password = password;
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
}