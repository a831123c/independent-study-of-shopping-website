<?php 

class Back extends CI_Model {
    function __construct()
    {
        // 呼叫模型(Model)的建構子
        $this->load->database();
        parent::__construct();
    }
    function getOrderlist($page,$status){
        $this->db->where('status', $status);
        $this->db->order_by("sendate", "aesc");
        $query = $this->db->get('orderlist',20,($page-1)*20);
        return $query->result_array();
    }
    function Stockminus($pid,$num){
        $this->db->where('pid', $pid);
        $query = $this->db->get('stock');
        $query = $query->row_array();
        $stocknum = $query['stock_num'];
        $stocknum = $stocknum - $num;
        $data = array(
               'stock_num' => $stocknum,
            );
        $this->db->where('pid', $pid);
        $this->db->update('stock', $data);
    }
    function getstock($page){
        $this->db->from('stock');
        $this->db->join('product','stock.pid = product.pid');
        $query = $this->db->get('',20,($page-1)*20);
        return $query->result_array();
    }
    function getstockNum(){
        $this->db->from('stock');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getonestock($pid){
        $this->db->from('stock');
        $this->db->join('product','stock.pid = product.pid');
        $this->db->where('stock.pid', $pid);
        $query = $this->db->get();
        return $query->row_array();
    }
    function out($sid){
         $data = array(
               'status' => 2,
            );
        $this->db->where('sid', $sid);
        $this->db->update('orderlist', $data);
    }
     function finish($sid){
         $data = array(
               'status' => 3,
            );
        $this->db->where('sid', $sid);
        $this->db->update('orderlist', $data);
    }
}
?>