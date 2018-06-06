<?php 

class Front extends CI_Model {
    function __construct()
    {
        // 呼叫模型(Model)的建構子
        $this->load->database();
        parent::__construct();
    }
    function getClass()
    {
        //$this->db->select('className');
        $query = $this->db->get('class');
        return $query->result_array();
    }
    function getClassProduct($classID,$page)
    {
        $this->db->where('class', $classID);
        $query = $this->db->get('product',15,($page-1)*15);
        return $query->result_array();
    }
    function getAllClassProduct($classID)
    {
        $this->db->where('class', $classID);
        $query = $this->db->get('product');
        return $query->num_rows();
    }
    function getProduct($pid){
         $this->db->where('pid', $pid);
         $query = $this->db->get('product');
         return $query->row_array();
    }
    function getRandomproduct(){
        $this->db->order_by('rand()');
        $this->db->limit(15);
        $query = $this->db->get('product');
        return $query->result_array();
    }
    function getmoreclass($uid){//統計哪個種類最多
        $orderlist = $this->getorderlist($uid);
        $class = $this->getClass();
        for($x=0;$x<count($class);$x++){
            $class[$x]['count'] = 0;
        }
        foreach ($orderlist as $tmp) {
           $detail =  $this->findCarDetail($tmp['sid']);
           foreach ($detail as $order) {
              $product = $this->getProduct($order['productID']);
              for($x=0;$x<count($class);$x++){
                   if($product['class']==$class[$x]['classID'])
                        $class[$x]['count']++ ;
              }
           }
        }
        return $class;
    }
    function personproduct($class,$uid){
        $max = 0;
        $maxsecond = 0;
        $secondid =0;
        for($x=0;$x<count($class);$x++){
            if($class[$x]['count']>$max){
                $max = $class[$x]['count'];
                $cid = $class[$x]['classID'];
            }
        }
        for($x=0;$x<count($class);$x++){
            if($class[$x]['count']>$maxsecond && $class[$x]['count']!=$max){
                $maxsecond = $class[$x]['count'];
                $secondid = $class[$x]['classID'];
            }
        }
        $orderlist = $this->getorderlist($uid);
        $pid =array();
        $ocount = count($orderlist);
        for($y=0;$y<$ocount;$y++){
           $detail =  $this->findCarDetail($orderlist[$y]['sid']);
           $count = count($detail);
           for($x=0;$x<$count;$x++){
                array_push($pid,$detail[$x]['productID']);
           }
        }
        $count = count($pid);
        for($x=0;$x<$count;$x++){
            $this->db->where('pid!=', $pid[$x]);
        }
        $this->db->where('class', $cid);
        if($secondid !=0) $this->db->or_where('class', $secondid);
        $this->db->order_by('rand()');
        if($secondid !=0)$this->db->limit(15);
        else $this->db->limit(9);
        $this->db->from('product');
        $query = $this->db->get();
        $product = $query->result_array();
        if($secondid ==0){
            for($x=0;$x<$count;$x++){
                $this->db->where('pid!=', $pid[$x]);
            }
            $this->db->order_by('rand()');
            $this->db->limit(6);
            $this->db->from('product');
            $query = $this->db->get();
            $add = $query->result_array();
            foreach($add as $tmp){
                array_push($product,$tmp);
            }
        }
        return $product;
    }
    function findCar($uid){
        $this->db->where('memberID', $uid);
        $this->db->where('status', 0);
        $query = $this->db->get('orderlist');
        if($query->num_rows()==0)return false;
        else return $query->row_array();
    }
    function findCarDetail($sid){
        $this->db->where('sid', $sid);
        $query = $this->db->get('orderdetail');
        return $query->result_array();
    }
    function getorderlist($uid){
        $this->db->where('memberID', $uid);
        $this->db->where('status!=', 0);
        $query = $this->db->get('orderlist');
        return $query->result_array();
    }
    function getorderlistNum($uid){
        $this->db->where('memberID', $uid);
        $this->db->where('status!=', 0);
        $query = $this->db->get('orderlist');
        return $query->num_rows();
    }
    function getnotendorderlist($uid){
        $this->db->where('memberID', $uid);
        $this->db->where('status!=', 0);
        $this->db->where('status!=', 3);
        $query = $this->db->get('orderlist');
        return $query->result_array();
    }
    function getstatus($status){
        $this->db->where('statusID', $status);
        $query = $this->db->get('status');
        $query = $query->row_array();
        return $query['staName'];
    }
     function CarDetailCount($sid){
        $this->db->where('sid', $sid);
        $query = $this->db->get('orderdetail');
        return $query->num_rows();
    }
    function newCar($uid,$productID){
      $data = array(
		   'memberID ' => $uid,
		   'date' => date('Y-m-d H:i:s'),	
		);
        $this->db->insert('orderlist',$data);
		$sid = $this->db->insert_id();
        $this->newdetail($sid,$productID);
    }
     function membernewCar($uid){
      $data = array(
		   'memberID ' => $uid,
		   'date' => date('Y-m-d H:i:s'),	
		);
        $this->db->insert('orderlist',$data);
		return $this->db->insert_id();
    }
    function newdetail($sid,$productID){
         $data = array(
		   'sid' => $sid,
		   'productID' => $productID,
		   'num'=>1
		);
        $this->db->insert('orderdetail',$data);
    }
    function updatedetail($sid,$productID,$num,$price){
        $data = array(
               'num' => $num,
               'price' => $price
            );
        $this->db->where('sid', $sid);
        $this->db->where('productID', $productID);
        $this->db->update('orderdetail', $data); 
    }
    function updatelist($sid,$total){
         $data = array(
               'total' => $total,
               'ordernum' => date('YmdHis')
            );
        $this->db->where('sid', $sid);
        $this->db->update('orderlist', $data);
    }
    function updatelistInfo($sid,$sendpeople,$address,$sendate){
         $data = array(
               'sendate' => $sendate,
               'sendpeople' =>$sendpeople,
               'address'=>$address,
               'status' => 1,
            );
        $this->db->where('sid', $sid);
        $this->db->update('orderlist', $data);
    }
}
?>