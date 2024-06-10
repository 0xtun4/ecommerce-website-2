package com.tuna.learningswing.database;

import Model.MytableModel;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class ConnectDemo {

    private Connection con;
    private String url = "jdbc:mysql://localhost:3306/sinhvien";
    private String user = "root";
    private String password = "admin";

    public void initConnection() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            con = DriverManager.getConnection(url, user, password);
        } catch (SQLException e) {
            System.out.println("Database not found");
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            System.out.println("Cannot connect to the database");
            e.printStackTrace();
        }
    }

    public ResultSet getData() {
        ResultSet r = null;
        if (con != null) {
            try {
                Statement st = con.createStatement();
                r = st.executeQuery("SELECT * FROM sinhvien");
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        System.out.println("Data fetched successfully");
        return r;
    }

    public void insert(int id, String hoTen, String diaChi, String tenLop, int namSinh) {
        String sql = "INSERT INTO sinhvien (id, hoTen, diaChi, tenLop, namSinh) VALUES (?, ?, ?, ?, ?)";
        if (con != null) {
            try {
                PreparedStatement pr = con.prepareStatement(sql);
                pr.setInt(1, id);
                pr.setString(2, hoTen);
                pr.setString(3, diaChi);
                pr.setInt(4, namSinh);
                pr.setString(5, tenLop);
                pr.executeUpdate();
                pr.close();
                System.out.println("Inserted successfully");
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public void update(int id, String hoTen, String diaChi, String tenLop, int namSinh) {
        String sql = "UPDATE sinhvien SET hoTen=?, diaChi=?, tenLop=?, namSinh=? WHERE id=?";
        if (con != null) {
            try {
                PreparedStatement pr = con.prepareStatement(sql);
                pr.setString(1, hoTen);
                pr.setString(2, diaChi);
                pr.setInt(3, namSinh);
                pr.setString(4, tenLop);
                pr.setInt(5, id);

                pr.executeUpdate();
                pr.close();
                System.out.println("Data updated successfully");
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public void delete(int id) {
        String sql = "DELETE FROM sinhvien WHERE id=?";
        if (con != null) {
            try {
                PreparedStatement pr = con.prepareStatement(sql);
                pr.setInt(1, id);
                pr.executeUpdate();
                pr.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public void showData(ResultSet rs) {
        try {
            while (rs.next()) {
                System.out.printf("%-2s", rs.getInt(1));
                System.out.printf("%-20s", rs.getString(2));
                System.out.printf("%-15s", rs.getString(3));
                System.out.printf("%-15s", rs.getString(4));
                System.out.printf("%-15s", rs.getInt(5));
                System.out.printf("\n");
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
