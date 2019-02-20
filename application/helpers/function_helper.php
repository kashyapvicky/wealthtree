<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Database helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Punit Kumar
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since		Version 1.0
 */

//------------------------------------------------------------------------------
if (!function_exists('is_protected')) {
    function is_protected()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('isLogin') != 'yes') {
            redirect(base_url());
        }
    }
}
// ------------------------------------------------------------------------
/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('_layout')) {
    function _layout($data = null)
    {
        if(isset($_SESSION['page_lang']))
        {
            
            if($_SESSION['page_lang']=='page_hin')
            {
                $page = $data['page'];
               // echo $page; die();
                $new_page = $page.'_hi';
                $data['page'] = $new_page;
               // echo $new_page; die;
                // echo $_SESSION['page_lang']; die;

            }
        }
        $CI = &get_instance();
        $CI->load->view('layout', $data);
    }
}
// ------------------------------------------------------------------------
/**
 * @Function _layout_admin
 * @purpose load layout page 
 * @created  19 nov 2018
 */
if (!function_exists('_layout_admin')) {
    function _layout_admin($data = null)
    {
        $CI = &get_instance();
        $CI->load->view('layout_admin', $data);
    }
}
//------------------------------------------------------------------------------
if (!function_exists('set_flashdata')) {
    function set_flashdata($type, $msg)
    {
        $CI = &get_instance();
        $CI->session->set_flashdata($type, $msg);
    }
}
//------------------------------------------------------------------------------
if (!function_exists('get_flashdata')) {
    function get_flashdata()
    {
        $CI = &get_instance();
        $success = $CI->session->flashdata('success') ? $CI->session->flashdata('success') :
            '';
        $error = $CI->session->flashdata('error') ? $CI->session->flashdata('error') :
            '';
        $warning = $CI->session->flashdata('warning') ? $CI->session->flashdata('warning') :
            '';
        if ($success) {
            $msg = '<div class="alert alert-success flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
					 ' . $success . ' 
            </div>';
        } elseif ($error) {
            $msg = '<div class="alert alert-danger flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
					<strong>Error!</strong> ' . $error . ' 
            </div>';
        } elseif ($warning) {
            $msg = '<div class="alert alert-warning flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					' . $warning . '
            </div>';
        } else {
            return;
        }
        return $msg;
    }
}

if (!function_exists('isPostBack')) {
    function isPostBack()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }
}


// ------------------------------------------------------------------------

/**
 * Current Date And Time
 *
 * This function get Current Date And Time
 *
 * @param	
 * @return
 */
if (!function_exists('current_date')) {

    function current_date()
    {
        $dateFormat = date("Y-m-d H:i:s", time());
        $timeNdate = $dateFormat;

        return $timeNdate;
    }

}

/**
 * Current User Info 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('currentuserinfo')) {
    function currentuserinfo()
    {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo");
    }
}

/**
 * Current User Info 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('currUserId')) {
    function currUserId()
    {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo")->id;
    }
}

/**
 * get ur segment
 * 
 * 
 */
if (!function_exists('uri_segment')) {
    function uri_segment($val)
    {
        $CI = &get_instance();
        return $CI->uri->segment($val);
    }
}

// ------------------------------------------------------------------------
/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('pr')) {
    function pr($data = null)
    {
        echo '<pre>';
        print_r($data);
    }
}

if (!function_exists('user_type')) {
    function user_type($id = null)
    {
        $type = "";
        if ($id == '1') {
            $type = 'Admin';
        } elseif ($id == '2') {
            $type = 'Manager';
        } elseif ($id == '3') {
            $type = 'Executive';
        } elseif ($id == '4') {
            $type = 'Guest';
        }
        return $type;
    }
}

if (!function_exists('readable_date')) {
    function readable_date($date = null, $type = null)
    {
        if ($type == 'date') {
            return (!empty($date)) ? date("d-M-Y", strtotime($date)) : ' ';
        }
        return (!empty($date)) ? date("d-M-Y h:i A", strtotime($date)) : ' ';
    }
}

if (!function_exists('salutation')) {
    function salutation($id = null)
    {
        $arr = array(
            '1' => 'Mr.',
            '2' => 'Ms.',
            '3' => 'Mrs.',
            '4' => 'Dr.',
            '5' => 'Er.');
        return (!empty($id)) ? $arr[$id] : $arr;
    }
}

if (!function_exists('is_ajax_post')) {
    function is_ajax_post()
    {
        $CI = &get_instance();
        if (!$CI->input->is_ajax_request()) {
            show_error('No direct script access allowed');
            exit;
        }
    }
}

