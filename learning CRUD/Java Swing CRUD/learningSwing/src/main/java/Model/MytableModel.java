package Model;

import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.util.Vector;
import javax.swing.table.AbstractTableModel;
import com.tuna.learningswing.database.ConnectDemo;

public class MytableModel extends AbstractTableModel {
    private Vector<Vector<Object>> tblData;
    private Vector<String> colTitle;
    private String[] nameCol = {"STT", "Họ và tên", "Địa chỉ", "Năm sinh", "Lớp"};
    public MytableModel(ResultSet rs) throws SQLException {
        ResultSetMetaData rsmData = rs.getMetaData();
        int countCol = rsmData.getColumnCount();
        colTitle = new Vector<>(countCol);
        tblData = new Vector<>();

        // Populate column titles from ResultSetMetaData
        for (int i = 1; i <= countCol; i++) {
            colTitle.add(rsmData.getColumnName(i));
        }

        // Populate table data from the ResultSet
        while (rs.next()) {
            Vector<Object> rowData = new Vector<>();
            for (int i = 1; i <= countCol; i++) {
                rowData.add(rs.getObject(i));
            }
            tblData.add(rowData);
        }
    }
    
    @Override
    public int getRowCount() {
        return tblData.size();
    }

    @Override
    public int getColumnCount() {
        return nameCol.length;
    }

    @Override
    public String getColumnName(int columnIndex) {
        return nameCol[columnIndex];
    }

    @Override
    public Object getValueAt(int rowIndex, int columnIndex) {
        Vector<Object> rowData = tblData.get(rowIndex);
        return rowData.get(columnIndex);
    }
}
