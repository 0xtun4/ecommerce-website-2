using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Net.Mime.MediaTypeNames;

namespace WinformExam2
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            load_data();
        }

        void load_data()
        {
            SqlConnection conn = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = QLDL; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            SqlDataAdapter da = new SqlDataAdapter("select * from dl", conn);
            DataTable dt = new DataTable();
            conn.Open();
            da.Fill(dt);
            dataGridView1.DataSource = dt;
            conn.Close();
        }
        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            tb_id.Text = dataGridView1.Rows[e.RowIndex].Cells[0].Value.ToString();
            tb_name.Text = dataGridView1.Rows[e.RowIndex].Cells[1].Value.ToString();
            tb_phone.Text = dataGridView1.Rows[e.RowIndex].Cells[2].Value.ToString();
            tb_date.Text = dataGridView1.Rows[e.RowIndex].Cells[3].Value.ToString();
            tb_address.Text = dataGridView1.Rows[e.RowIndex].Cells[4].Value.ToString();
            tb_email.Text = dataGridView1.Rows[e.RowIndex].Cells[5].Value.ToString();
        }

        private void btn_add_Click(object sender, EventArgs e)
        {
            SqlConnection conn = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = QLDL; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            String name = tb_name.Text;
            String address = tb_address.Text;
            String date_accept = tb_date.Text;
            int phone = Convert.ToInt32(tb_phone.Text);
            String email = tb_email.Text;
            SqlCommand cmd = new SqlCommand($"insert into dl(name,address,day_accept,phone,email) values('{name}','{address}', '{date_accept}','{phone}','{email}')",conn);
            conn.Open();
            int result = cmd.ExecuteNonQuery();
            if (result > 0)
            {
                MessageBox.Show("Thêm thành công");
                load_data();
            }
            else
            {
                MessageBox.Show("Thêm thất bại");
            }
            conn.Close();
            load_data();
            
        }

        private void btn_update_Click(object sender, EventArgs e)
        {
            SqlConnection conn = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = QLDL; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            int ID = Convert.ToInt32(tb_id.Text);
            String name = tb_name.Text;
            String address = tb_address.Text;
            String date_accept = tb_date.Text;
            int phone = Convert.ToInt32(tb_phone.Text);
            String email = tb_email.Text;
            String sql = "update dl set name=N'" + name + "',address=N'" + address + "',day_accept='" + date_accept + "',phone='" + phone + "',email='" + email + "' where ID='" + ID + "'";
            SqlCommand cmd = new SqlCommand(sql, conn);
            conn.Open();
            int result = cmd.ExecuteNonQuery();
            if (result > 0)
            {
                MessageBox.Show("sua thanh cong");
                load_data();
            }
            else
            {
                MessageBox.Show("sua that bai");
            }
            conn.Close();
            load_data();
        }

        private void btn_del_Click(object sender, EventArgs e)
        {
            SqlConnection conn = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = QLDL; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            int ID = Convert.ToInt32(tb_id.Text);
            String sql = "delete from dl where ID='" + ID + "'";
            SqlCommand cmd = new SqlCommand(sql, conn);
            conn.Open();
            int result = cmd.ExecuteNonQuery();
            if (result > 0)
            {
                MessageBox.Show("xoa thanh cong");
                load_data();
            }
            else
            {
                MessageBox.Show("xoa that bai");
            }
            conn.Close();
            load_data();
        }

        private void btn_refresh_Click(object sender, EventArgs e)
        {
            load_data();
            tb_name.Text = "";
            tb_address.Text = "";
            tb_date.Text = "";
            tb_phone.Text = "";
            tb_email.Text = "";

        }
        private void btn_search_Click(object sender, EventArgs e)
        {
            String name = tb_search.Text;
            SqlConnection conn = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = QLDL; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            SqlDataAdapter da = new SqlDataAdapter("select * from dl where name like N'%" + name + "%'", conn);
            DataTable dt = new DataTable();
            conn.Open();
            da.Fill(dt);
            dataGridView1.DataSource = dt;
            conn.Close();

        }

        
    }
}
