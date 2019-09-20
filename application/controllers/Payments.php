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

    public function initialize_post()
    {
        $post_data = file_get_contents("php://input");
        $decoded_post_data = json_decode($post_data);
        try {
            /*$start_date = $decoded_post_data->startDate;
            $end_date = $decoded_post_data->endDate;*/
            $start_date = "";
            $end_date = "";
            $tiles_data = $this->tilesData($start_date, $end_date);
            $graph_data = $this->graphsData();

            $response = array(
                "status" => true,
                "tiles_data" => $tiles_data,
                "graph_data" => $graph_data
            );
            $this->response($response, REST_Controller::HTTP_OK);
        } catch (Exception $e) {
            $response = "Fail";
            $this->response($response, REST_Controller::HTTP_NO_CONTENT);

        }
    }

    public function tilesData($start_date, $end_date)
    {
        $data = array();
        $data["total_Revenue"] = $this->Payments_model->totalRevenue($start_date, $end_date);
        $data["active_Yearly_Subscribers"] = $this->Payments_model->active_Yearly_Subscribers($start_date, $end_date);
        $data["active_Termly_Subscribers"] = $this->Payments_model->active_Monthly_Subscribers($start_date, $end_date);
        $data["active_Monthly_Subscribers"] = $this->Payments_model->active_Termly_Subscribers($start_date, $end_date);
        $data["non_Subscribers"] = $this->Payments_model->none_subscribers($start_date, $end_date);
        $data["payment_Attempts"] = $this->Payments_model->paymentAttempts($start_date, $end_date);
        $data["successful_Payment_Attempts"] = $this->Payments_model->successfulPaymentAttempts($start_date, $end_date);

        return $data;
    }

    public function graphsData()
    {
        $data = array();
        $data["revenue_By_Months"] = $this->revenue_By_Months();
        $data["subscriptions_Comparisons"] = $this->Payments_model->subscriptions_Comparisons();
    }

    public function revenue_By_Months()
    {

        $time = strtotime('20190405130955');
        // print_r($time);
        $month = date('m', $time);
        //  print_r($month);
        $month = date('m');
        $revenue = array();

        for ($i = 0; $i < 12; $i++) {
            $instance_month = $month - $i < 0 ? $month - $i + 12 : $month - $i;
            $revenue[$i] = $this->Payments_model->revenue_By_Months($instance_month);
        }
        return $revenue;

    }
    public function subscriptions_Comparison(){
        $month = date('m');
        $subscriptions = array();

        for ($i = 0; $i < 12; $i++) {
            $instance_month = $month - $i < 0 ? $month - $i + 12 : $month - $i;
            $subscriptions[$i] = $this->Payments_model->subscriptions_Comparisons($instance_month);
        }
        return $subscriptions;
    }


}