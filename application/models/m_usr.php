<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_usr extends CI_Model {

	
	public function getLogin($u,$p) //menampung nulai dari contoller login, jika di controller 2 variable d model juga harus 2
	{
		$pwd = md5($p);//password yg di encryp MD5
		$this->db->where('user_email',$u);// kondisi apakah username sama dengan isi dengan table
		$this->db->where('user_password',$pwd);//kondisi password yag sudang di encryp
		$q = $this->db->get('user_details');//table yang di akses
		if($q->num_rows()>0) //apakah username dan password benar sesuai dengan data di table
		{
			//jika benar
			foreach($q->result() as $row) //isian dari table di tampung di variable $row
			{
				//membuat variable sess untuk menampung isi dari table agar dapat kita gunakan kembali di aplikasi

				if ($row->user_status == 'Inactive') {
					$this->session->set_flashdata('info','Your account have been disable, please contact admin');
					//di arahkan ke login
					redirect('user_online');
				}
		        
		        $sess = array(
					'username' => $row->user_name,
					// 'nama_lengkap' =>$row->nama_lengkap,
					'level' => $row->user_type,
					'type' => $row->user_type,
					'idpengguna' => '',
	                'idgrup' => '',
	                // 'namapengguna' =>$row->nama_lengkap ,
	                'platform' => $this->agent->platform(),
	                'browser' => $agent,
	                'logged_in' => true,
				);

				$this->session->set_userdata($sess);
				//akan di arahkan ke controller home
				// $this->updateLastLogin($row->id_username);
				$this->last_activity($row->user_id);

				if ($this->session->userdata('level') == 'master') {
                    redirect('user_online/admins');
                } else {
                    redirect('user_online');
                }

				//redirect('admin/home');
			}
		}else{
			//jika username dan password salah
			$this->session->set_flashdata('info','Maaf email atau password salah');
			//di arahkan ke login
			redirect('user_online');
		}
	}

	function last_activity($usr) {
		$data = array(
			'user_id' => $usr,
			'last_activity' => date('Y-m-d H:i:s')
		);
        $this->db->insert('login_details', $data);

        $last_id = $this->db->insert_id();
        $login_id = last_insert_id();
        $this->session->set_userdata('login_id', $last_id);
        return TRUE;
	}

	function changeStatus($user_id, $user_status) {
		if ($user_status == 'Active') {
			$status = 'Inactive';
		} else {
			$status = 'Active';
		}
		$data = array('user_status' => $status);
		$this->db->where("user_id", $user_id);
        $this->db->update("user_details", $data);
        if ($status) {
			echo '
				<div class="alert alert-success">User status has been set to <strong>'.$status.'</strong></div>
			';
		}
	}

	function getData() {
        
        $q = "SELECT login_details.user_id, user_details.user_email, user_details.user_image FROM login_details INNER JOIN user_details ON user_details.user_id = login_details.user_id WHERE last_activity > DATE_SUB(NOW(), INTERVAL 5 SECOND) AND user_details.user_type = 'user'";
        $query = $this->db->query($q);
        $count = $query->num_rows();
        $output = '';
        $output .= '
        	<div class="table-responsive">
				<div class="" align="right">
					'.$count.' Users Online
				</div>
				<table class="table table-bordered table-striped">
					<tr>
						<th>No.</th>
						<th>Email ID</th>
						<th>Image</th>
					</tr>
        ';

        $i = 0;
    	foreach ($query->result() as $row) {
    		$output .='
    			<tr>
					<td>'.$i++.'</td>
					<td>'.$row->user_email.'</td>
					<td><img src="'.$row->user_image.'" class="img-thumbnail" width="50"></td>
				</tr>
    		';
    	}
        $output .= '</table></div>';

        echo $output;
    }

    function fetchData() {
    	$query = $this->db->select('*')
    	 		->where('user_type', 'user')
                ->order_by('user_name')
                ->get('user_details');
        $output = '';
        $output .= '
        	<table class="table table-bordered table-striped">
    			<tr>
    				<td>Name</td>
    				<td>Email</td>
    				<td>Status</td>
    				<td>Action</td>
    			</tr>
        ';
    	foreach ($query->result() as $row) {
    		switch ($row->user_status) {
                case 'Active':
                    $status = "<span class=\"label label-success\">Active</span>";
                    break;                   
                default:
                    $status = "<span class=\"label label-danger\">Inactive</span>";
                    break;
            }  
    		$output .='
    			<tr>
    				<td>'.$row->user_name.'</td>
    				<td>'.$row->user_email.'</td>
    				<td>'.$status.'</td>
    				<td><button type="button" name="action" class="btn btn-info btn-xs action" data-user_id="'.$row->user_id.'" data-user_status="'.$row->user_status.'">Action</button></td>
    			</tr>
    		';
    	}
        $output .= '</table>';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */