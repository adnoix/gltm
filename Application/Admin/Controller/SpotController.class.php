<?php
namespace Admin\Controller;

use Think\Controller;

class SpotController extends CommonController
{

    /*
     * 景点列表
     * author Fan
     * date 2016-07-04
     * */
    public function spotList(){
        $spotObj = M('spot');

        if(!empty($_REQUEST['spot_name'])){
            $spotWhere['gltm_spot.spot_name'] = array("like","%".$_REQUEST['spot_name']."%");   //查询条件
            $spotPage['spot_name'] = $_REQUEST['spot_name'];
            $this -> assign("spot_name",$_REQUEST['spot_name']);
        }

        $goodsCount = $spotObj ->where($spotWhere)-> count();
        $Page       = new \Think\Page($goodsCount, 25,$spotPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $spotFiend = array(
            "spot_id"      => "spot_id",   //id
            "spot_name"    => "name",      //景区名称
            "spot_level"   => "level",    //景区等级
            "spot_price"   => "price",    //价格
            "spot_limit"   => "limit",    //预警值
            "spot_recommend"=> "recommend", //是否推荐
            "spot_address"      => "address",      //景点电话
        );

        $spotList = $spotObj ->field($spotFiend)->where($spotWhere)-> limit($Page->firstRow.','.$Page->listRows) -> select();

        $this ->page = $show;
        $this -> assign("spot",$spotList);
        $this ->display();
    }




    /*
     * 添加景点
     * author Fan
     * date 2016-07-04
     * */
    public function spotadd(){
        if(!$_POST){
            //地区
            $areaObj = M("area");
            $areaWhere['area_sort'] = 0;
            $areaResult = $areaObj ->where($areaWhere) ->select();
            $this ->area = $areaResult;

            //景区
            $scenicareaObj = M('scenicarea');
            $scenicareaResult = $scenicareaObj ->select();
            $this ->scenicarea = $scenicareaResult;

            $this ->display();
        }else{
            $data['spot_name']          = $_REQUEST['name'];         //景点名称
            $data['spot_level']         = $_REQUEST['level'];        //景点等级
            $data['spot_price']         = $_REQUEST['price'];        //门票价格
            $data['spot_limit']         = $_REQUEST['limit'];        //人数预警值
            $data['spot_recommend']    = $_REQUEST['recommend'];   //是否推荐
            $data['spot_advise_time']  = $_REQUEST['time'];         // 建议游玩时间
            $data['spot_culture']       = $_REQUEST['culture'];     //风情文化
            $data['spot_introduce']     = $_REQUEST['introduce'];   //景点简介
            $data['spot_tel']            = $_REQUEST['tel'];          //景点电话
            $data['spot_address']       = $_REQUEST['address'];     //景点地址
            $data['spot_longitude']     = $_REQUEST['longitude'];   //经度
            $data['spot_latitude']      = $_REQUEST['latitude'];     //纬度
            $data['spot_favorite']      = 0;                          //收藏数量
            $data['spot_comment']       = 0;                         //评论数量
            $data['spot_modify_user']   = $_SESSION['A_NAME'];      //操作人
            $data['spot_area_id']        = $_REQUEST['area'];       //地区id
            $data['spot_modify_ip']     = get_client_ip();           //ip地址
            $data['spot_ctime']          = time();                   //创建时间

            //添加景点图片
            $imgfile = $_FILES['img']["name"];    //获取临时文件名
            $imgtype = substr(strrchr($imgfile, '.'), 1); //获取文件类型
            $imgname = time('YmdHis').rand(10,100); //图片重命名
            move_uploaded_file($_FILES["img"]["tmp_name"],"./Uploads/spot/" .$imgname.'.'.$imgtype);  //保存图片
            $data['spot_img'] = "spot/".$imgname.'.'.$imgtype;

            $spotObj = M('spot');

            $spotResult = $spotObj ->add($data);

        if($spotResult){
            $this -> success("添加成功");
        }else{
            $this -> error("添加失败");
        }
        }
    }

    /*
     * 修改景点
     * author Fan
     *
     * */
    public function spotEdit(){

    }


    /*
     * 删除景点
     * author Fan
     *date 2016-07-04
     * */
    public function spotDel(){
        $spotWhere['spot_id'] = $_REQUEST['spot_id'];
        $spotObj = M('spot');
        $spotResult = $spotObj ->where($spotWhere) ->field("spot_img") ->find();
        
    }

    /*
     * 添加景点图片
     * author fan
     * date 2016-07-04
     * */
    public function spotImg_add(){
        //通过id查询景点的信息
        $spotWhere['spot_id'] = $_REQUEST['spot_id'];
        $spotObj = M('spot');
        $spotResult = $spotObj ->where($spotWhere) ->find();


        if(!$_POST){
            $this -> name = $spotResult;
            $this ->display();
        }else{

            $data['spot_img_sid']         = $_REQUEST['name'];     //景点id
            $data['spot_img_detail']     = $_REQUEST['detail'];    //景点详情
            $data['spot_img_season']     = $_REQUEST['season'];    //季节
            $data['spot_img_modify_user'] = $_SESSION['A_NAME'];   // 修改人
            $data['spot_img_modify_ip']   = get_client_ip();         //ip地址
            $data['spot_img_ctime']       = time();                  //创建时间

            //添加景点图片
            $imgfile = $_FILES['img']["name"];    //获取临时文件名
            $imgtype = substr(strrchr($imgfile, '.'), 1); //获取文件类型
            $imgname = time('YmdHis').rand(10,100); //图片重命名
            move_uploaded_file($_FILES["img"]["tmp_name"],"./Uploads/spot/" .$imgname.'.'.$imgtype);  //保存图片
            $data['spot_img_src'] = "spot/".$imgname.'.'.$imgtype;

            $spot_imgObj = M('spot_img');

            $spot_imgResult = $spot_imgObj ->add($data);

            if($spot_imgResult){
                $this -> success("添加成功",U("Spot/spotList"));
            }else{
                $this -> error("添加失败",U("Spot/spotList"));
            }
        }
    }

    /*
     * 景点图片列表
     * author fan
     * date 2016-07-04
     * */
    public function spotImg_list(){
        $spot_imgObj = M('spot_img');

        if(!empty($_REQUEST['spot_name'])){
            $spotWhere['spot.spot_name'] = array("like","%".$_REQUEST['spot_name']."%");   //查询条件
            $spotPage['spot_name'] = $_REQUEST['spot_name'];
            $this -> assign("spot_name",$_REQUEST['spot_name']);
        }

        $goodsCount = $spot_imgObj ->where($spotWhere) ->join("left join gltm_spot spot on spot.spot_id = gltm_spot_img.spot_img_sid ")-> count();
        $Page       = new \Think\Page($goodsCount, 25,$spotPage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $spot_imgFiend = array(
            "spot.spot_id"                    => "spot_id",     //景区id
            "spot.spot_name"                  => "name",         //景区名称
            "gltm_spot_img.spot_img_id"     => "img_id",       //景区图片id，
            "gltm_spot_img.spot_img_src"    => "img_src",      //图片
            "gltm_spot_img.spot_img_detail" => "img_detail",  //图片描述
            "gltm_spot_img.spot_img_season" => "img_season"   //季节
        );

        $spot_imgList = $spot_imgObj ->field($spot_imgFiend)->where($spotWhere)
            ->join("left join gltm_spot spot on spot.spot_id = gltm_spot_img.spot_img_sid ")
            -> limit($Page->firstRow.','.$Page->listRows) ->order("spot.spot_id") -> select();

        $this ->page = $show;
        $this -> assign("spot",$spot_imgList);
        $this->display();
    }

    /*
     * 景区图片修改
     * author Fan
     * date 2016-07-04
     * */
    public function spotImg_Edit(){
        $imgWhere['gltm_spot_img.spot_img_id'] = $_REQUEST['img_id'];
        $spot_imgObj = M('spot_img');
        $spot_imgFiend = array(
            "spot.spot_id"                    => "spot_id",     //景区id
            "spot.spot_name"                  => "name",         //景区名称
            "gltm_spot_img.spot_img_id"     => "img_id",       //景区图片id，
            "gltm_spot_img.spot_img_src"    => "img_src",      //图片
            "gltm_spot_img.spot_img_detail" => "img_detail",  //图片描述
            "gltm_spot_img.spot_img_season" => "img_season"   //季节
        );
        $spot_imgList = $spot_imgObj ->field($spot_imgFiend) ->where($imgWhere)
            ->join("left join gltm_spot spot on spot.spot_id = gltm_spot_img.spot_img_sid ") -> find();

        if(!$_POST){
            $this ->img_id  = $_REQUEST['img_id'];
            $this ->spotImg = $spot_imgList;
            $this ->display();
        }else{
            $data['spot_img_sid']         = $_REQUEST['name'];     //景点id
            $data['spot_img_detail']     = $_REQUEST['detail'];    //景点详情
            $data['spot_img_season']     = $_REQUEST['season'];    //季节
            $data['spot_img_modify_user'] = $_SESSION['A_NAME'];   // 修改人
            $data['spot_img_modify_ip']   = get_client_ip();         //ip地址
            $data['spot_img_ctime']       = time();                  //创建时间

            if(empty($_FILES['img']["name"])){
                $data['spot_img_src'] = $spot_imgList['img_src'];
            }else{
                unlink("./Uploads/".$spot_imgList['img_src']);  //删除原来的图片
                //添加景点图片
                $imgfile = $_FILES['img']["name"];    //获取临时文件名
                $imgtype = substr(strrchr($imgfile, '.'), 1); //获取文件类型
                $imgname = time('YmdHis').rand(10,100); //图片重命名
                move_uploaded_file($_FILES["img"]["tmp_name"],"./Uploads/spot/" .$imgname.'.'.$imgtype);  //保存图片
                $data['spot_img_src'] = "spot/".$imgname.'.'.$imgtype;
            }
            $spot_imgObj = M('spot_img');

            $spot_imgResult = $spot_imgObj ->where($imgWhere) ->save($data);

            if($spot_imgResult){
                $this -> success("修改成功",U("Spot/spotImg_list"));
            }else{
                $this -> error("修改失败",U("Spot/spotImg_list"));
            }

        }
    }


    /*
     * 景区图片删除
     * author Fan
     * date 2016-07-04
     * */
    public function spotImg_Del(){
        $imgWhere['gltm_spot_img.spot_img_id'] = $_REQUEST['img_id'];
        $spot_imgObj = M('spot_img');

        $spotImgShow = $spot_imgObj -> where($imgWhere) ->field("spot_img_src") ->find();
        unlink("./Uploads/".$spotImgShow['spot_img_src']);  //删除原来的图片

        $spotImg_Result = $spot_imgObj ->where($imgWhere) ->delete();

        if($spotImg_Result){
            $this -> success("删除成功",U("Spot/spotImg_list"));
        }else{
            $this -> error("删除失败",U("Spot/spotImg_list"));
        }
    }
}