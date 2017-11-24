<?php

class M_absen extends CI_Model{

	public function get_logAbsen($start, $end, $mk) {
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(-1);
        $tgl_sekarang = date("Y-m-d");
        $this->db->select("pw_mst_mahasiswa.nim, pw_mst_mahasiswa.nama_mhs, absensi.npm, absensi.status, absensi.tgl_post, absensi.date");
        $this->db->from("pw_mst_mahasiswa");
        $this->db->join("absensi","pw_mst_mahasiswa.nim = absensi.npm");
        //$this->db->where("date", $tgl);
        $this->db->where("absensi.date >=",$start);
        $this->db->where("absensi.date <=",$end);
        $this->db->where("matakuliah", $mk);
        $this->db->order_by('nim', 'desc');
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
            switch ($row->status) {
                case '1':
                    $status = "<span class=\"label label-success\">Hadir</span>";
                    break; 
                case '2':
                    $status = "<span class=\"label label-warning\">Terlambat</span>";
                    break; 
                case '3':
                    $status = "<span class=\"label label-warning\">Terlambat</span>";
                    break;                  
                default:
                    $status = "<span class=\"label label-danger\">Abstain</span>";
                    break;
            }       

            

            $mydatetime = $row->tgl_post;
            $datetimearray = explode(" ", $mydatetime);
            $date = $datetimearray[0];
            $time = $datetimearray[1];
            $reformatted_date = date('d-m-Y',strtotime($date));
            $reformatted_time = date('H:i:s',strtotime($time));

      

            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$row->nama_mhs."</td>";
            echo "<td>".$row->nim."</td>";
            echo "<td>".$reformatted_date."</td>";
            echo "<td>".$reformatted_time."</td>";
            echo "<td>".$status."</td>";
            echo "</tr>"; 
            $no++;
        }
    }

    public function check($npm, $mk) {
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(-1);
        $tgl_sekarang = date("Y-m-d");
        $this->db->select("*");
        $this->db->from("absensi");
        $this->db->where("npm", $npm);
        $this->db->where("date", $tgl_sekarang);
        $this->db->where("matakuliah", $mk);
        $query = $this->db->get();
       
        if($query->num_rows() > 0)
        {   
            echo 'Sudah Absen';
        } else {
            echo 'Belum Absen';
        }
        
    }

    public function get_rekap($mk) {
        error_reporting(-1);
        $query = $this->db->query("SELECT absensi.npm, absensi.status, absensi.matakuliah, pw_mst_mahasiswa.nim, pw_mst_mahasiswa.nama_mhs,
                SUM(CASE WHEN status = '1' THEN status END) AS masuk,
                SUM(CASE WHEN status = '2' THEN status END) AS terlambat,
                SUM(CASE WHEN status = '3' THEN status END) AS absen
                FROM absensi
                LEFT JOIN pw_mst_mahasiswa ON absensi.npm = pw_mst_mahasiswa.nim 
                WHERE matakuliah = ". $mk ."
                GROUP BY npm");

        $no = 1;
        foreach ($query->result_array() as $row)
        {   
            $late = $row['terlambat'] / 2;
            $abstain = $row['absen'] / 3;
            
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$row['nama_mhs']."</td>";
            echo "<td>".$row['npm']."</td>";
            echo "<td>".$row['masuk']."</td>";
            echo "<td>".$late."</td>";
            echo "<td>".$abstain."</td>";
            echo "</tr>"; 
            $no++;
        }
    }

}
