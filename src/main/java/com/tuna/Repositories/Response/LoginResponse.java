package com.tuna.Repositories.Response;

public class LoginResponse {
    String message;
    Boolean status;
    Long user_id;
    String user_email;

    public LoginResponse() {
    }

    public LoginResponse(String message, Boolean status, Long user_id, String user_email) {
        this.message = message;
        this.status = status;
        this.user_id = user_id;
        this.user_email = user_email;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public Boolean getStatus() {
        return status;
    }

    public void setStatus(Boolean status) {
        this.status = status;
    }

    public Long getUser_id() {
        return user_id;
    }

    public void setUser_id(Long user_id) {
        this.user_id = user_id;
    }

    public String getUser_email() {
        return user_email;
    }

    public void setUser_email(String user_email) {
        this.user_email = user_email;
    }

    @Override
    public String toString() {
        return "LoginResponse{" +
                "message='" + message + '\'' +
                ", status=" + status +
                ", user_id=" + user_id +
                ", user_email='" + user_email + '\'' +
                '}';
    }
}