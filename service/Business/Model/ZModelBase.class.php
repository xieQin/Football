<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZModelBase
 * 中文
 * @author zq
 */
class ZModelBase {

    //put your code here
    private $m;
    private $tableName;

    function __construct($tableParam) {
        $this->m = M($tableParam);
        $this->tableName = $tableParam;
    }

    public function getModel() {
        return $this->m;
    }

    public function add($arrayParams) {
        if (!is_array($arrayParams))
            return 0;
        return $this->m->add($arrayParams);
    }

    public function delete($condition, $params) {
        if (empty($condition))
            return null;
        return $this->m->where($condition, $params)->delete();
    }

    /**
     * get
     * @param array $condition
     * @return null
     */
    public function get($condition, $params, $data) {
        if (empty($condition)) {
            return $this->m->where("1=1", null)->find($data);
        } else {
            return $this->m->where($condition, $params)->find($data);
        }
    }

    public function logicDelete($condition, $params) {
        $entity = array("IsValid" => "0");
        if ($this->m->where($condition, $params)->update($entity)) {
            return TRUE;
        }
        else
            return FALSE;
    }

    public function update($condition, $params, $data) {
        if (empty($condition) || !is_array($params))
            return null;
        return $this->m->where($condition, $params)->update($data);
    }

    public function getList($condition, $params, $data, $limit = null, $order = null) {

        if (empty($condition)) {
            return $this->m->where("1=1", null)->order(!empty($order) ? (" " . $order . " ") : $order)->limit(!empty($limit) ? (" " . $limit . " ") : $limit)->select($data);
        } else {
            return $this->m->where($condition, $params)->order(!empty($order) ? (" " . $order . " ") : $order)->limit(!empty($limit) ? (" " . $limit . " ") : $limit)->select($data);
        }
    }

    public function getCount($condition, $params) {

        if (empty($condition)) {
            $res_count = $this->m->where("1=1", null)->select(" count(0) as c ");
        } else {
            $res_count = $this->m->where($condition, $params)->find(" count(0) as c ");
        }
        $c = isset($res_count) ? $res_count["c"] : 0;
        return $c;
    }

    public function executeSql($sql) {
        $db = D();
        return $rt = $db->query($sql);
    }

}

?>