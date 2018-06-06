<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shopping extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this -> load -> library('session');
        // Your own constructor code
    }
	public function index(){
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		$data['product'] = $this->Front->getRandomproduct();
		if($this -> session -> userdata('uID')){
			$uid = $this -> session -> userdata('uID');
			$data['name'] = $this -> session -> userdata('name');
			if($this->Front->getorderlistNum($uid)!=0){
				$class = $this->Front->getmoreclass($uid);
				$data['product'] = $this->Front->personproduct($class,$uid);
			}
		}
		$this->load->view('first',$data);	
		//$this->load->view('first');
	}
	public function login()
	{
		if($this->input->get('wrong')) $data['wrong'] = $this->input->get('wrong'); 
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		$this->load->view('login',$data);
		$this -> session -> unset_userdata('tuID');//清除快取
		$this -> session -> unset_userdata('pid');
		$this -> session -> unset_userdata('num');
	}
	public function register()
	{
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		$this->load->view('register',$data);
	}
	public function check_member()
	{
		$account = $this->input->post('account');
		$password = $this->input->post('password');
		$this->load->database();
		$this->db->where('account', $account); 
		$this->db->where('password', $password); 
		$query = $this->db->get('member');
		if($query->num_rows() == 1){
			$member = $query->result_array();
			$user = array(
					'uID' => $member[0]['mid'],
					'name'=> $member[0]['mname']
					);
			$this -> session -> set_userdata($user);
			//redirect('index', 'refresh');
			header("location: /shopping/index");
		}
		else{
			header("location: /shopping/login?wrong=1");
		} 

	}
	function logout(){
		 $this -> session -> unset_userdata('uID');
		 //redirect('index', 'refresh');
		 header("location: /shopping/index");
	}
	public function Toregist()
	{
		$this->load->model('Front');
		$account = $this->input->post('account');
		$password = $this->input->post('password');
		$name = $this->input->post('mname');
		$tel = $this->input->post('mtel');
		$mail = $this->input->post('mail');
		$address = $this->input->post('maddress');
		$this->load->database();
	    $data = array(
		   'account' => $account,
		   'password' => $password,
		   'mname' => $name,
		   'mtel' => $tel,
		   'mail' => $mail,
		   'maddress' => $address	
		);
		$this->db->insert('member',$data);
		$uID = $this->db->insert_id();	
		$user = array(
					'uID' => $uID,
					'name'=> $name
					);
		$this -> session -> set_userdata($user);
		if($this -> session -> userdata('tuID')){//若有購物車快取
			$pidarray = $this -> session -> userdata('pid');
			$sid = $this->Front->membernewCar($uID);
			for($x=0; $x < count($pidarray);$x++){
				$product = $this->Front->newdetail($sid,$pidarray[$x]);
			}//把快取與數量寫進資料庫
			 $this -> session -> unset_userdata('tuID');//清除快取
			 $this -> session -> unset_userdata('pid');
			 $this -> session -> unset_userdata('num');
			 header("location: /shopping/car");
		}
		//redirect('/shopping/index', 'refresh');
		else header("location: /shopping/index");
	}
	function cla(){
		if($this -> session -> userdata('uID')){
			$data['name'] = $this -> session -> userdata('name');
		}
		$this->load->model('Front');
		$page = $this->input->get('page');
		$data['page'] = $page;
		$data['class'] = $this->Front->getClass();
		$classID = $this->input->get('classID');
		$tmp = $this->Front->getAllClassProduct($classID);
		//計算總頁數
		if($tmp%15==0) $data['totalpage'] = $tmp/15;
		else $data['totalpage'] = intval($tmp/15) +1;
		$data['classID'] = $classID;
		$data['product'] = $this->Front->getClassProduct($classID,$page);
		//取出六樣商品
		$this->load->view('product',$data);
	}
	function product(){
		if($this -> session -> userdata('uID')){
			$data['name'] = $this -> session -> userdata('name');
		}
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		$pid = $this->uri->segment(3);
		$data['pid'] = $pid;
		$data['product'] =  $this->Front->getProduct($pid);
		$this->load->view('productinfo',$data);
	}
	function addCar(){
		//$this -> session -> unset_userdata('tuID');
		$pid = $this->input->post('pid');
		if($this -> session -> userdata('uID')){//會員
			$this->load->model('Front');
			$uID = $this -> session -> userdata('uID');
			$car = $this->Front->findCar($uID);		
			if($car){//有購物車
				$sid = $car['sid'];
				$detail = $this->Front->findCarDetail($sid);
				foreach ($detail as $tmp) {
					if($pid == $tmp['productID']){
						echo "此商品在購物車已存在";
						return;
					}
				}
				$this->Front->newdetail($sid,$pid); 
				echo"成功加入購物車";
			}
			else{//沒購物車
				$this->Front->newCar($uID,$pid);
				echo"成功加入購物車";
			} 
		}
		else {//非會員
			if($this -> session -> userdata('tuID')){//有建購物車 檢查商品
				$pidarray = $this -> session -> userdata('pid');
				$numarray = $this -> session -> userdata('number');
				for($x=0; $x < count($pidarray);$x++){
					if($pid == $pidarray[$x]){
						echo "此商品在購物車已存在";
						return;
					}
				}
				array_push($pidarray,$pid);
				array_push($numarray,1);
				$this->session->set_userdata('pid', $pidarray);
				$this->session->set_userdata('number', $numarray);
				echo"成功加入購物車";
			}
			else{//如果沒有建立購物車 建一個
				$tuser = array(
				'tuID' => date('Ymd'),
				'pid'=> array($pid),
				'number'=>array(1),
				);
				$this -> session -> set_userdata($tuser);
				echo"成功加入購物車";
			}
		}
	}
	function car(){
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		$data['total'] = 0;
		if($this -> session -> userdata('uID')){//會員
			$uID = $this -> session -> userdata('uID');
			$data['uid'] = $uID; 
			$data['name'] = $this -> session -> userdata('name');
			$car = $this->Front->findCar($uID);
			$data['car'] = $car;
			if($car){
				$pname=array();
				$money=array();
				$detail = $this->Front->findCarDetail($car['sid']);
				$data['count'] = $this->Front->CarDetailCount($car['sid']);
				foreach ($detail as $tmp) {
					$pid = $this->Front->getProduct($tmp['productID']);
					array_push($pname,$pid['pname']);
					array_push($money,$pid['money']);  
				}			
				$data['detail'] = $detail;
				$data['pname'] = $pname;
				$data['money'] = $money;
			}
			$this->load->view('membercar',$data);
		}
		else{//非會員
			$pidarray = $this -> session -> userdata('pid');
			$data['count'] = count($pidarray);
			for($x=0; $x < count($pidarray);$x++){
				$product = $this->Front->getProduct($pidarray[$x]);
				$pidarray[$x] = $product;
			}
			$data['pid'] = $pidarray;
			$data['num'] = $this -> session -> userdata('number');
			$this->load->view('nonmember',$data);
		} 
	}
	function remove(){
		$this->load->database();
		$pid = $this->input->get('pid');
		$sid = $this->input->get('sid');
		$this->db->where('sid', $sid);
        $this->db->where('productID', $pid);
        $this->db->delete('orderdetail'); 
		header("location: /shopping/car");
	}
	function purchase(){
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		if($this -> session -> userdata('uID')){
			$data['name'] = $this -> session -> userdata('name');
		}
		$count = $this->input->post('count');
		$sid = $this->input->post('sid');
		$total = 0;
		for($x=0; $x<$count ;$x++){
			$pid = $this->input->post('pid'.$x);
			$num = $this->input->post('num'.$x);
			$price = $this->input->post('total'.$x);
			$total += $price;
			$this->Front->updatedetail($sid,$pid,$num,$price);
		}
		$this->Front->updatelist($sid,$total);
		$data['sid'] = $sid;
		$data['total'] = $total;
		$detail = $this->Front->findCarDetail($sid);
		$x=0;
		foreach ($detail as $tmp) {
			$product = $this->Front->getProduct($tmp['productID']);
			$detail[$x]['pname'] = $product['pname'];
			$detail[$x]['money'] = $product['money'];
			$detail[$x]['image'] = $product['image'];
			$x++;
		}
		$data['detail'] = $detail;
		$this->load->view('confirm',$data);
	}
	function sendinfo(){
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		if($this -> session -> userdata('uID')){
			$data['name'] = $this -> session -> userdata('name');
			$data['uid'] = $this -> session -> userdata('uID');
		}
		$sid = $this->input->post('sid');
		$data['sid'] = $sid;
		$this->load->view('sendinfo',$data);
	}
	function info(){
		$sid = $this->input->post('sid');
		$people = $this->input->post('people');
		$address = $this->input->post('address');
		$date = $this->input->post('date');
		$this->load->model('Front');
		$this->Front->updatelistInfo($sid,$people,$address,$date);
		header("location: /shopping/orderlist");
	}
	function orderlist(){
		$this->load->model('Front');
		$data['class'] = $this->Front->getClass();
		if($this -> session -> userdata('uID')){
			$uid = $this -> session -> userdata('uID');
			$data['name'] = $this -> session -> userdata('name');
		}
		$list = $this->Front->getnotendorderlist($uid);
		if($list!=null){
			$x=0;
			foreach($list as $tmp){
				$list[$x]['status'] = $this->Front->getstatus($tmp['status']);
				$x++;
			}
			$data['list'] = $list;
		}
		$this->load->view('orderlist',$data);	
	}
	function getmember(){
		$this->load->database();
		$uid = $this->input->post('uid');
		$this->db->where('mid', $uid);
		$query = $this->db->get('member');
		$member = $query->row_array(); 
		echo $member['mname'];
	}
	function getmemberaddr(){
		$this->load->database();
		$uid = $this->input->post('uid');
		$this->db->where('mid', $uid);
		$query = $this->db->get('member');
		$member = $query->row_array(); 
		echo $member['maddress'];
	}
	function orderdetail(){
		$this->load->model('Front');
		$sid = $this->input->post('sid');
		$detail = $this->Front->findCarDetail($sid);
		$count = $this->Front->CarDetailCount($sid);
		$x=0;
		foreach ($detail as $tmp) {
			$product = $this->Front->getProduct($tmp['productID']);
			$detail[$x]['pname'] = $product['pname'];
			$detail[$x]['money'] = $product['money'];
			$x++;
		}
		$detail['count'] = $count;
		echo json_encode($detail);
	}
	
}
