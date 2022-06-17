<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Services_model extends MY_Model
{
	public $table = "services s";
	public $select_column = ['s.id', 's.name', 's.image'];
	public $search_column = ['s.name'];
    public $order_column = [null, 's.name', null];
	public $order = ['s.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('s.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('s.id')
		         ->from($this->table)
				 ->where('s.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}