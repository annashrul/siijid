<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: anash
 * Date: 10/18/2018
 * Time: 1:04 AM
 */

class M_crud extends CI_Model{


    public function get_pengurus($where=null){
        $query = $this->m_crud->read_data("pengurus","nama_pengurus,id_pengurus", $where);
        return $query;
    }

    public function saldo_in($param){
        $sum = $this->m_crud->read_data("kas","sum(kas_in-kas_out) saldo");
        foreach($sum as $row){
            $saldo = $row["saldo"]+$param;
        }
        return $saldo;
    }

    public function log($aksi,$keterangan,$data){
        $data_log = array(
            "id_masjid"=>$this->session->id_masjid,
            "id_pengurus"=>$this->session->id_pengurus,
            "aksi"=>$aksi,
            "keterangan"=>$keterangan,
            "data"=>$data
        );
        $this->create_data("log",$data_log);
    }

    public function generate_kode($param, $id=null) {
        if ($param == 'zakat') {
            $id=date('ym',strtotime(date("ym")));
            $max_code = $this->m_crud->get_data("zakat", "RIGHT(MAX(kd_zakat), 5) max_code", "SUBSTR(kd_zakat, 2, 4)='".$id."'")['max_code'];
            return 'Z'.$id.sprintf('%05d', explode("-",$max_code)[0]+1);
        } elseif($param == 'kas') {
            $max_code = $this->m_crud->get_data("kas", "RIGHT(MAX(kd_kas), 5) max_code", "kd_kas like '%K%' and SUBSTR(kd_kas, 2, 4)='".$id."'")['max_code'];
            return 'K'.$id.sprintf('%05d', $max_code+1);
        } elseif($param == 'jadwal') {
            $max_code = $this->m_crud->get_data("jadwal", "RIGHT(MAX(kd_jadwal), 5) max_code", "SUBSTR(kd_jadwal, 2, 4)='".$id."'")['max_code'];
            return 'J'.$id.sprintf('%05d', $max_code+1);
        } elseif($param == 'project') {
            $max_code = $this->m_crud->get_data("project", "RIGHT(MAX(kd_project), 5) max_code", "SUBSTR(kd_project, 2, 4)='".$id."'")['max_code'];
            return 'P'.$id.sprintf('%05d', $max_code+1);
        } elseif($param == 'kas') {
            $max_code = $this->m_crud->get_data("project", "RIGHT(MAX(kd_kas), 5) max_code", "SUBSTR(kd_kas, 2, 4)='".$id."'")['max_code'];
            return "B".$id.sprintf('%05d', $max_code+1);
        } elseif($param == 'pemesanan') {
            $max_code = $this->m_crud->get_data("formulir_pemesanan", "RIGHT(MAX(kd_pemesan), 5) max_code", "SUBSTR(kd_pemesan, 2, 4)='".$id."'")['max_code'];
            return "A".$id.sprintf('%05d', $max_code+1);
        }
        else {
            return false;
        }
    }


    public function hitung_saldo($cond,$param){
        $sum = $this->m_crud->read_data("kas","sum(kas_in-kas_out) saldo");
        foreach($sum as $row){
            if($cond=="Kas-Masuk"){
                $saldo = $row["saldo"]+$param;
            }else{
                $saldo = $row["saldo"]-$param;
            }
        }
        return $saldo;
    }

	public function get_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0){
        $this->db->select($field);
        $this->db->from($table);
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
		if($data->num_rows()>0){
			foreach ($data->result_array() as $row);
			return $row;
		} else{
			return null;
		}
	}

	public function join_data($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){
			$i = 0;
			foreach($table_join as $row){
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i]);
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on);
		}
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
		if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		return $data->result_array();
	}
	public function count_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$col = explode('.', $field);
		if (count($col) > 1) {
			$alias = $col[1];
		} else {
			$alias = $field;
		}
		$this->db->select("COUNT(".$field.") AS ".$alias."");
		$this->db->from($table);
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
		if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		foreach ($data->result_array() as $row);
		return $row[$alias];
	}
	
	public function count_data_join($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$col = explode('.', $field);
		if (count($col) > 1) {
			$alias = $col[1];
		} else {
			$alias = $field;
		}
		$this->db->select("COUNT(".$field.") AS ".$alias."");
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){
			$i = 0;
			foreach($table_join as $row){
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i]);
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on);
		}
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
		if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		foreach ($data->result_array() as $row);
		return $row[$alias];
	}
	
	
	public function count_all($field, $table_join, $on, $table, $where = NULL, $order = NULL, $by = NULL){
		$this->db->select($field);
		$this->db->from($table);
		if (is_array($table_join) && is_array($on)) {
			$i = 0;
			foreach ($table_join as $row) {
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i], 'LEFT');
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on, 'LEFT');
		}
		$where != "" ? $this->db->where($where) : NULL;
		$order != "" ?  $this->db->order_by($order, $by) : NULL;
		// $limit != "" ?  $this->db->limit($limit, $start) : NULL;
		// $or_like != "" ?  $this->db->or_like($or_like, $search) : NULL;
		$query = $this->db->get();
		return $query;
	}
	public function get_join_data($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){
			$i = 0;
			foreach($table_join as $row){
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i]);
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on);
		}
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
		if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		
		if($data->num_rows()>0){
			foreach ($data->result_array() as $row);
			return $row;
		} else{
			return null;
		}
	}
	public function read_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
		if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		return $data->result_array();
	}
	public function search($field, $table_join, $on, $table, $where = NULL, $order = NULL, $by = NULL, $like=NULL,$or_like=NULL,$search=NULL){
		$this->db->select($field);
		$this->db->from($table);
		if (is_array($table_join) && is_array($on)) {
			$i = 0;
			foreach ($table_join as $row) {
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i], 'LEFT');
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on, 'LEFT');
		}
		$where != "" ? $this->db->where($where) : NULL;
		$order != "" ?  $this->db->order_by($order, $by) : NULL;
		$like != "" ?  $this->db->like($like, $search) : NULL;
		$or_like != "" ?  $this->db->or_like($or_like, $search) : NULL;
		$query = $this->db->get();
		return $query;
	}
    public function create_data($tabel, $data){
        $data = $this->db->insert($tabel, $data);
        return $data;
    }