if (!function_exists('contact_list')) {
    function contact_list()
    {
        $CI = &get_instance();
        $CI->db->select('id,contact_name,email');
        $CI->db->from('contacts');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

if (!function_exists('fieldByCondition')) {
    function fieldByCondition($table, $conArr, $field)
    {
        $CI = &get_instance();
        $CI->db->select($field, false);
        $CI->db->from($table);
        $CI->db->where($conArr);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }
}

if (!function_exists('getDropDownList')) {
    function getDropDownList($table = null, $field = null, $conArr = null)
    {
        $CI = &get_instance();
        $CI->db->select("id,$field", false);
        $CI->db->from($table);
        if ($conArr) {
            $CI->db->where($conArr);
        }
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

//----------------------------------------------------------------------
/**
 * @function formatDate
 * @purpose format the date 
 * @created 2 Apr 2015
 */
if (!function_exists('changeDateFormat')) {
    function changeDateFormat($str = null)
    {
        $arr = explode('/', $str); //pr($arr);
        return trim($arr[2]) . '-' . trim($arr[0]) . '-' . trim($arr[1]);
    }
}

/**
 * Function to check ajax request
 *
 * @access	public
 */
if (!function_exists('is_ajax_request')) {
    function is_ajax_request()
    {
        $CI = &get_instance();
        if (!$CI->input->is_ajax_request()) {
            show_error('No direct script access allowed');
            exit;
        }
    }
}
/**
 * Function to check ajax request
 *
 * @access	public
 */
if (!function_exists('membership_status')) {
    function membership_status()
    {
        $array = array(
            '1' => 'Pending',
            '2' => 'Active',
            '3' => 'Default',
            '4' => 'Terminated');
        return $array;
    }
}


/**
 * @function _show404
 * @purpose Display error page
 * @created 8Apr2015
 */
if (!function_exists('_show404')) {
    function _show404()
    {
        $CI = &get_instance();
        $data['title'] = 'Error';
        $data['subTitle'] = 'Wrong Page';
        $data['page'] = 'error';
        _layout($data);
    }
}

/**
 * @function dealStages
 * @purpose List Deal Stages
 * @created 15Apr2015
 */
if (!function_exists('dealStages')) {
    function dealStages($stages = null)
    {
        $stages = @explode(',', $stages);
        $CI = &get_instance();
        $CI->db->select("id,stage_name");
        $CI->db->from("campaign_stages");
        $CI->db->where_in('id', $stages);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

/**
 * @function getPrevNextId
 * @purpose to get next record or previous record
 * @created 15Apr2015
 */
if (!function_exists('getPrevNextId')) {
    function getPrevNextId($table = null, $id = null, $type = null)
    {
        $CI = &get_instance();
        $CI->db->select("id");
        $CI->db->from($table);
        $CI->db->limit(1);
        if ($type == 'next') {
            $CI->db->where('id >', $id);
            $CI->db->order_by('id', 'asc');
        } else
            if ($type == 'prev') {
                $CI->db->where('id <', $id);
                $CI->db->order_by('id', 'desc');
            }
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->row()->id;
        }
        return false;
    }
}

//-------------------------------------------Notification Functions Start----------------------------------------------
/**
 * @function saveNotification
 * @purpose to save new notifications
 * @created 05May2015
 */
if (!function_exists('saveNotification')) {
    function saveNotification($notification_eng,$notification_hin,$user_id,$column)
    {
        $CI = &get_instance();
        $CI->db->where('id', $user_id);
        $CI->db->set('message',$notification_eng);
        $CI->db->set('message_hin',$notification_hin);

        $CI->db->update('users');

        //echo $CI->db->last_query(); die;
        
    }
}


/**
 * @function totalNotifications
 * @purpose to count total notifications
 * @created 05May2015
 */
if (!function_exists('totalNotifications')) {
    function totalNotifications($for_user = null)
    {
        $CI = &get_instance();
        $user_id = currUserId();
        $con_query = " ";
        if (isExecutive()) {
            $con_query = "AND notifications.user_id = $user_id";
        }
        $query = $CI->db->query("SELECT COUNT(*) as total FROM `notifications` WHERE `for_user`=$for_user " .
            $con_query . " AND `id` NOT IN (SELECT `notification_id` FROM `notification_activities` where `user_id`=$user_id)");
        return $query->row()->total;
    }
}
/**
 * @function getNotifications
 * @purpose to get total notifications
 * @created 05May2015
 */
if (!function_exists('getNotifications')) {
    function getNotifications($for_user = null)
    {
        $CI = &get_instance();
        $user_id = currUserId();
        $CI->db->select('notifications.*,notification_activities.id as activity_id');
        $CI->db->from('notifications');
        $CI->db->join('notification_activities',
            "notification_activities.notification_id = notifications.id AND notification_activities.user_id=$user_id",
            'left');
        $CI->db->where('for_user', $for_user);
        if (isExecutive()) {
            $CI->db->where('notifications.user_id', $user_id);
        }
        $CI->db->order_by('notifications.id', 'desc');
        $CI->db->group_by('notifications.id');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
//-------------------------------------------Notification Functions End----------------------------------------------
/**
 * @Function _ajaxLayout
 * @purpose load layout page 
 * @created  3 dec 2014
 */
if (!function_exists('_ajaxLayout')) {
    function _ajaxLayout($data = null)
    {
        $CI = &get_instance();
        $CI->load->view('ajax_layout', $data);
    }
}

/**
 * @function getNotifications
 * @purpose to get total notifications
 * @created 05May2015
 */
if (!function_exists('getNewNotifications')) {
    function getNewNotifications($for_user = null)
    {
        $CI = &get_instance();
        $user_id = currUserId();
        $CI->db->select('notifications.*,notification_activities.id as activity_id');
        $CI->db->from('notifications');
        $CI->db->join('notification_activities',
            "notification_activities.notification_id = notifications.id AND notification_activities.user_id=$user_id",
            'left');
        $CI->db->where("(for_user=$for_user AND notifications.`id` NOT IN (SELECT `notification_id` FROM `notification_activities` where `user_id`=$user_id))");
        if (isExecutive()) {
            $CI->db->where('notifications.user_id', $user_id);
        }
        $CI->db->group_by('notifications.id');
        $CI->db->order_by('notifications.id', 'desc');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->row();
            /*foreach($result as $k=>$val){
            $result[$k]->user_id=currUserId();
            }*/
            $result->user_id = currUserId();
            $result->created = readable_date($result->created);
            return $result;
        }
        return false;
    }
}

function notificationType()
{
    $array = array('1' => 'Data Entry', '2' => 'User Assigned');
    return $array;
}

function getExecutivesIdByCampaign($id = null)
{
    $CI = &get_instance();
    $CI->db->select('executive');
    $CI->db->from('assign_campaign');
    $CI->db->where('campaign_id', $id);
    $query = $CI->db->get();
    if ($query->num_rows()) {
        $result = $query->result();
        $array = array();
        foreach ($result as $val) {
            $array[] = $val->executive;
        }
        return $array;
    }
    return false;
}

if (!function_exists('_show404')) {
    function _show404()
    {
        $CI = &get_instance();
        $data['title'] = 'Error';
        $data['subTitle'] = 'Wrong Page';
        $data['page'] = 'error';
        _layout($data);
    }
}

if (!function_exists('getRecords')) {
    function getRecords($table = null, $fields = null, $conArr = null)
    {
        $CI = &get_instance();
        $CI->db->select("$fields", false);
        $CI->db->from($table);
        if ($conArr) {
            $CI->db->where($conArr);
        }
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

/**
 * @function dealStagesById
 * @purpose Deal Stages Name
 * @created 25June2015
 */
if (!function_exists('dealStagesById')) {
    function dealStagesById($stages = null)
    {
        $stages = @explode(',', $stages);
        $CI = &get_instance();
        $CI->db->select("id,stage_name");
        $CI->db->from("campaign_stages");
        $CI->db->where_in('id', $stages);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
if (!function_exists('get_stage_info')) {
    function get_stage_info($assigned_id = null, $contact_id = null,$companies_id = null)
    {
        $CI = &get_instance();
        $data['assigned_id'] = $assigned_id;
        $data['contact_id'] = $contact_id;
        $data['comment_type'] = '2';
        /*$member_type = $CI->input->post('member_type');
        if ($member_type == 'contact') {
            $data['member_type'] = '1';
        } else
            if ($member_type == 'company') {
                $data['member_type'] = '2';
            }*/
        //$data['comment_type'] = '2';
        $CI->db->order_by('id', 'desc');
        $query = $CI->db->get_where('campaign_activities', $data);
        //print_R($query->row()->deal_stage);
        //echo $CI->db->last_query();//die;
        if ($query->num_rows()) {
            $selected_stage = $query->row()->deal_stage;
            return dealStages($selected_stage)[0];
        }
        return dealStages(9)[0];;
    }
}
if (!function_exists('get_bookmark')) {
    function get_bookmark($assigned_id = null, $contact_id = null,$companies_id = null)
    {
        $CI = &get_instance();
        $data['assigned_id'] = $assigned_id;
        $data['contact_id'] = $contact_id;
        $member_type = $CI->input->post('member_type');
        if ($member_type == 'contact') {
            $data['member_type'] = '1';
        } else
            if ($member_type == 'company') {
                $data['member_type'] = '2';
            }
        $data['comment_type'] = '4';
        $CI->db->order_by('id', 'desc');
        $query = $CI->db->get_where('campaign_activities', $data);
        //print_R($query->row()->deal_stage);
        //echo $CI->db->last_query();//die;
        if ($query->num_rows()) {
            $bookmark = $query->row()->bookmark;
            return $bookmark;
        }
        return '0';
    }
}

if (!function_exists('getTags')) {
    function getTags()
    {
        $CI = &get_instance();
        $CI->db->select("id,tags_name");
        $CI->db->from("tags");
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

