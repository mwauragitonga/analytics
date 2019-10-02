<?php
/*Designed and written by Cyrus Muchiri <cmuchiri8429@gmail.com>*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments_model extends CI_Model
{
    public function __construct()
    {
    }
    public function totalRevenue($start_date,$end_date){
        $this->db->select("SUM(amount) as revenue");
        $this->db->from("mpesa_callbacks");
       // $this->db->where();
        $query = $this->db->get()->row();
        return $query->revenue;
    }
    public function active_Yearly_Subscribers($start_date,$end_date){
        $this->db->select( "COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type","yearly");
        $query = $this->db->get()->row();
        return $query->count;
    }
    public function active_Monthly_Subscribers($start_date,$end_date){
        $this->db->select( "COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type","monthly");
        $query = $this->db->get()->row();
        return $query->count;
    }
    public function active_Termly_Subscribers($start_date,$end_date){
        $this->db->select( "COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type","termly");
        $query = $this->db->get()->row();
        return $query->count;
    }
    public function  none_subscribers($start_date,$end_date){
        $this->db->select( "COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("(subscription_type = 'none' OR subscription_type = '')");

        $query = $this->db->get()->row();
        return $query->count;
    }
    public function paymentAttempts($start_date,$end_date){
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("mpesa_callbacks");
        //$this->db->where("");
        $query = $this->db->get()->row();
        return $query->count;
    }
    public function successfulPaymentAttempts($start_date,$end_date){
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("mpesa_callbacks");
        $this->db->where("transaction_ID !=","NULL");
        $query = $this->db->get()->row();
        return $query->count;
    }
    public function  revenue_By_Months($instance_month){
        $this->db->select("SUM(amount) as revenue");
        $this->db->from("mpesa_callbacks");
        $this->db->where("transaction_ID !=","NULL");
      //  $this->db->where('time_of_payment',date('m',strtotime("time_of_payment")),$instance_month);
        $this->db->like('time_of_payment',$instance_month);
        $query = $this->db->get()->row();
        return $query->revenue;
    }
    public function subscriptions_Comparisons($instance_month,$subscription_type){
        $this->db->select( "COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type",$subscription_type);
    //    $this->db->where(date('m',strtotime("timestamp")),$instance_month);
        $this->db->like("start_date" , $instance_month );
        $query = $this->db->get()->row();
        return $query->count;
    }

}
