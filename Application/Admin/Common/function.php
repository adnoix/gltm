<?php
    //权限控制操作
	function node_merge($node,$access = null,$pid = 0){

		$arr = array();

		foreach ($node as $v){
			if(is_array($access)){
				$v['access'] = in_array($v['id'],$access) ? 1:0;
			}
			if($v['pid'] == $pid){
				$v['child'] = node_merge($node, $access,$v['id']);
				$arr[] = $v;
			}
		}

		return $arr;
	}
	//递归设置操作权限
	function delno($node,$pid = 0){
		$arr = array();
		foreach($node as $v){
			if($v['pid'] == $pid){
				if(M('Node')->where('id='.$v['id'])->delete()){
				   $v['child'] = node_merge($node,$v['id']);
				}else
				  return false;
			}
		}
		return true;
	}
     //递归查询可控制查询的层数
	function getList($res,$mid,$fid,$id=0,$i,$j = 0){
        $result=array();
        if(!empty($res)){ 
           foreach($res as $v){
             if($v[$fid]==$id){
                if($j !=0){
                     if($i >= $j){
                        $v['ji']=$i;
                        $result[]=$v;
                        $result=array_merge($result,getList($res,$mid,$fid,$v[$mid],$i+1,$j));
                     }else{
                        getList($res,$mid,$fid,$v[$mid],$i+1,$j);
                     } 
                }else{
                     $v['ji']=$i;
                     $result[]=$v;
                     $result=array_merge($result,getList($res,$mid,$fid,$v[$mid],$i+1,$j)); 
                }
            }
           }     
        }
        return $result;
    }
     //递归查询可控制查询的层数
    $z='';
    function getLists($res,$mid,$fid,$id=0,$i,$j=0){
        if($j==0){
          Global $z;
          $z=$i;
        }
        $result=array();
        if(!empty($res)){ 
           foreach($res as $v){
             if($v[$fid]==$id){
                $v['ji']=$i;
                $result[]=$v;
                $result=array_merge($result,getList($res,$mid,$fid,$v[$mid],$i.$z));
            }
           }     
        }
        return $result;
    }
    //递归删除数据
    function delList($biao,$mid,$fid,$id){
       $res = M($biao)->select();
       //判断是否存在该列
            if(M($biao)->where($mid." = ".$id)->count()){
            //判断是否删除成功
               if(M($biao)->where($mid." = ".$id)->delete()){
                        foreach($res as $v){
                             if($v[$fid]==$id){
                               delList($biao,$mid,$fid,$v[$mid]);
                             }     
                        }
                }else
                   return false; 
            }
               
        return true;
    }

    //自定义p打印方法
    function p($array){
        dump($array, 1, '<pre>', 0);
    }
?>