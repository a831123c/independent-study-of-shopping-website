<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->library('session');
    }
    function index(){
        $data['wrong'] = 0;
        if($this->input->get('wrong')) $data['wrong'] = $this->input->get('wrong'); 
        $this->load->view('alogin',$data);
    }
    function checkStaff(){
        $account = $this->input->post('account');
		$password = $this->input->post('password');
        $this->load->database();
		$this->db->where('account', $account); 
		$this->db->where('password', $password); 
		$query = $this->db->get('amember');
        if($query->num_rows() == 1){
            $member = $query->row_array();
            $_SESSION['name'] = $member['name'];
            header("location: /admin/orderlist");
        }
        else header("location: /admin/index?wrong=1");
    }
    function orderlist(){
        $this->load->model('Back');
        $this->load->model('Front');
        if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
        if($this->input->post('page')) $page = $this->input->post('page');
        else $page = 1;
        $list = $this->Back->getOrderlist($page,1);
        $x=0;
        foreach($list as $tmp){
				$list[$x]['status'] = $this->Front->getstatus($tmp['status']);
                $list[$x]['detail'] = $this->Front->findCarDetail($tmp['sid']);
                $list[$x]['count'] = $this->Front->CarDetailCount($tmp['sid']);
                $y=0;
                foreach($list[$x]['detail'] as $detail){
                    $product = $this->Front->getProduct($detail['productID']);
                    $list[$x]['detail'][$y]['name'] =  $product['pname'];
                    $y++;
                }
 				$x++;
			}
        $data['orderlist'] = $list;
        $this->load->view('aorderlist',$data);
    }
    function transport(){
        $this->load->model('Back');
        $this->load->model('Front');
        if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
        if($this->input->post('page')) $page = $this->input->post('page');
        else $page = 1;
        $list = $this->Back->getOrderlist($page,2);
        $x=0;
        foreach($list as $tmp){
				$list[$x]['status'] = $this->Front->getstatus($tmp['status']);
                $list[$x]['detail'] = $this->Front->findCarDetail($tmp['sid']);
                $list[$x]['count'] = $this->Front->CarDetailCount($tmp['sid']);
                $y=0;
                foreach($list[$x]['detail'] as $detail){
                    $product = $this->Front->getProduct($detail['productID']);
                    $list[$x]['detail'][$y]['name'] =  $product['pname'];
                    $y++;
                }
 				$x++;
			}
        $data['orderlist'] = $list;
        $this->load->view('transport',$data);
    }
    function getfinish(){
         $this->load->model('Back');
        $this->load->model('Front');
        if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
        if($this->input->post('page')) $page = $this->input->post('page');
        else $page = 1;
        $list = $this->Back->getOrderlist($page,3);
        $x=0;
        foreach($list as $tmp){
				$list[$x]['status'] = $this->Front->getstatus($tmp['status']);
                $list[$x]['detail'] = $this->Front->findCarDetail($tmp['sid']);
                $list[$x]['count'] = $this->Front->CarDetailCount($tmp['sid']);
                $y=0;
                foreach($list[$x]['detail'] as $detail){
                    $product = $this->Front->getProduct($detail['productID']);
                    $list[$x]['detail'][$y]['name'] =  $product['pname'];
                    $y++;
                }
 				$x++;
			}
        $data['orderlist'] = $list;
        $this->load->view('finish',$data);
    }
    function stock(){
         $this->load->model('Back');
         $this->load->model('Front');
         if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
         if($this->input->get('page')) $page = $this->input->get('page');
         else $page = 1;
         $data['totalpage'] = ceil(($this->Back->getstockNum()/20));
         $data['page'] = $page;
         $data['stock'] = $this->Back->getstock($page);
         $this->load->view('stock',$data);
    }
    function deletestock(){
        $this->load->model('Back');
        if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
        $pid = $this->input->get('pid');
        $data['pid'] = $pid;
        $stock = $this->Back->getonestock($pid);
        $data['pname'] = $stock['pname'];
        $data['num'] = $stock['stock_num'];
        $this->load->view('deletestock',$data);
    }
    function addstock(){
        $this->load->model('Back');
        if(isset($_SESSION['name'])) $data['name'] = $_SESSION['name'];
        $pid = $this->input->get('pid');
        $data['pid'] = $pid;
        $stock = $this->Back->getonestock($pid);
        $data['pname'] = $stock['pname'];
        $this->load->view('addstock',$data);
    }
    function stockminus(){
        $this->load->model('Back');
        $pid = $this->input->post('pid');
        $num = $this->input->post('num');
        $this->Back->Stockminus($pid,$num);
        header("location: /admin/stock");
    }
    function stockadd(){
        $this->load->model('Back');
        $pid = $this->input->post('pid');
        $num = 0-$this->input->post('num');
        $this->Back->Stockminus($pid,$num);
        header("location: /admin/stock");
    }
    function out(){
        $this->load->model('Back');
        $this->load->model('Front');
        $sid = $this->input->post('sid');
        $this->Back->out($sid);
        $detail = $this->Front->findCarDetail($sid);
        foreach ($detail as $tmp) {
            $this->Back->Stockminus($tmp['productID'],$tmp['num']);
        }
        echo "success";
    }
    function finish(){
        $this->load->model('Back');
        $this->load->model('Front');
        $sid = $this->input->post('sid');
        $this->Back->finish($sid);
        echo "success";
    }
}