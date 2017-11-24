<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rating extends CI_Controller
{
    // default user and post id ,you can change
    public $user_id = 12 ;
    public $post_id = 666666;

    function __construct()
    {
        parent::__construct();

        //$this->lang->load('rating/rating');
        $this->load->model('rating_model');
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
    }

    /**
     *  display all ratings in specfic article
     */
    function index()
    {
        $data["post_id"] = $this->post_id;
        $data["is_rated"] =  $this->rating_model->get_user_numrate($this->post_id,$this->user_id);

        $total_rates = 0;
        $total_points = 0;
        $query1 = $this->rating_model->get_article_rate($this->post_id);
        // check if article has rate if yes get it
        if($query1 !== false){
            $total_rates = $query1->rt_total_rates;
            $total_points = $query1->rt_total_points;
        }
        print_r($total_points);
        print_r($total_rates);
        // die();
        // if rating greater than zero
        // dived total rats on total rates and send it to view
        // else send zero to view
        if($total_points > 0 && $total_rates > 0){
            $ratings = $total_points/$total_rates;
            $data["ratings"] = $total_points/$total_rates;
            $data["rates"] = $ratings;
        }else{
            $data["rates"] = 0;
        }
        print_r($ratings);
        // die();
        $this->load->view('ratings',$data);
    }

    // create new rate
    function create_rate()
    {
        $user_id = 29;

        $post_id = $this->input->post("pid");
        $rate =  $this->input->post("score");

        //check the article is rated already

        //$rated = $this->rating_model->get_rate_numbers($post_id);
        $rated = 0;
        if ($rated == 0 ) {
            // if no send new rate record
            $rate_query = $this->rating_model->insert_rate($post_id, $rate, $user_id);
        } else {
            // else get rate id and update value
            $rate_id = $this->rating_model->get_article_rate($post_id);
            $rate_query = $this->rating_model->update_rate($rate_id->rt_id, $rate, $this->user_id);

        }
        //print_r($rate);
    /// after this see Succesfull msg
        if($rate_query)
        {
            echo "Voting Succesfull";
        }

    }

    function rater() {
        $post_id = $this->input->post("pid");
        $rate =  $this->input->post("score");

        $data = array(
            'rt_item_id' => $post_id,
            'rt_total_points' => $rate, 
            );

        $this->db->insert('d_rating', $data);

    }
}