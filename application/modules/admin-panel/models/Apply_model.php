<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Apply_model extends MY_Model
{
	public $table = "job_apply a";
	public $select_column = ['a.id', 'a.name', 'a.phone', 'a.email', 'c.c_title'];
	public $search_column = ['a.name', 'a.phone', 'a.email', 'c.c_title'];
    public $order_column = [null, 'a.name', 'a.phone', 'a.email', 'c.c_title', null];
	public $order = ['a.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('a.is_deleted', 0)
				 ->join('careers c', 'a.job_id = c.id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('a.id')
		         ->from($this->table)
				 ->where('a.is_deleted', 0)
				 ->join('careers c', 'a.job_id = c.id');
		            	
		return $this->db->get()->num_rows();
	}

	public function get($table, $select, $where)
	{
		$this->db->select($select)
		         ->from($table)
				 ->where($where)
				 ->join('careers c', 'a.job_id = c.id');

		return $this->db->get()->row_array();
	}
}