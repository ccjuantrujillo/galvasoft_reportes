<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Periodo de creación de las OT,OI,CC en forma general.
 * 09        OI año 2009
 * 10        OT año 2010
 * 11        OI año 2010
 * 12        OT año 2011 
 * 13        OI año 2011
 * 14        OT año 2012
 */
class Tipoot_model extends CI_Model{
    var $table;
    var $entidad;
    public function __construct(){
        parent::__construct();
        $this->entidad = $this->session->userdata('entidad');
        $this->table   = "tabla_m_detalle";
    }

    public function seleccionar($default="",$value=''){
        $nombre_defecto = $default==""?":: Seleccione ::":$default;
        $arreglo = array($value=>$nombre_defecto);
        $filter  = new stdClass();
        foreach($this->listar($filter) as $indice=>$valor)
        {
            $indice1   = $valor->cod_argumento;
            $valor1    = $valor->des_larga;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }      
    
    public function listar($filter, $number_items='',$offset='')
    {
        $where = array('CodEnt'=>$this->entidad,'Cod_Tabla'=>'TORD');     
        if(isset($filter->anio) && $filter->anio!='')            $where = array_merge($where,array("Valor_2"=>substr($filter->anio,2,2)));  
        if(isset($filter->tipo) && $filter->tipo!='')            $where = array_merge($where,array("Des_Corta"=>trim($filter->tipo)));  
        $this->db->select('cod_tabla,cod_argumento,valor_2,des_larga,Des_Corta');
        $this->db->from($this->table,$number_items,$offset);
        $this->db->where($where);
        $this->db->where_not_in('cod_argumento','01');
        $this->db->order_by('des_larga');
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>1)   $resultado = $query->result();
        if($query->num_rows==1)  $resultado = $query->row();
        return $resultado;            
    }
    
    public function obtener($codigo)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);
        $query = $this->db->where($where)->get($this->table);
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado;
    }
	
    public function insertar(stdClass $filter = null){
        $this->db->insert($this->table,(array)$filter);
    }
	
    public function modificar($codigo,$filter)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);
        $this->db->where($where);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($codigo)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);        
        $this->db->delete($this->table,array('CodEnt' => $id));
    }
}
?>