<?php 

/**无限极分类 */
function infinite($data,$parent_id=0,$level=0){
    if(!$data){
        return;
    }
    static $newArray = [];
    foreach($data as $k=>$v){
        if($v->parent_id==$parent_id){
            $v->level = $level;
            $newArray []= $v;
            $child=infinite($data,$v->cat_id,$level+1);
            $v['child']=$child;
        }
    }
    return $newArray;
}










