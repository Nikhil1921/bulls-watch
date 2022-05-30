<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Career_model extends MY_Model
{
	public $table = "careers c";
	public $select_column = ['c.id', 'c.c_title', 'c.eligibility', 'c.height', 'c.documents'];
	public $search_column = ['c.c_title', 'c.eligibility', 'c.height', 'c.documents'];
    public $order_column = [null, 'c.c_title', 'c.eligibility', 'c.height', 'c.documents', null];
	public $order = ['c.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('c.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('c.id')
		         ->from($this->table)
				 ->where('c.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}