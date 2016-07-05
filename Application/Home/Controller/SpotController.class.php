<?php
namespace Home\Controller;

use Think\Controller;
use Think;

class SpotController extends CommonController
{
    public $userid = "";

    public function _initialize()
    {
        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $this->userid = $uid;
        } else {
            $this->apiReturn('error', '接口认证失败');
        }
    }

    /**
     * 首页 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int page 第几页
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @param int  count 数量
     * @return array 状态+提示
     */
    public function spotlist()
    {
        $spotlist = M('spot');
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 0;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 0;
        $start = ($page - 1) * $count;
        $spot = $spotlist->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude')->order('spot_level desc')->limit($start, $count)->select();
        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            $val['spot_distance'] <= 1000 ? $val['spot_distance'] = $val['spot_distance'] . 'm' : $val['spot_distance'] = number_format($val['spot_distance'] / 1000, 2) . 'km';
        }
        if (empty($spot)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $spot);
        }
    }

    /**
     * 人气最高 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int page 第几页
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @param int  count
     * @return array 状态+提示
     */
    public function popularity_max()
    {
        $spotlist = M('spot');
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 0;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 0;
        $start = ($page - 1) * $count;
        $spot = $spotlist->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude,spot_limit,spot_comment,spot_address,spot_recommend')->order('spot_limit desc')->limit($start, $count)->select();
        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            $val['spot_distance'] <= 1000 ? $val['spot_distance'] = $val['spot_distance'] . 'm' : $val['spot_distance'] = number_format($val['spot_distance'] / 1000, 2) . 'km';
        }
        if (empty($spot)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $spot);
        }
    }

    /**
     * 距离最近 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int page 第几页
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @param int  count
     * @return array 状态+提示
     */
    public function distance_min()
    {
        $spotlist = M('spot');
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) - 1 : 0;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 0;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 0;
        $start = ($page - 1) * $count;
        $spot = $spotlist->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude,spot_limit,spot_comment,spot_address,spot_recommend')->order('spot_id asc')->select();
        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            unset($val['spot_latitude']);
            unset($val['spot_longitude']);
        }
        foreach ($spot as $key => $row) {
            $volume[$key] = $row['spot_distance'];
        }
        array_multisort($volume, SORT_ASC, $spot);
        $min = array();
        for ($i = $page; $i < $page + $count; $i++) {
            $spot[$i]['spot_distance'] <= 1000 ? $spot[$i]['spot_distance'] = $spot[$i]['spot_distance'] . 'm' : $spot[$i]['spot_distance'] = number_format($spot[$i]['spot_distance'] / 1000, 2) . 'km';
            $min[] = $spot[$i];
        }
        unset($spot);
        if (empty($min)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $min);
        }
    }

    /**
     * 景点详情 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int spot_id 景点id
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @return array 状态+提示
     */
    public function spot_detail()
    {
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 0;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 0;
        $spot = M('spot')->field('spot_id,spot_img,spot_name,spot_level,spot_advise_time,spot_address,spot_comment,spot_longitude,spot_latitude,spot_tel,spot_culture,spot_introduce')->where('spot_id =' . $spot_id)->select();
        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            $val['spot_distance'] <= 1000 ? $val['spot_distance'] = $val['spot_distance'] . 'm' : $val['spot_distance'] = number_format($val['spot_distance'] / 1000, 2) . 'km';
        }
        if (empty($spot)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $spot);
        }
    }
    /**
     * 景点图片 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int spot_id 景点id
     * @return array 状态+提示
     */
    public function spot_img()
    {
        $img=M('spot_img');
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $spring=$img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season=1')->order('spot_img_ctime desc')->limit(1)->select();
        $summer=$img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season=2')->order('spot_img_ctime desc')->limit(1)->select();
        $autumn=$img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season=3')->order('spot_img_ctime desc')->limit(1)->select();
        $winter=$img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season=4')->order('spot_img_ctime desc')->limit(1)->select();
        $imglist=array_merge($spring,$summer,$autumn,$winter);
        if (empty($imglist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $imglist);
        }
    }
    /**
     * 景点视频 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int spot_id 景点id
     * @return array 状态+提示
     */
    public function spot_video()
    {
        $video=M('spot_video');
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $spring=$video->field('spot_video_id,spot_video_sid,spot_video_src,spot_video_favorite,spot_video_detail,spot_video_type,spot_video_ctime')->where('spot_video_sid ='.$spot_id.' and spot_video_type=1')->order('spot_video_ctime desc')->limit(1)->select();
        $summer=$video->field('spot_video_id,spot_video_sid,spot_video_src,spot_video_favorite,spot_video_detail,spot_video_type,spot_video_ctime')->where('spot_video_sid ='.$spot_id.' and spot_video_type=2')->order('spot_video_ctime desc')->limit(1)->select();
        $autumn=$video->field('spot_video_id,spot_video_sid,spot_video_src,spot_video_favorite,spot_video_detail,spot_video_type,spot_video_ctime')->where('spot_video_sid ='.$spot_id.' and spot_video_type=3')->order('spot_video_ctime desc')->limit(1)->select();
        $winter=$video->field('spot_video_id,spot_video_sid,spot_video_src,spot_video_favorite,spot_video_detail,spot_video_type,spot_video_ctime')->where('spot_video_sid ='.$spot_id.' and spot_video_type=4')->order('spot_video_ctime desc')->limit(1)->select();
        $videolist=array_merge($spring,$summer,$autumn,$winter);
        if (empty($videolist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $videolist);
        }
    }
    /**
     * 季节图片 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int spot_id 景点id
     * @param int page 第几页
     * @param int count 数
     * @param int season 季节
     * @return array 状态+提示
     */
    public function spot_img_season(){
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $season = $_REQUEST['season'] ? intval($_REQUEST['season']) : 0;
        $start = ($page - 1) * $count;
        $img=M('spot_img');
        $count=$img->where('spot_img_sid ='.$spot_id.' and spot_img_season ='.$season)->count();
        $imglist=$img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season ='.$season)->order('spot_img_ctime desc')->limit($start, $count)->select();
        $img_count=array();
        $img_count[0]['img_count']=$count;
        $imglist=array_merge($img_count,$imglist);
        if (empty($imglist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $imglist);
        }
    }
    /**
     * 季节视频 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int spot_id 景点id
     * @param int page 第几页
     * @param int count 数
     * @param int season 季节
     * @return array 状态+提示
     */
    public function spot_video_season(){
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $season = $_REQUEST['season'] ? intval($_REQUEST['season']) : 0;
        $start = ($page - 1) * $count;
        $img=M('spot_video');
        $count=$img->where('spot_video_sid ='.$spot_id.' and spot_img_type ='.$season)->count();
        $imglist=$img->field('spot_video_id,spot_video_sid,spot_video_src,spot_video_favorite,spot_video_detail,spot_video_season,spot_img_ctime')->where('spot_img_sid ='.$spot_id.' and spot_img_season ='.$season)->order('spot_img_ctime desc')->limit($start, $count)->select();
        $img_count=array();
        $img_count[0]['img_count']=$count;
        $imglist=array_merge($img_count,$imglist);
        if (empty($imglist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $imglist);
        }
    }


}
