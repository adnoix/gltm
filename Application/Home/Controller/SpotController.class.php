<?php
namespace Home\Controller;

use Think\Controller;
use Think;

class SpotController extends CommonController
{
    public $userid = "";

    public function oauth()
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
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;

        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite')->field('favorite_sid')->where('favorite_uid =' . $uid)->getAsFieldArray('favorite_sid');
        }
        $start = ($page - 1) * $count;
        $spot = $spotlist->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude')->order('spot_level desc')->limit($start, $count)->select();
        foreach ($spot as &$val) {
            $val['spot_is_favorite'] = in_array($val['spot_id'], $favorite) ? 1 : 0;
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
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
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
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 0;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        $start = ($page - 1) * $count;
        $spot = $spotlist->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude,spot_limit,spot_comment,spot_address,spot_recommend')->order('spot_id asc')->select();
        $spotcount = $spotlist->count();
        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
//            unset($val['spot_latitude']);
//            unset($val['spot_longitude']);
        }
        foreach ($spot as $key => $row) {
            $volume[$key] = $row['spot_distance'];
        }
        array_multisort($volume, SORT_ASC, $spot);
        $min = array();
        $sscount = $start + $count <= $spotcount ? $start + $count : $spotcount;
        for ($i = $start; $i < $sscount; $i++) {
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
        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite')->field('favorite_sid')->where('favorite_uid =' . $uid)->getAsFieldArray('favorite_sid');
        }
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        $spot = M('spot')->field('spot_id,spot_img,spot_name,spot_level,spot_advise_time,spot_latitude,spot_longitude,spot_address,spot_comment,spot_tel,spot_culture,spot_introduce')->where('spot_id =' . $spot_id)->select();

        foreach ($spot as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            $val['spot_distance'] <= 1000 ? $val['spot_distance'] = $val['spot_distance'] . 'm' : $val['spot_distance'] = number_format($val['spot_distance'] / 1000, 2) . 'km';
        }
        if (empty($spot)) {
            $aa = (object)array();
            $this->apiReturn('error', '暂无数据', $aa);
        } else {
            $spot[0]['spot_is_favorite'] = in_array($spot[0]['spot_id'], $favorite) ? 1 : 0;
            $this->apiReturn('success', '查询成功', $spot[0]);
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
        $img = M('spot_img');
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $spring = $img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid =' . $spot_id . ' and spot_img_season=1')->order('spot_img_ctime desc')->limit(1)->select();
        $scount = $img->where('spot_img_sid =' . $spot_id . ' and spot_img_season = 1')->count();
        $spring[0]['img_count'] = $scount;
        $summer = $img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid =' . $spot_id . ' and spot_img_season=2')->order('spot_img_ctime desc')->limit(1)->select();
        $sucount = $img->where('spot_img_sid =' . $spot_id . ' and spot_img_season = 2')->count();
        $summer[0]['img_count'] = $sucount;
        $autumn = $img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid =' . $spot_id . ' and spot_img_season=3')->order('spot_img_ctime desc')->limit(1)->select();
        $acount = $img->where('spot_img_sid =' . $spot_id . ' and spot_img_season = 3')->count();
        $autumn[0]['img_count'] = $acount;
        $winter = $img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid =' . $spot_id . ' and spot_img_season=4')->order('spot_img_ctime desc')->limit(1)->select();
        $wcount = $img->where('spot_img_sid =' . $spot_id . ' and spot_img_season = 4')->count();
        $winter[0]['img_count'] = $wcount;
        $imglist = array_merge($spring, $summer, $autumn, $winter);
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
        $video = M('spot_video');
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $spring = $video->field('spot_video_id,spot_video_sid,spot_video_img,spot_video_favorite,spot_video_name,spot_video_type,spot_video_ctime')->where('spot_video_sid =' . $spot_id . ' and spot_video_type=1')->order('spot_video_ctime desc')->limit(1)->select();
        $spcount = $video->where('spot_video_sid =' . $spot_id . ' and spot_video_type = 1')->count();
        $spring[0]['video_count'] = $spcount;
        $summer = $video->field('spot_video_id,spot_video_sid,spot_video_img,spot_video_favorite,spot_video_name,spot_video_type,spot_video_ctime')->where('spot_video_sid =' . $spot_id . ' and spot_video_type=2')->order('spot_video_ctime desc')->limit(1)->select();
        $sucount = $video->where('spot_video_sid =' . $spot_id . ' and spot_video_type = 2')->count();
        $summer[0]['video_count'] = $sucount;
        $autumn = $video->field('spot_video_id,spot_video_sid,spot_video_img,spot_video_favorite,spot_video_name,spot_video_type,spot_video_ctime')->where('spot_video_sid =' . $spot_id . ' and spot_video_type=3')->order('spot_video_ctime desc')->limit(1)->select();
        $aucount = $video->where('spot_video_sid =' . $spot_id . ' and spot_video_type = 3')->count();
        $autumn[0]['video_count'] = $aucount;
        $winter = $video->field('spot_video_id,spot_video_sid,spot_video_img,spot_video_favorite,spot_video_name,spot_video_type,spot_video_ctime')->where('spot_video_sid =' . $spot_id . ' and spot_video_type=4')->order('spot_video_ctime desc')->limit(1)->select();
        $wcount = $video->where('spot_video_sid =' . $spot_id . ' and spot_video_type = 4')->count();
        $winter[0]['video_count'] = $wcount;
        $videolist = array_merge($spring, $summer, $autumn, $winter);
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
    public function spot_img_season()
    {
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $season = $_REQUEST['season'] ? intval($_REQUEST['season']) : 0;

        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite_img')->field('favorite_img_iid')->where('favorite_img_uid =' . $uid)->getAsFieldArray('favorite_img_iid');
        }

        $start = ($page - 1) * $count;
        $img = M('spot_img');
        $count = $img->where('spot_img_sid =' . $spot_id . ' and spot_img_season =' . $season)->count();
        $imglist = $img->field('spot_img_id,spot_img_sid,spot_img_src,spot_img_favorite,spot_img_detail,spot_img_season,spot_img_ctime')->where('spot_img_sid =' . $spot_id . ' and spot_img_season =' . $season)->order('spot_img_ctime desc')->limit($start, $count)->select();
        foreach ($imglist as &$val) {
            $val['spot_img_is_favorite'] = in_array($val['spot_img_id'], $favorite) ? 1 : 0;
        }
        //$img_count = array();
        //$img_count[0]['img_count'] = $count;
        //$imglist = array_merge($img_count, $imglist);
        if ($count == 0) {
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
    public function spot_video_season()
    {
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $spot_id = $_REQUEST['spot_id'] ? intval($_REQUEST['spot_id']) : 0;
        $season = $_REQUEST['season'] ? intval($_REQUEST['season']) : 0;

        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite_video')->field('favorite_video_vid')->where('favorite_video_uid =' . $uid)->getAsFieldArray('favorite_video_vid');
        }

        $start = ($page - 1) * $count;
        $video = M('spot_video');
        //$count = $video->where('spot_video_sid =' . $spot_id . ' and spot_video_type =' . $season)->count();
        $videolist = $video->field('spot_video_id,spot_video_sid,spot_video_img,spot_video_src,spot_video_favorite,spot_video_name,spot_video_type,spot_video_ctime')->where('spot_video_sid =' . $spot_id . ' and spot_video_type =' . $season)->order('spot_video_ctime desc')->limit($start, $count)->select();
        foreach ($videolist as &$val) {
            $val['spot_video_is_favorite'] = in_array($val['spot_video_id'], $favorite) ? 1 : 0;
        }
        // $video_count = array();
        //$video_count[0]['video_count'] = $count;
        //$videolist = array_merge($video_count, $videolist);
        if ($count == 0) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $videolist);
        }
    }

    /**
     * 收藏景点 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int sid 景点id
     * @param int ip ip
     * @return array 状态+提示
     */
    public function spot_favorite()
    {
        $ip = addslashes($_REQUEST['ip']);
        $sid = intval($_REQUEST['sid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite')->where('favorite_sid =' . $sid . ' and favorite_uid =' . $uid)->select();
        if (empty($favoritelist)) {
            $data['favorite_sid'] = $sid;
            $data['favorite_uid'] = $uid;
            $data['favorite_ip'] = $ip;
            $data['favorite_ctime'] = time();
            $result = M('favorite')->add($data);
            $count = M('spot')->field('spot_favorite')->where("spot_id =" . $sid)->getField('spot_favorite');
            $data2['spot_id'] = $sid;
            $data2['spot_favorite'] = $count + 1;
            $result2 = M('spot')->save($data2);
            if ($result && $result2) {
                $this->apiReturn('success', '收藏成功');
            } else {
                $this->apiReturn('error', '收藏失败');
            }
        } else {
            $this->apiReturn('error', '您已收藏过该景点');
        }
    }

    /**
     * 取消收藏景点 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int sid 景点id
     * @return array 状态+提示
     */
    public function spot_unfavorite()
    {
        $sid = intval($_REQUEST['sid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite')->where('favorite_sid =' . $sid . ' and favorite_uid =' . $uid)->select();
        if (!empty($favoritelist)) {
            $data['favorite_sid'] = $sid;
            $data['favorite_uid'] = $uid;
            $result = M('favorite')->where($data)->delete();
            $count = M('spot')->field('spot_favorite')->where("spot_id =" . $sid)->getField('spot_favorite');
            $data2['spot_id'] = $sid;
            $data2['spot_favorite'] = $count - 1;
            $result2 = M('spot')->save($data2);
            if ($result && $result2) {
                $this->apiReturn('success', '取消收藏成功');
            } else {
                $this->apiReturn('error', '取消收藏失败');
            }
        } else {
            $this->apiReturn('error', '您未收藏过该景点');
        }
    }

    /**
     * 批量删除景点 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int sid 景点id
     * @return array 状态+提示
     */
    public function spot_delfavorite()
    {
        $sid = $_REQUEST['sid'];
        $this->oauth();
        $uid = $this->userid;
        $arr = explode(',', $sid);
        foreach ($arr as &$val) {
            $data['favorite_sid'] = $val;
            $data['favorite_uid'] = $uid;
            $result = M('favorite')->where($data)->delete();
            $count = M('spot')->field('spot_favorite')->where("spot_id =" . $val)->getField('spot_favorite');
            $data2['spot_id'] = $sid;
            $data2['spot_favorite'] = $count - 1;
            $result2 = M('spot')->save($data2);
        }
        $this->apiReturn('success', '删除成功');
    }

    /**
     * 搜索景点 --
     * @param varchar searchname 搜索名
     * @return array 状态+提示
     */
    public function spot_search()
    {
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        $searchname = addslashes($_REQUEST['searchname']);
        if (empty($searchname)) {
            $this->apiReturn('error', "搜索名不能为空");
        }
        $map['spot_name'] = array('like', '%' . $searchname . '%');
        $result = M('spot')->field('spot_id,spot_name,spot_img,spot_level,spot_favorite,spot_longitude,spot_latitude,spot_limit,spot_comment,spot_address,spot_recommend')->where($map)->select();
        foreach ($result as &$val) {
            $val['spot_distance'] = $this->getDistance($latitude, $longitude, $val['spot_latitude'], $val['spot_longitude']);
            $val['spot_distance'] <= 1000 ? $val['spot_distance'] = $val['spot_distance'] . 'm' : $val['spot_distance'] = number_format($val['spot_distance'] / 1000, 2) . 'km';
        }
        if ($result) {
            $this->apiReturn('success', "查询成功", $result);
        } else {
            $this->apiReturn('error', "暂无数据");
        }
    }

    /**
     * 搜索景点 --
     * @param varchar searchname 搜索名
     * @return array 状态+提示
     */
    public function spot_all()
    {
        $result = M('spot')->field('spot_id,spot_name')->select();
        if ($result) {
            $this->apiReturn('success', "查询成功", $result);
        } else {
            $this->apiReturn('error', "暂无数据");
        }
    }

    /**
     * 景点推荐 --
     * @param varchar searchname 搜索名
     * @return array 状态+提示
     */
    public function spot_recommend()
    {
        $spotlist = M('spot');
        $spot = $spotlist->field('spot_id,spot_name')->where('spot_recommend = 1')->limit(10)->select();
        if (empty($spot)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $spot);
        }

    }

    /**
     * 点赞图片 --
     * * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param varchar iid 搜索名
     * @return array 状态+提示
     */
    public function favorite_img()
    {
        $iid = intval($_REQUEST['iid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_img')->where('favorite_img_iid =' . $iid . ' and favorite_img_uid =' . $uid)->select();
        if (empty($favoritelist)) {
            $data['favorite_img_iid'] = $iid;
            $data['favorite_img_uid'] = $uid;
            $data['favorite_img_ctime'] = time();
            $result1 = M('favorite_img')->add($data);
            $count = M('spot_img')->field('spot_img_favorite')->where("spot_img_id =" . $iid)->getField('spot_img_favorite');
            $data2['spot_img_id'] = $iid;
            $data2['spot_img_favorite'] = $count + 1;
            $result2 = M('spot_img')->save($data2);
            if ($result1 && $result2) {
                $this->apiReturn('success', '点赞成功');
            } else {
                $this->apiReturn('error', '点赞失败');
            }
        } else {
            $this->apiReturn('error', '您已点赞过该图片');
        }
    }

    /**
     * 取消点赞图片 --
     * * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param varchar iid id
     * @return array 状态+提示
     */
    public function favorite_unimg()
    {
        $iid = intval($_REQUEST['iid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_img')->where('favorite_img_iid =' . $iid . ' and favorite_img_uid =' . $uid)->select();
        if (!empty($favoritelist)) {
            $data['favorite_img_iid'] = $iid;
            $data['favorite_img_uid'] = $uid;
            $result1 = M('favorite_img')->where($data)->delete();
            $count = M('spot_img')->field('spot_img_favorite')->where("spot_img_id =" . $iid)->getField('spot_img_favorite');
            $data2['spot_img_id'] = $iid;
            $data2['spot_img_favorite'] = $count - 1;
            $result2 = M('spot_img')->save($data2);
            if ($result1 && $result2) {
                $this->apiReturn('success', '取消点赞成功');
            } else {
                $this->apiReturn('error', '取消点赞失败');
            }
        } else {
            $this->apiReturn('error', '您未点赞过该图片');
        }
    }

    /**
     * 点赞视频 --
     * * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param varchar vid
     * @return array 状态+提示
     */
    public function favorite_video()
    {
        $vid = intval($_REQUEST['vid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_video')->where('favorite_video_vid =' . $vid . ' and favorite_video_uid =' . $uid)->select();
        if (empty($favoritelist)) {
            $data['favorite_video_vid'] = $vid;
            $data['favorite_video_uid'] = $uid;
            $data['favorite_video_ctime'] = time();
            $result1 = M('favorite_video')->add($data);
            $count = M('spot_video')->field('spot_video_favorite')->where("spot_video_id =" . $vid)->getField('spot_video_favorite');
            $data2['spot_video_id'] = $vid;
            $data2['spot_video_favorite'] = $count + 1;
            $result2 = M('spot_video')->save($data2);
            if ($result1 && $result2) {
                $this->apiReturn('success', '点赞成功');
            } else {
                $this->apiReturn('error', '点赞失败');
            }
        } else {
            $this->apiReturn('error', '您已点赞过该视频');
        }
    }

    /**
     * 点赞视频 --
     * * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param varchar vid
     * @return array 状态+提示
     */
    public function favorite_unvideo()
    {
        $vid = intval($_REQUEST['vid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_video')->where('favorite_video_vid =' . $vid . ' and favorite_video_uid =' . $uid)->select();
        if (!empty($favoritelist)) {
            $data['favorite_video_vid'] = $vid;
            $data['favorite_video_uid'] = $uid;
            $result1 = M('favorite_video')->where($data)->delete();
            $count = M('spot_video')->field('spot_video_favorite')->where("spot_video_id =" . $vid)->getField('spot_video_favorite');
            $data2['spot_video_id'] = $vid;
            $data2['spot_video_favorite'] = $count - 1;
            $result2 = M('spot_video')->save($data2);
            if ($result1 && $result2) {
                $this->apiReturn('success', '取消点赞成功');
            } else {
                $this->apiReturn('error', '取消点赞失败');
            }
        } else {
            $this->apiReturn('error', '您未点赞过该视频');
        }
    }

    /**
     * 评论景点 --
     * * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param varchar has_file 0
     * @param varchar detail 评论
     *  * @param varchar score_all 评分
     *  * @param varchar scenery_score 景色
     *  * @param varchar service_score 服务
     * @param varchar service_score 公共设施
     * @return array 状态+提示
     */
    public function spot_comment()
    {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 333145728; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath = './Public/Uploads/'; // 设置附件上传目录
        // 上传文件
        $info = $upload->upload();

//        if (!$info) {// 上传错误提示错误信息
//            $this->error($upload->getError());
//        } else {// 上传成功
//           var_dump($info);die;
//        }

        $this->oauth();
        $uid = $this->userid;
        $comment_detail = addslashes($_REQUEST['detail']);
        $comment_score_all = $_REQUEST['score_all']==0 ? 5:intval($_REQUEST['score_all']) ;
        $comment_sid = $_REQUEST['sid'];
        $comment_scenery_score = $_REQUEST['scenery_score'] ==0?5: intval($_REQUEST['scenery_score']);
        $comment_service_score = $_REQUEST['service_score']==0 ?5: intval($_REQUEST['service_score']);
        $comment_public_score = $_REQUEST['public_score']==0 ? 5:intval($_REQUEST['public_score']);
        if (empty($comment_detail)) {
            $this->apiReturn('error', '评论内容不能为空！');
        } elseif (strlen($comment_detail) <= 10) {
            $this->apiReturn('error', '评论内容少于10个字！');
        }
        $map['comment_sid'] = $comment_sid;
        $map['comment_type'] = 1;
        $map['comment_detail'] = $comment_detail;
        $map['comment_uid'] = $uid;
        $map['comment_score_all'] = $comment_score_all;
        $map['comment_scenery_score'] = $comment_scenery_score;
        $map['comment_service_score'] = $comment_service_score;
        $map['comment_public_score'] = $comment_public_score;
        $map['comment_ctime'] = time();
        $result = M('comment')->add($map);
        if ($result) {
            $count = M('spot')->field('spot_comment')->where("spot_id =" . $comment_sid)->getField('spot_comment');
            $data2['spot_id'] = $comment_sid;
            $data2['spot_comment'] = $count + 1;
            $result2 = M('spot')->save($data2);

            if ($_REQUEST['has_file'] == 1) {
                if ($info) {
               /// var_dump($info);die;
                    foreach ($info as &$val) {
                        $a['comment_img_cid'] = $result;
                        $a['comment_img_src'] = $val['savepath'] . $val['savename'];;
                        $a['comment_img_ctime'] = time();
                        $result1 = M('comment_img')->add($a);
                    }
                    $this->apiReturn('success', "评论成功");
                } else {
                    M('spot')->where('comment_id =' . $result)->delete();
                    $this->apiReturn('error', "图片上传失败");
                }
            }

            $this->apiReturn('success', "评论成功");
        } else {
            $this->apiReturn('error', "评论失败");
        }
    }

    /**
     * 景点评论列表 --
     * @param varchar sid 景点id
     * @param varchar page 页数
     * @param varchar count
     * @return array 状态+提示
     */
    public function spot_comment_list()
    {
        $comment_sid = $_REQUEST['sid'];
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $start = ($page - 1) * $count;
        $comment_list = M('comment')->field('gltm_comment.comment_id,gltm_comment.comment_sid,gltm_comment.comment_type,gltm_comment.comment_detail,gltm_comment.comment_score_all,gltm_comment.comment_scenery_score,gltm_comment.comment_service_score,gltm_comment.comment_public_score,gltm_comment.comment_ctime,gltm_user.user_phone,gltm_user.user_name,gltm_user.user_avatar,gltm_user.user_email')->join('gltm_user on gltm_comment.comment_uid=gltm_user.user_id')->where('gltm_comment.comment_sid =' . $comment_sid)->order("gltm_comment.comment_ctime desc")->limit($start, $count)->select();
        if ($comment_list) {
            foreach ($comment_list as &$val) {
//                $list=array();
                $list = M('comment_img')->field('comment_img_src')->where('comment_img_cid =' . $val['comment_id'])->select();
//                //var_dump($list);echo '<hr>';
                if (!empty($list)) {
                    foreach ($list as &$v) {
                        $v['comment_img_src'] = 'http://' . $_SERVER['HTTP_HOST'] . '/gltm/Uploads' . ltrim($v['comment_img_src'], '.');
                    }
                } else {
                    $a = array();
                    $val['comment_img'] = $a;
                }
                $val['comment_img'] = $list;
//               // var_dump($a);
            }
            $this->apiReturn('success', "查询成功", $comment_list);
        } else {
            $this->apiReturn('error', "暂无数据");
        }
    }

    /**
     * 我的收藏 --
     ** @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int page 第几页
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @param int  count 数量
     * @return array 状态+提示
     */
    public function spot_myfavorite()
    {
        $this->oauth();
        $uid = $this->userid;
        $spotlist = M('spot');
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        //$favorite=M('favorite')->field('favorite_sid')->where('favorite_uid ='.$uid)->getAsFieldArray('favorite_sid');
        $start = ($page - 1) * $count;
        $spot = $spotlist->join('gltm_favorite on gltm_favorite.favorite_sid=gltm_spot.spot_id ')->field('gltm_spot.spot_id,gltm_spot.spot_name,gltm_spot.spot_img,gltm_spot.spot_level,gltm_spot.spot_favorite,gltm_spot.spot_longitude,gltm_spot.spot_latitude')->where('gltm_favorite.favorite_uid =' . $uid)->order('gltm_favorite.favorite_ctime desc')->limit($start, $count)->select();

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
     * 语音导览 --
     * @param int page 第几页
     * @param float $latitude
     *            纬度
     * @param float $longitude
     *            经度
     * @param int  count 数量
     * @return array 状态+提示
     */
    public function spot_voice_guide()
    {
        $sid = $_REQUEST['sid'];
        $voice_list = M('spot_voice')->field('spot_voice_id,spot_voice_sid,spot_voice_name,spot_voice_src,spot_voice_latitude,spot_voice_longitude')->where('spot_voice_sid =' . $sid)->select();
        if (empty($voice_list)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $this->apiReturn('success', '查询成功', $voice_list);
        }
    }

    /**
     * 景点线路 --
     * @param int page 第几页
     * @param int  count 数量
     * @return array 状态+提示
     */

    public function spot_line()
    {
        $line = M('line');
        $page = $_REQUEST['page'] ? intval($_REQUEST['page']) : 1;
        $count = $_REQUEST['count'] ? intval($_REQUEST['count']) : 20;
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite_line')->field('favorite_line_lid')->where('favorite_line_uid =' . $uid)->getAsFieldArray('favorite_line_lid');
        }
        $start = ($page - 1) * $count;
        $linelist = $line->join('gltm_line_detail on gltm_line.line_id=gltm_line_detail.line_id')->field('gltm_line.line_id,gltm_line.line_name,gltm_line.line_level,gltm_line.line_img,gltm_line.line_day,gltm_line.line_favorite,gltm_line_detail.line_spot')->where('gltm_line_detail.line_day = 1')->limit($start, $count)->order('line_level desc')->select();
        if (empty($linelist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            foreach ($linelist as &$val) {
                $val['line_is_favorite'] = in_array($val['line_id'], $favorite) ? 1 : 0;
                $val['line_spot'] = explode(',', $val['line_spot']);
                foreach ($val['line_spot'] as &$v) {
                    $v = M('spot')->field('spot_name')->where('spot_id =' . $v)->getField('spot_name');
                }
            }
            $this->apiReturn('success', '查询成功', $linelist);
        }
    }

    /**
     * 景点线路详情 --
     * @param int lid 线路id
     * @return array 状态+提示
     */
    public function spot_line_detail()
    {
        $line = M('line');
        $lid = $_REQUEST['lid'];
        $latitude = $_REQUEST['latitude'] ? $_REQUEST['latitude'] : 39.9110130000;
        $longitude = $_REQUEST['longitude'] ? $_REQUEST['longitude'] : 116.4135540000;
        $login_oauth_token = addslashes($_REQUEST['login_oauth_token']);
        $login_oauth_token_secret = addslashes($_REQUEST['login_oauth_token_secret']);
        $map = array();
        $map['login_oauth_token'] = $login_oauth_token;
        $map['login_oauth_token_secret'] = $login_oauth_token_secret;
        $uid = M('login')->field('login_uid')->where($map)->getField('login_uid');
        if ($uid) {
            $favorite = M('favorite_line')->field('favorite_line_lid')->where('favorite_line_uid =' . $uid)->getAsFieldArray('favorite_line_lid');
        }

        $linelist = $line->field('line_id,line_name,line_level,line_img,line_day')->where('line_id =' . $lid)->select();
        $spotlist = M('line_detail')->field('line_spot')->where('line_id =' . $lid)->order('line_id asc')->getAsFieldArray('line_spot');
        foreach ($spotlist as &$val) {
            $val = explode(',', $val);
            foreach ($val as &$v) {
                $v = M('spot')->field('spot_name')->where('spot_id =' . $v)->getField('spot_name');
//                $v=implode(',',$v);
            }
        }
        $first = M('spot')->field('spot_longitude,spot_latitude')->where('spot_name =' . "'" . $spotlist[0][0] . "'")->select();
        $linelist[0]['line_distance'] = $this->getDistance($latitude, $longitude, $first[0]['spot_latitude'], $first[0]['spot_longitude']);
        $linelist[0]['line_distance'] <= 1000 ? $linelist[0]['line_distance'] = $linelist[0]['line_distance'] . 'm' : $linelist[0]['line_distance'] = number_format($linelist[0]['line_distance'] / 1000, 2) . 'km';
//        var_dump($first);die;
        $arr = array();
        for ($i = 0; $i < count($spotlist); $i++) {
            $arr[$i]['day'] = $i + 1;
            $arr[$i]['diqu'] = $spotlist[$i];
            // var_dump($spotlist[$i]);
            $map['line_id'] = $lid;
            $map['line_day'] = $i + 1;
            $arr2[$i]['day'] = $i + 1;
            $arr2[$i]['introduce'] = M('line_detail')->field('line_introduce')->where($map)->getField('line_introduce');
            for ($j = 0; $j < count($spotlist[$i]); $j++) {
                $result = M('spot')->where('spot_name =' . "'" . $spotlist[$i][$j] . "'")->select();
                $arrday[$i][$j]['order'] = $j + 1;
                $arrday[$i][$j]['spot_name'] = $result[0]['spot_name'];
                $arrday[$i][$j]['spot_level'] = $result[0]['spot_level'];
                $arrday[$i][$j]['spot_favorite'] = $result[0]['spot_favorite'];
                $arrday[$i][$j]['spot_introduce'] = $result[0]['spot_introduce'];
                $arrday[$i][$j]['spot_use_time'] = $result[0]['spot_use_time'];
            }
            $arr2[$i]['line_day_detail'] = $arrday[$i];
        }

        if (empty($linelist)) {
            $this->apiReturn('error', '暂无数据');
        } else {
            $linelist[0]['line_outline'] = $arr;
            $linelist[0]['line_detail'] = $arr2;
            $linelist[0]['line_is_favorite'] = in_array($lid, $favorite) ? 1 : 0;
            $this->apiReturn('success', '查询成功', $linelist);
        }
    }

    /**
     * 收藏线路 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int lid 景点id
     * @return array 状态+提示
     */
    public function spot_favorite_line()
    {
        $lid = intval($_REQUEST['lid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_line')->where('favorite_line_lid =' . $lid . ' and favorite_line_uid =' . $uid)->select();
        if (empty($favoritelist)) {
            $data['favorite_line_lid'] = $lid;
            $data['favorite_line_uid'] = $uid;
            $data['favorite_line_ctime'] = time();
            $result = M('favorite_line')->add($data);
            $count = M('line')->field('line_favorite')->where("line_id =" . $lid)->getField('line_favorite');
            $data2['line_id'] = $lid;
            $data2['line_favorite'] = $count + 1;
            $result2 = M('line')->save($data2);
            if ($result && $result2) {
                $this->apiReturn('success', '收藏成功');
            } else {
                $this->apiReturn('error', '收藏失败');
            }
        } else {
            $this->apiReturn('error', '您已收藏过该线路');
        }
    }

    /**
     * 取消收藏线路 --
     * @param varchar login_oauth_token
     * @param varchar login_oauth_token_secret
     * @param int lid 景点id
     * @return array 状态+提示
     */
    public function spot_unfavorite_line()
    {
        $lid = intval($_REQUEST['lid']);
        $this->oauth();
        $uid = $this->userid;
        $favoritelist = M('favorite_line')->where('favorite_line_lid =' . $lid . ' and favorite_line_uid =' . $uid)->select();
        if (!empty($favoritelist)) {
            $data['favorite_line_lid'] = $lid;
            $data['favorite_line_uid'] = $uid;
            $result = M('favorite_line')->where($data)->delete();
            $count = M('line')->field('line_favorite')->where("line_id =" . $lid)->getField('line_favorite');
            $data2['line_id'] = $lid;
            $data2['line_favorite'] = $count - 1;
            $result2 = M('line')->save($data2);
            if ($result && $result2) {
                $this->apiReturn('success', '取消收藏成功');
            } else {
                $this->apiReturn('error', '取消收藏失败');
            }
        } else {
            $this->apiReturn('error', '您未收藏过该线路');
        }
    }


}
