using System;
using System.Data;
using System.Data.SqlClient;
using System.Windows.Forms;

namespace WindowsFormsApp_test
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            Load_data();
        }
        void Load_data()
        {
            SqlConnection con = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = Test; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            SqlDataAdapter da = new SqlDataAdapter("select * from Sach", con);
            DataTable dt = new DataTable();
            con.Open();
            da.Fill(dt);
            grvData.DataSource = dt;
            con.Close();
        }

        private void btn_add_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = Test; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            int ID = Convert.ToInt16(tb_codeBook.Text);
            string name = tb_tittle.Text;
            double price = Convert.ToDouble(tb_price.Text);
            int amount = Convert.ToInt16(tb_count.Text);
            SqlCommand cmd = new SqlCommand($"insert into Sach values ('{ID}', '{name}', '{price}', '{amount}')", con);
            con.Open();
            int ret = cmd.ExecuteNonQuery();
            if (ret != 0)
            {
                MessageBox.Show("Thêm thành công");
                Load_data();
            }
            con.Close();
        }

        private void btn_update_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = Test; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            int ID = Convert.ToInt16(tb_codeBook.Text);
            string name = tb_tittle.Text;
            double price = Convert.ToDouble(tb_price.Text);
            int amount = Convert.ToInt16(tb_count.Text);
            SqlCommand cmd = new SqlCommand($"update Sach set Ten = '{name}', Gia = '{price}', Soluong = '{amount}' where Id = '{ID}'", con);
            con.Open();
            int ret = cmd.ExecuteNonQuery();
            if (ret != 0)
            {
                MessageBox.Show("Sửa thành công");
                Load_data();
            }
            con.Close();
        }

        private void btn_delete_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = Test; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            int ID = Convert.ToInt16(tb_codeBook.Text);
            SqlCommand cmd = new SqlCommand($"delete from Sach where Id = '{ID}'", con);
            con.Open();
            int ret = cmd.ExecuteNonQuery();
            if (ret != 0)
            {
                MessageBox.Show("Xóa thành công");
                Load_data();
            }
            con.Close();
        }

        private void btn_search_Click(object sender, EventArgs e)
        {
            string Ten = tb_search.Text;
            SqlConnection con = new SqlConnection("Data Source = (localdb)\\MSSQLLocalDB; Initial Catalog = Test; Integrated Security = True; Connect Timeout = 30; Encrypt = False; ApplicationIntent = ReadWrite; MultiSubnetFailover = False");
            SqlDataAdapter da = new SqlDataAdapter($"select * from Sach where Ten like '{Ten}'", con);
            DataTable dt = new DataTable();
            con.Open();
            da.Fill(dt);
            grvData.DataSource = dt;
            con.Close();
        }

        private void GrvData_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            tb_codeBook.Text = grvData.Rows[e.RowIndex].Cells[0].Value.ToString();
            tb_tittle.Text = grvData.Rows[e.RowIndex].Cells[1].Value.ToString();
            tb_price.Text = grvData.Rows[e.RowIndex].Cells[2].Value.ToString();
            tb_count.Text = grvData.Rows[e.RowIndex].Cells[3].Value.ToString();

        }

        private void Refresh_Click(object sender, EventArgs e)
        {
            Load_data();
        }
    }
}
