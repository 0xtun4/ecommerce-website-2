package com.tuna.learningswing;

import java.awt.BorderLayout;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JFrame;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import com.tuna.learningswing.database.ConnectDemo;
import Model.MytableModel;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;

public class FormData extends JFrame {

    private JScrollPane tblPane;
    private JTable table;
    private MytableModel myModel;
    private ConnectDemo connectData;

    public FormData() {
        super("Form kết nối CSDL");
        JButton btn_add, btn_update, btn_delete, btn_refresh;
        JTextField txtStt, txtAddress, txtName, txtBirth, txtClass;
        connectData = new ConnectDemo();
        connectData.initConnection();
        ResultSet rs = connectData.getData();
        try {
            myModel = new MytableModel(rs);
            table = new JTable(myModel);
            tblPane = new JScrollPane(table);

            // Set preferred column widths manually
            table.getColumnModel().getColumn(0).setPreferredWidth(20);
            table.getColumnModel().getColumn(1).setPreferredWidth(130);
            table.getColumnModel().getColumn(2).setPreferredWidth(200);
            table.getColumnModel().getColumn(3).setPreferredWidth(50);
            table.getColumnModel().getColumn(4).setPreferredWidth(90);
        } catch (SQLException e) {
            e.printStackTrace();
        }

        this.setLayout(new BorderLayout());
        this.getContentPane().add(tblPane, BorderLayout.NORTH);
        btn_add = new JButton("Thêm");
        btn_update = new JButton("Sửa");
        btn_delete = new JButton("Xóa");
        btn_refresh = new JButton("Cập nhật");
        txtStt = new JTextField(10);
        txtName = new JTextField(20);
        txtAddress = new JTextField(20);
        txtBirth = new JTextField(10);
        txtClass = new JTextField(10);
        JPanel controlPanel = new JPanel();
        controlPanel.add(btn_add);
        controlPanel.add(btn_update);
        controlPanel.add(btn_delete);
        controlPanel.add(btn_refresh);
        JPanel textPanel = new JPanel();
        textPanel.add(new JLabel("STT:"));
        textPanel.add(txtStt);
        textPanel.add(new JLabel("Họ và tên:"));
        textPanel.add(txtName);
        textPanel.add(new JLabel("Địa chỉ:"));
        textPanel.add(txtAddress);
        textPanel.add(new JLabel("Năm sinh:"));
        textPanel.add(txtBirth);
        textPanel.add(new JLabel("Lớp:"));
        textPanel.add(txtClass);
        this.add(textPanel, BorderLayout.CENTER);
        this.add(controlPanel, BorderLayout.SOUTH);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.setSize(1200, 600);
        
        btn_add.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int stt = Integer.parseInt(txtStt.getText());
                String hoTen = txtName.getText();
                String diaChi = txtAddress.getText();
                int namSinh = Integer.parseInt(txtBirth.getText());
                String tenLop = txtClass.getText();
                connectData.insert(stt, hoTen, diaChi, tenLop, namSinh);
//                }
                txtStt.setText("");
                txtName.setText("");
                txtAddress.setText("");
                txtBirth.setText("");
                txtClass.setText("");
                refresh();
//                        refesh
//                connectData.showData();
            }
        });

        btn_update.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int stt = Integer.parseInt(txtStt.getText());
                String hoTen = txtName.getText();
                String diaChi = txtAddress.getText();
                int namSinh = Integer.parseInt(txtBirth.getText());
                String tenLop = txtClass.getText();
                
                connectData.update(stt, hoTen, diaChi, tenLop, namSinh);
                txtStt.setText("");
                txtName.setText("");
                txtAddress.setText("");
                txtBirth.setText("");
                txtClass.setText("");
                refresh();
//                        refesh
//                connectData.showData();
            }
        });

        btn_delete.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int stt = Integer.parseInt(txtStt.getText());
                connectData.delete(stt);
                txtStt.setText("");
                txtName.setText("");
                txtAddress.setText("");
                txtBirth.setText("");
                txtClass.setText("");
                refresh();
//                        refesh
//                connectData.showData();
            }
        });

        btn_refresh.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                refresh();
            }
        });

        table.getSelectionModel().addListSelectionListener(new ListSelectionListener() {
            public void valueChanged(ListSelectionEvent event) {
                if (!event.getValueIsAdjusting()) {
                    int selectedRow = table.getSelectedRow();
                    if (selectedRow >= 0) {
                        txtStt.setText(table.getValueAt(selectedRow, 0).toString());
                        txtName.setText(table.getValueAt(selectedRow, 1).toString());
                        txtAddress.setText(table.getValueAt(selectedRow, 2).toString());
                        txtBirth.setText(table.getValueAt(selectedRow, 3).toString());
                        txtClass.setText(table.getValueAt(selectedRow, 4).toString());
                    }
                }
            }
        });
    }

    public void refresh() {
        ResultSet rs = connectData.getData();
        try {
            myModel = new MytableModel(rs);
            table.setModel(myModel);
            table.getColumnModel().getColumn(0).setPreferredWidth(15);
            table.getColumnModel().getColumn(1).setPreferredWidth(130);
            table.getColumnModel().getColumn(2).setPreferredWidth(200);
            table.getColumnModel().getColumn(3).setPreferredWidth(50);
            table.getColumnModel().getColumn(4).setPreferredWidth(90);

        } catch (SQLException e) {
            e.printStackTrace();
        }

    }

    public static void main(String args[]) {
        javax.swing.SwingUtilities.invokeLater(() -> {
            FormData formData = new FormData();
            formData.setVisible(true);
        });
    }
}