//	function no_pemesanan(){
//		$id_masjid = $this->session->id_masjid;
//        $q = $this->db->query("SELECT masjid.*, MAX(RIGHT(no_pemesanan,4)) AS kd_max FROM masjid LEFT JOIN formulir_pemesanan ON masjid.id_masjid = formulir_pemesanan.id_masjid WHERE masjid.id_masjid='$id_masjid'");
//
//		$kd = "";
//		$no_masjid = "";
//		if($q->num_rows()>0){
//			foreach($q->result() as $k){
//				$no_masjid = $k->no_masjid;
//				$tmp = ((int)$k->kd_max)+1;
//				$kd = sprintf("%04s", $tmp);
//			}
//		}else{
//			$kd = "0001";
//		}
//		return "NOHWN".$no_masjid."-".$kd;
//
//	}
//	function no_kk(){
//		$id_masjid = $this->session->id_masjid;
//		$q = $this->db->query("SELECT masjid.*, MAX(RIGHT(no_jamaah,4)) AS kd_max FROM jamaah LEFT JOIN masjid ON masjid.id_masjid = jamaah.id_masjid WHERE masjid.id_masjid='$id_masjid'");
//		$kd = "";
//		$no_masjid = "";
//		if($q->num_rows()>0){
//			foreach($q->result() as $k){
//				$no_masjid = $k->no_masjid;
//				$tmp = ((int)$k->kd_max)+1;
//				$kd = sprintf("%04s", $tmp);
//			}
//		}else{
//			$kd = "0001";
//		}
//		return "NOKK".$no_masjid.$kd;
//		// var_dump("NOHWN".$kd);die();
//	}
//
	
	public function join($field, $table_join, $on, $table, $where = NULL, $group_by = NULL, $order = NULL, $by = NULL){
		$this->db->select($field);
		$this->db->from($table);
		if (is_array($table_join) && is_array($on)) {
			$i = 0;
			foreach ($table_join as $row) {
				if (is_array($row)) {
					$this->db->join($row['table'], $on[$i], $row['type']);
				} else {
					$this->db->join($row, $on[$i], 'LEFT');
				}
				$i++;
			}
		} else {
			$this->db->join($table_join, $on, 'LEFT');
		}
		$where != "" ? $this->db->where($where) : NULL;
		$group_by != "" ?  $this->db->group_by($group_by) : NULL;
		$order != "" ?  $this->db->order_by($order, $by) : NULL;
		$query = $this->db->get();
		return $query;
	}
	
	public function insert($table, $data){
		$query = $this->db->insert($table, $data);
		return $query ? TRUE : FALSE;
	}
	public function update_data($tabel, $data, $where){
		$data = $this->db->update($tabel, $data, $where);
		return $data;
	}
	public function delete_data($tabel, $where){
		$data = $this->db->delete($tabel, $where);
		return $data;
	}
	public function get($field,$table,$where=NULL,$group_by=NULL,$order=NULL,$by=NULL){
		$this->db->select($field);
		$this->db->from($table);
		$where != "" ? $this->db->where($where) : NULL;
		$group_by != "" ?  $this->db->group_by($group_by) : NULL;
		$order != "" ?  $this->db->order_by($order, $by) : NULL;
		$query = $this->db->get();
		return $query;
	}
	
	public function get_where($table, $where){
		$query = $this->db->get_where($table, $where);
		return $query;
	}
//	public function update($tabel, $data, $where){
//		$data = $this->db->update($tabel, $data, $where);
//		return $data;
//	}
	public function update($table, $data, $where){
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	
	public function delete($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
	}
}