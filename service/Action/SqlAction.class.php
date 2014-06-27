<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexAction
 *
 * @author zq
 */
class SqlAction extends BaseAction {

    function sql(){
		$m = M("zj_football");
		$list = $m->where("1=1")->select();
		foreach($list as $obj){
			echo "insert into `zj_football`(`Mobile`,`CreateTime`,`Result`,`YY`,`ResultDetail`,`Name`) values ('".$obj['Mobile']."','".$obj['CreateTime']."','".$obj['Result']."','".$obj['YY']."','".$obj['ResultDetail']."','".$obj['Name']."');\n";
		}
	}

}

?>
