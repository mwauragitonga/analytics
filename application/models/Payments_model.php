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
    }
    public function totalSubscriptionRevenue($start_date, $end_date)
    {
        $this->db->select("SUM(transaction_Amount) as revenue");
        $this->db->from("mpesa_confirmations");
        $this->db->where("Payment_type",'subscription');
        // $this->db->where();
        $query = $this->db->get()->row();
        return $query->revenue;
    }
    public function totalTabletRevenue($start_date, $end_date)
    {
        $this->db->select("SUM(transaction_Amount) as revenue");
        $this->db->from("mpesa_confirmations");
        $this->db->where("Payment_type",'Tablet');
        $query = $this->db->get()->row();
        return $query->revenue;
    }
    public function totalUncategorisedRevenue($start_date, $end_date)
    {
        $this->db->select("SUM(transaction_Amount) as revenue");
        $this->db->from("mpesa_confirmations");
        $this->db->where("Payment_type",'Uncategorized');
        $query = $this->db->get()->row();
        return $query->revenue;
    }
    public function orgBalance()
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
    // new subscription method
	public function tablet_revenue_By_Months($instance_month)
	{		$this->db->select("COALESCE(SUM(transaction_Amount),0) as revenue");
			$this->db->from("mpesa_confirmations");
			$this->db->where("transaction_ID !=", "NULL");
			$this->db->where("Payment_type", "Tablet");
			$this->db->like('transaction_Time', $instance_month);


		$query = $this->db->get()->row();
		return $query->revenue;
	}


    public function subscriptions_Comparisons($instance_month, $subscription_type)
    {
        $this->db->select("COUNT(index_ID) as count");
        $this->db->from("mpesa_callbacks");
        $this->db->where("subscription_type", $subscription_type);
        $this->db->where("amount >", '1');

        //    $this->db->where(date('m',strtotime("timestamp")),$instance_month);
        $this->db->like("time_of_payment", $instance_month);
        $query = $this->db->get()->row();
        return $query->count;
    }

	public function payers()
	{
		$this->db->select('amount,mpesa_callbacks.transaction_ID,time_of_payment,mpesa_confirmations.Payment_type as paymentType,fname,mpesa_callbacks.mobile as msisdn, schools.name as school_name,users.mobile,user_registration_source.source_name');
		$this->db->from('mpesa_callbacks');
		$this->db->join('users', 'users.email = mpesa_callbacks.email');
		$this->db->join('mpesa_confirmations', 'mpesa_confirmations.transaction_ID = mpesa_callbacks.transaction_ID');
		$this->db->join('user_registration_source', 'user_registration_source.source_code = users.registration_source');
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join('schools',"students.school_code = schools.school_code");
		$this->db->where('(amount != 0 AND amount != 1 )');
		$this->db->order_by('time_of_payment', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}


	public function tabletPayment()
	{
		$this->db->select('first_name,middle_name,last_name,MSISDN,transaction_Amount,transaction_ID,transaction_Time,Payment_type as paymentType');
		$this->db->from('mpesa_confirmations');
		$this->db->where('Payment_type=','Tablet');
		$this->db->order_by('transaction_Time ', 'DESC');
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
	public function tabletPayments()
	{
		$this->db->select('*');
		$this->db->from('mpesa_confirmations');
		$this->db->where('Payment_type','Tablets');
		$this->db->order_by(' transaction_Time ', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function repeatCustomers($start_date, $end_date)
	{
		$this->db->select('users.user_id,users.fname,users.mobile,mpesa_callbacks.subscription_type,COUNT(mpesa_callbacks.index_ID) as count,mpesa_callbacks.email');
		$this->db->from('mpesa_callbacks');
		$this->db->join('users', 'users.email = mpesa_callbacks.email');
		$this->db->where('amount != 0 AND amount != 1 AND amount != ""');
		$this->db->having('count>',1);
		$this->db->group_by('mpesa_callbacks.email');
		$customers = $this->db->get()->result();
	//	$count = $this->db->get()->num_rows();

		 return $customers;
	}
	public function repeatTimes($user_id)
	{
		$this->db->select('users.fname,users.mobile,mpesa_callbacks.mobile as payingMobile, mpesa_callbacks.subscription_type,mpesa_callbacks.transaction_ID,mpesa_callbacks.time_of_payment,mpesa_callbacks.email, mpesa_callbacks.amount');
		$this->db->from('mpesa_callbacks');
		$this->db->join('users', 'users.email = mpesa_callbacks.email');
		$this->db->where('amount != 0 AND amount != 1 AND amount != ""');
		$this->db->where('users.user_id',$user_id);
		$customer = $this->db->get()->result();

		//	$count = $this->db->get()->num_rows();

		return $customer;
	}
	public function cumulative_total()
	{
		$initial_paybill_amount = 63753; //i am sorry i had to hardcode this @cyrus. It was the initial amount in the paybill at start
		$amounts = $this->reports();
		foreach ($amounts as $amount) {
			$initial_paybill_amount += $amount->transaction_Amount;
		}
		return $initial_paybill_amount;
	}

}
