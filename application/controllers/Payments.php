<?php
/*Created By Cyrus Muchiri
 * Date : 19th Sep 2019
 * Email : cmuchiri8429@gmail.com
 */

require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Payments extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data ['title'] = "Dawati Analytics | Payments";
        $this->data ['description'] = "";

        $this->load->model('Payments_model');

    }

    public function tiles_post()
    {
        $post_data = file_get_contents("php://input");
        $decoded_post_data = json_decode($post_data);

        $start_date = " ";
        $end_date = " ";
        $data = array();
        $data["total_Revenue"] = $this->Payments_model->totalRevenue($start_date, $end_date);
        $data["total_Subscription_Revenue"] = $this->Payments_model->totalSubscriptionRevenue($start_date, $end_date);
        $data["total_Tablets_Revenue"] = $this->Payments_model->totalTabletRevenue($start_date, $end_date);
        $data["total_Uncategorized_Revenue"] = $this->Payments_model->totalUncategorisedRevenue($start_date, $end_date);
        $data['org_Balance'] =  $this->Payments_model->orgBalance();
        $data["active_Yearly_Subscribers"] = $this->Payments_model->active_Yearly_Subscribers($start_date, $end_date);
        $data["active_Termly_Subscribers"] = $this->Payments_model->active_Termly_Subscribers($start_date, $end_date);
        $data["active_Monthly_Subscribers"] = $this->Payments_model->active_Monthly_Subscribers($start_date, $end_date);
     //   $data["non_Subscribers"] = $this->Payments_model->none_subscribers($start_date, $end_date);
        $data["payment_Attempts"] = $this->Payments_model->paymentAttempts($start_date, $end_date);
        $data["successful_Payment_Attempts"] = $this->Payments_model->successfulPaymentAttempts($start_date, $end_date);
        $data["cumulative"] = $this->Payments_model->cumulative_total();
        $repeatCustomers = $this->Payments_model->repeatCustomers($start_date,$end_date);
		$data['repeatCustomers'] = sizeof($repeatCustomers);
        $response = array(
            "status" => true,
            "tiles_data" => $data,
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function graphs_post()
    {
        $post_data = file_get_contents("php://input");
        $decoded_post_data = json_decode($post_data);
        $start_date = " ";
        $end_date = " ";
        $data = array();
        $data["revenue_By_Months"] = $this->revenue_By_Months();
        $data['tablet_Payments'] =$this->tabletsPayments();
       // $data['paybill_total'] = $this->payBillTotal();
        $data["subscriptions_Comparisons"] = $this->subscriptions_Comparisons();
        $response = array(
            "status" => true,
            "graph_data" => $data
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }
//stk push
    public function revenue_By_Months()
    {

        $dat = date('Y-m-d');
        $date = new DateTime($dat);
        $revenue = array();
        $period = $date->modify("-11 months");
        for ($i = 0; $i < 12; $i++) {
            $revenue[$i] = $this->Payments_model->revenue_By_Months($period->format('Ym'),'stk_push');
            $period = $date->modify("+1 months");
        }
        return $revenue;

    }
    //includes payments outside stk push
    public function payBillTotal()
    {

        $dat = date('Y-m-d');
        $date = new DateTime($dat);
        $revenue = array();
        $period = $date->modify("-11 months");
        for ($i = 0; $i < 12; $i++) {
            $revenue[$i] = $this->Payments_model->revenue_By_Months($period->format('Ym'),'paybill');
            $period = $date->modify("+1 months");
        }
        return $revenue;

    }

function tabletsPayments(){

	$dat = date('Y-m-d');
	$date = new DateTime($dat);
	$tablet_revenue = array();
	$period = $date->modify("-11 months");
	for ($i = 0; $i < 12; $i++) {
		$revenue[$i] = $this->Payments_model->tablet_revenue_By_Months($period->format('Ym'));
		$period = $date->modify("+1 months");
	}
	return $revenue;
}
    public function subscriptions_Comparisons(){

        $dat = date('Y-m-d');
        $date = new DateTime($dat);
        $subscriptions['monthly_subscriptions'] = array();
        $subscriptions['yearly_subscriptions'] = array();
        $subscriptions['termly_subscriptions'] = array();
        $period = $date->modify("-11 months");
        for ($i = 0; $i < 12; $i++) {
          //  print_r($period); echo "<br>";
            array_push($subscriptions['monthly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($period->format("Ym"),"monthly"));
            array_push($subscriptions['termly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($period->format("Ym"),"termly"));
            array_push($subscriptions['yearly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($period->format("Ym"),"yearly"));
            $period = $date->modify("+1 months");

        }
        return $subscriptions;
    }


}
