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
        $data["active_Yearly_Subscribers"] = $this->Payments_model->active_Yearly_Subscribers($start_date, $end_date);
        $data["active_Termly_Subscribers"] = $this->Payments_model->active_Monthly_Subscribers($start_date, $end_date);
        $data["active_Monthly_Subscribers"] = $this->Payments_model->active_Termly_Subscribers($start_date, $end_date);
        $data["non_Subscribers"] = $this->Payments_model->none_subscribers($start_date, $end_date);
        $data["payment_Attempts"] = $this->Payments_model->paymentAttempts($start_date, $end_date);
        $data["successful_Payment_Attempts"] = $this->Payments_model->successfulPaymentAttempts($start_date, $end_date);

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
        $data["subscriptions_Comparisons"] = $this->subscriptions_Comparisons();
        $response = array(
            "status" => true,
            "graph_data" => $data
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function revenue_By_Months()
    {

        $months[1] = "Jan";
        $months[2] = "Feb";
        $months[3] = "Mar";
        $months[4] = "Apr";
        $months[5] = "May";
        $months[6] = "June";
        $months[7] = "July";
        $months[8] = "Aug";
        $months[9] = "Sept";
        $months[10] = "Oct";
        $months[11] = "Nov";
        $months[0] = "Dec";
        $month = date('m');
        $year = date('Y');
        $revenue = array();

        for ($i = 0; $i < 12; $i++) {
            $instance_month = $month - $i < 0 ? ($year-1).$month - $i + 12 : $year.$month;
            print_r($instance_month);
            $revenue[$i] = $this->Payments_model->revenue_By_Months($instance_month);
            $month --;
        }
        return $revenue;

    }
    public function subscriptions_Comparisons(){
        $months[1] = "Jan";
        $months[2] = "Feb";
        $months[3] = "Mar";
        $months[4] = "Apr";
        $months[5] = "May";
        $months[6] = "June";
        $months[7] = "July";
        $months[8] = "Aug";
        $months[9] = "Sept";
        $months[10] = "Oct";
        $months[11] = "Nov";
        $months[0] = "Dec";
        $month = date('m');
        $subscriptions['monthly_subscriptions'] = array();
        $subscriptions['yearly_subscriptions'] = array();
        $subscriptions['termly_subscriptions'] = array();

        for ($i = 0; $i < 12; $i++) {
            $instance_month = $month - $i < 0 ? $month - $i + 12 : $month;
           // $subscriptions[$i] = $this->Payments_model->subscriptions_Comparisons($instance_month);
            array_push($subscriptions['monthly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($instance_month,"monthly"));
            array_push($subscriptions['termly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($instance_month,"termly"));
            array_push($subscriptions['yearly_subscriptions'],$this->Payments_model->subscriptions_Comparisons($instance_month,"yearly"));
            $month--;
        }
        return $subscriptions;
    }


}