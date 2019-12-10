<?php
/*Designed and written by Cyrus Muchiri <cmuchiri8429@gmail.com>*/
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payments_model extends CI_Model
{
    public function __construct()
    {
    }

    public function totalRevenue($start_date, $end_date)
    {
        $this->db->select("SUM(amount) as revenue");
        $this->db->from("mpesa_callbacks");
        // $this->db->where();
        $query = $this->db->get()->row();
        return $query->revenue;
    }public function orgBalance()
    {
        $this->db->select("org_account_balance");
        $this->db->from("mpesa_confirmations");
        $this->db->order_by('index', 'DESC');
        $query = $this->db->get()->row();
        return $query->org_account_balance;
    }

    public function active_Yearly_Subscribers($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type", "yearly");
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function active_Monthly_Subscribers($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type", "monthly");
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function active_Termly_Subscribers($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type", "termly");
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function none_subscribers($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("(subscription_type = 'none' OR subscription_type = '')");

        $query = $this->db->get()->row();
        return $query->count;
    }

    public function paymentAttempts($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("mpesa_callbacks");
        //$this->db->where("");
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function successfulPaymentAttempts($start_date, $end_date)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("mpesa_callbacks");
        $this->db->where("amount >", 0);
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function revenue_By_Months($instance_month, $type = '')
    {
        if ($type == 'stk_push') {
			$this->db->select("SUM(amount) as revenue");
			$this->db->from("mpesa_callbacks");
			$this->db->where("transaction_ID !=", "NULL");
			$this->db->like('time_of_payment', $instance_month);
        } elseif ($type == 'paybill') {
			$this->db->select("SUM(transaction_Amount) as revenue");
			$this->db->from("mpesa_confirmations");
			$this->db->where("transaction_ID !=", "NULL");
			$this->db->like('transaction_Time', $instance_month);
        }

        $query = $this->db->get()->row();
        return $query->revenue;
    }

    public function subscriptions_Comparisons($instance_month, $subscription_type)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("student_subscriptions");
        $this->db->where("subscription_type", $subscription_type);
        //    $this->db->where(date('m',strtotime("timestamp")),$instance_month);
        $this->db->like("start_date", $instance_month);
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function payers()
    {
        $this->db->select('amount,transaction_ID,time_of_payment,fname,mpesa_callbacks.mobile as msisdn, users.mobile,user_registration_source.source_name');
        $this->db->from('mpesa_callbacks');
        $this->db->join('users', 'users.email = mpesa_callbacks.email');
        $this->db->join('user_registration_source', 'user_registration_source.source_code = mpesa_callbacks.registration_source');
        $this->db->where('(amount != 0 AND amount != 1 )');
        $this->db->order_by('time_of_payment', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }
    public function reports()
    {
        $this->db->select('*');
        $this->db->from('mpesa_confirmations');
        $this->db->order_by(' transaction_Time ', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

}
