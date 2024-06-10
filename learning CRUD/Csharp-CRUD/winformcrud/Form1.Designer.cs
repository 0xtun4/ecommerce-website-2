namespace WindowsFormsApp_test
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.tb_codeBook = new System.Windows.Forms.TextBox();
            this.tb_tittle = new System.Windows.Forms.TextBox();
            this.tb_search = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.grvData = new System.Windows.Forms.DataGridView();
            this.tb_price = new System.Windows.Forms.TextBox();
            this.tb_count = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.btn_add = new System.Windows.Forms.Button();
            this.btn_update = new System.Windows.Forms.Button();
            this.btn_delete = new System.Windows.Forms.Button();
            this.btn_search = new System.Windows.Forms.Button();
            this.refresh = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.grvData)).BeginInit();
            this.SuspendLayout();
            // 
            // tb_codeBook
            // 
            this.tb_codeBook.Location = new System.Drawing.Point(110, 77);
            this.tb_codeBook.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.tb_codeBook.Name = "tb_codeBook";
            this.tb_codeBook.Size = new System.Drawing.Size(309, 22);
            this.tb_codeBook.TabIndex = 0;
            // 
            // tb_tittle
            // 
            this.tb_tittle.Location = new System.Drawing.Point(110, 142);
            this.tb_tittle.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.tb_tittle.Name = "tb_tittle";
            this.tb_tittle.Size = new System.Drawing.Size(309, 22);
            this.tb_tittle.TabIndex = 0;
            // 
            // tb_search
            // 
            this.tb_search.Location = new System.Drawing.Point(110, 16);
            this.tb_search.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.tb_search.Name = "tb_search";
            this.tb_search.Size = new System.Drawing.Size(859, 22);
            this.tb_search.TabIndex = 0;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(19, 146);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(53, 16);
            this.label1.TabIndex = 1;
            this.label1.Text = "Tiêu đề";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(22, 81);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(58, 16);
            this.label2.TabIndex = 1;
            this.label2.Text = "Mã sách";
            // 
            // grvData
            // 
            this.grvData.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.grvData.Location = new System.Drawing.Point(22, 234);
            this.grvData.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.grvData.Name = "grvData";
            this.grvData.RowHeadersWidth = 51;
            this.grvData.RowTemplate.Height = 24;
            this.grvData.Size = new System.Drawing.Size(946, 249);
            this.grvData.TabIndex = 2;
            this.grvData.CellClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.GrvData_CellClick);
            // 
            // tb_price
            // 
            this.tb_price.Location = new System.Drawing.Point(627, 77);
            this.tb_price.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.tb_price.Name = "tb_price";
            this.tb_price.Size = new System.Drawing.Size(341, 22);
            this.tb_price.TabIndex = 0;
            // 
            // tb_count
            // 
            this.tb_count.Location = new System.Drawing.Point(627, 151);
            this.tb_count.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.tb_count.Name = "tb_count";
            this.tb_count.Size = new System.Drawing.Size(341, 22);
            this.tb_count.TabIndex = 0;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(556, 81);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(53, 16);
            this.label3.TabIndex = 1;
            this.label3.Text = "Đơn giá";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(556, 155);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(60, 16);
            this.label4.TabIndex = 1;
            this.label4.Text = "Số lượng";
            // 
            // btn_add
            // 
            this.btn_add.Location = new System.Drawing.Point(22, 512);
            this.btn_add.Margin = new System.Windows.Forms.Padding(4);
            this.btn_add.Name = "btn_add";
            this.btn_add.Size = new System.Drawing.Size(103, 28);
            this.btn_add.TabIndex = 3;
            this.btn_add.Text = "Thêm mới";
            this.btn_add.UseVisualStyleBackColor = true;
            this.btn_add.Click += new System.EventHandler(this.btn_add_Click);
            // 
            // btn_update
            // 
            this.btn_update.Location = new System.Drawing.Point(337, 512);
            this.btn_update.Margin = new System.Windows.Forms.Padding(4);
            this.btn_update.Name = "btn_update";
            this.btn_update.Size = new System.Drawing.Size(100, 28);
            this.btn_update.TabIndex = 3;
            this.btn_update.Text = "Cập nhật";
            this.btn_update.UseVisualStyleBackColor = true;
            this.btn_update.Click += new System.EventHandler(this.btn_update_Click);
            // 
            // btn_delete
            // 
            this.btn_delete.Location = new System.Drawing.Point(602, 512);
            this.btn_delete.Margin = new System.Windows.Forms.Padding(4);
            this.btn_delete.Name = "btn_delete";
            this.btn_delete.Size = new System.Drawing.Size(100, 28);
            this.btn_delete.TabIndex = 3;
            this.btn_delete.Text = "Xóa";
            this.btn_delete.UseVisualStyleBackColor = true;
            this.btn_delete.Click += new System.EventHandler(this.btn_delete_Click);
            // 
            // btn_search
            // 
            this.btn_search.Location = new System.Drawing.Point(22, 16);
            this.btn_search.Margin = new System.Windows.Forms.Padding(4);
            this.btn_search.Name = "btn_search";
            this.btn_search.Size = new System.Drawing.Size(81, 28);
            this.btn_search.TabIndex = 3;
            this.btn_search.Text = "Tìm kiếm";
            this.btn_search.UseVisualStyleBackColor = true;
            this.btn_search.Click += new System.EventHandler(this.btn_search_Click);
            // 
            // refresh
            // 
            this.refresh.Location = new System.Drawing.Point(867, 516);
            this.refresh.Name = "refresh";
            this.refresh.Size = new System.Drawing.Size(99, 23);
            this.refresh.TabIndex = 4;
            this.refresh.Text = "Làm mới ";
            this.refresh.UseVisualStyleBackColor = true;
            this.refresh.Click += new System.EventHandler(this.Refresh_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1012, 577);
            this.Controls.Add(this.refresh);
            this.Controls.Add(this.btn_search);
            this.Controls.Add(this.btn_delete);
            this.Controls.Add(this.btn_update);
            this.Controls.Add(this.btn_add);
            this.Controls.Add(this.grvData);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.tb_count);
            this.Controls.Add(this.tb_search);
            this.Controls.Add(this.tb_tittle);
            this.Controls.Add(this.tb_price);
            this.Controls.Add(this.tb_codeBook);
            this.Margin = new System.Windows.Forms.Padding(3, 2, 3, 2);
            this.Name = "Form1";
            this.Text = "Form1";
            ((System.ComponentModel.ISupportInitialize)(this.grvData)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tb_codeBook;
        private System.Windows.Forms.TextBox tb_tittle;
        private System.Windows.Forms.TextBox tb_search;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.DataGridView grvData;
        private System.Windows.Forms.TextBox tb_price;
        private System.Windows.Forms.TextBox tb_count;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button btn_add;
        private System.Windows.Forms.Button btn_update;
        private System.Windows.Forms.Button btn_delete;
        private System.Windows.Forms.Button btn_search;
        private System.Windows.Forms.Button refresh;
    }
}

