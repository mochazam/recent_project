<?php
class Ektreemodel extends CI_Model{
     
 	//insert comments
 	public function insertcomments_article()
 	{
	      $this->load->helper('date');
	      $name=$this->input->post('name');
	      $email=$this->input->post('email');
	      $article_id=$this->input->post('article_id');
	      $comment=$this->input->post('comment');
	      $datestring = "%Y-%m-%d - %h:%i %a";
	      $time = time();
	      $date= mdate($datestring, $time);
     
	      $insertcomment=$this->db->insert('blog_comments',array('name'=>$name,'emailid'=>$email,'comment'=>$comment,'time'=>$date,'cmt_article_id'=>$article_id));
     	      return $insertcomment;       
 	}

 	//retrive comments
 	public function get_comments()
 	{
       	$article_id=$this->input->post('article_id');
       	$this->db->select('*');
       	$this->db->from('blog_comments');
       	$this->db->where('cmt_article_id',$article_id);
       	return $this->db->get();	
 	}
 	
 	public function get_latestcomment()
 	{
       	$article_id=$this->input->post('article_id');
       	$this->db->select('*');
       	$this->db->from('blog_comments');
       	$this->db->where('cmt_article_id',$article_id);
       	$this->db->order_by('comment_id', 'DESC');
       	$this->db->limit('1');
       	return $this->db->get();	
 	}
        
}
