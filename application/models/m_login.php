<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	
	public function getLogin($u,$p) //menampung nulai dari contoller login, jika di controller 2 variable d model juga harus 2
	{
		$pwd = md5($p);//password yg di encryp MD5
		$this->db->where('username',$u);// kondisi apakah username sama dengan isi dengan table
		$this->db->where('password',$pwd);//kondisi password yag sudang di encryp
		$q = $this->db->get('admins');//table yang di akses
		if($q->num_rows()>0) //apakah username dan password benar sesuai dengan data di table
		{
			//jika benar
			foreach($q->result() as $row) //isian dari table di tampung di variable $row
			{
				//membuat variable sess untuk menampung isi dari table agar dapat kita gunakan kembali di aplikasi

				if ($this->agent->is_browser())
		        {
		            $agent = $this->agent->browser().' '.$this->agent->version();
		        }
		        elseif ($this->agent->is_robot())
		        {
		            $agent = $this->agent->robot();
		        }
		        elseif ($this->agent->is_mobile())
		        {
		            $agent = $this->agent->mobile();
		        }
		        else
		        {
		            $agent = 'Unidentified User Agent';
		        }
		        
		        $sess = array(
					'username' => $row->username,
					'nama_lengkap' =>$row->nama_lengkap,
					'level' => $row->level,
					'idpengguna' => '',
	                'idgrup' => '',
	                'namapengguna' =>$row->nama_lengkap ,
	                'platform' => $this->agent->platform(),
	                'browser' => $agent,
	                'logged_in' => true,
				);

				$this->session->set_userdata($sess);
				//akan di arahkan ke controller home
				$this->updateLastLogin($row->id_username);
				// $this->last_activity($row->id_username);

				if ($this->session->userdata('level') == 1) {
                    redirect('matakuliah');
                } else {
                    redirect('login/home');
                }

				//redirect('admin/home');
			}
		}else{
			//jika username dan password salah
			$this->session->set_flashdata('info','Maaf username atau password salah');
			//di arahkan ke login
			redirect('login');
		}
	}

	function updateLastLogin($usr) {
		$data = array(
            'last_login' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_username', $usr);
        $this->db->update('admins', $data);
        return TRUE;
	}

	function last_activity($usr) {
		$data = array(
			'user_id' => $usr,
			'last_activity' => date('Y-m-d H:i:s')
		);
        $this->db->insert('login_details', $data);
        return TRUE;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */