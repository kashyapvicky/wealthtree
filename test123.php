<?php

/* * **
 *  Project Name : NewsCode
 *  Created By : Prakash Kadiya
 *  Date : 09-11-2017
 *  Version : V4
 *  Description : All story related function and queries you can find in this file.
 *
 *  =============  API MAIN Function
 *  getSinglePost() : Get single post data
 *  getPostByURL() : Get postdata by post URL [Ex:From Twitter to our post by URL]
 *  getLocalPost() : Get local post with wishes and sliding story
 *  getPostByCategory : Get all post by category. You can add get multiple category post using this API
 *  addComment() : User add comment
 *  searchPost() :
 *
 *  _send_notification() :
 *  send_single_notification() :
 *
 *  ============  API Sub Function
 *  getPostCustomData() :
 *  getCommentsData() :
 *  getDistrictPincode() :
 *  getWishes() :
 *  getSlideStory() 
 *  getLanguageID() :
 *  my_comment_already_exists() :
 *  getSingleUser() :
 *  getMetaData() :
 *  advanced_custom_search() :
 *  list_searcheable_acf() :
 *
 *  getAllUserNotification () :
 *  getAllInstanceUserNotification() :
 *  getUsersByCategory() :
 *  getInstanceUsersByCategory() :
 *  getUsersByCategoryIOS() :
 *  getInstanceUsersByCategoryIOS() :
 *  getUserByZipcode() :
 *  getInstanceUserByZipcode() :
 *  getSingleNews() :
 *  getUserNotificationWithLanguage() :
 *  getInstanceUserNotificationWithLanguage() :
 *  getAdvertise() :
 *  postViewCount() :
 *  relatedPostLocalStory() :
 *  relatedPostByCategory() :
 *
 *  =============  WordPress Default Function Used
 *  get_permalink() : For post url
 *  get_post_custom() : For post custom meta value
 *  has_post_thumbnail : Check feature image of post
 *  get_the_post_thumbnail_url() : Get post image url by post ID
 *  get_post() :
 *  wp_get_post_categories() :
 *  get_category() :
 *  comments_open() :
 *  wp_insert_comment() :
 *  esc_like() :
 *
 * ** */

class postGeneral extends objGeneral {

    //-----------  This function contain single post data by post ID [Main API Function]
    function getTagPost($tagData) {
      //  print_r($tagData); die;
        //echo "hi"; die;
        global $dbh;
       // $tagData['language_id'] = '1';
        
        if (isset($tagData['page_no']) && !empty($tagData['page_no'])) {
            $startPageNo = $tagData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $page_no = 20 * ($startPageNo);
        
//        $query = "SELECT wp_terms.`term_id` AS TagID, wp_terms.`name` AS TagName, SUM( tax.`count` ) AS TagPostCount FROM nc_terms as `wp_terms` INNER JOIN nc_term_taxonomy tax ON tax.term_id = wp_terms.term_id
  //      where tax.taxonomy = 'post_tag' GROUP BY wp_terms.`term_id` limit 10, 10";
       // $query = "SELECT DISTINCT  p.id,tr.object_id, p.post_date, p.post_title, tt.taxonomy, t.slug, IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' )AS url
        $query = "SELECT DISTINCT  p.id, p.post_date, p.post_title,p.post_content
                            FROM nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON ( tr.term_taxonomy_id = tt.term_taxonomy_id )
                            LEFT JOIN nc_terms AS t ON ( tt.term_id = t.term_id )
                            WHERE tt.taxonomy = 'post_tag' AND t.slug = '".$tagData['tag']."' AND pm.meta_key = 'post_language' AND pm.meta_value = '".$tagData['language_id']."' LIMIT $page_no , 20";
      // echo $query ; die;
        $stmtPost = $dbh->prepare($query);
        $stmtPost->execute();
        $totalTagPost = $stmtPost->rowCount();
        $postTageData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
         //  echo "<pre>"; print_r($postTageData); die;
            foreach($postTageData as $key => $value){
               //echo "<pre>"; print_r($key); die;    
                $postTageData[$key]['featured_image']=$this->getPostFeatureImage($value['id']);                
                $postTageData[$key]['post_date']=$value['post_date'];                
                $postTageData[$key]['post_latitude'] = '';            
                $postTageData[$key]['post_longitude'] = '';            
                $postTageData[$key]['story_type'] = '';            
                $postTageData[$key]['story_position'] = '';            
                $postTageData[$key]['post_pincode'] = '';            
                $postTageData[$key]['post_city'] = '';            
                $postTageData[$key]['cat_id'] = '';            
                $postTageData[$key]['video_story'] = '';            
                $postTageData[$key]['post_video_url'] = '';            
                $postTageData[$key]['author_id'] = '';            
                $postTageData[$key]['author_name'] = '';            
                $postTageData[$key]['author_url'] = '';            
                $postTageData[$key]['comments'] = array();            
                $postTageData[$key]['comment_count'] = '';            
            }
            $tagPostData['tageData']= $postTageData;
            $tagPostData['totalTagPost']= $totalTagPost;
            
            //echo "<pre>"; print_r($postTageData); die;
            return $tagPostData;
    }
    
    function extraTab($arrDataPosted) {
       // echo "<pre>qq"; print_r($arrDataPosted); die;
        // echo "bsdbg"; die; 
        global $dbh;
        $cat_id = $arrDataPosted['cat_id'];
        $languageID = $arrDataPosted['language_id'];
        $page_no = 12 * ($arrDataPosted['page_no']);
        $catPost = "SELECT 
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url,
							t.term_id as cat_id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $cat_id . ")							
                            AND p.post_type = 'post' 
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                             GROUP BY p.id ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
       // echo $catPost; die;
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
       // echo $totalPost; die;
        $data = array();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
           // $data = $postData;
            foreach ($postData as $keyPost => $valuePost) {
                    $data[$keyPost]['id'] = $valuePost['id'];
                    $data[$keyPost]['post_date'] = $valuePost['post_date'];
                    $data[$keyPost]['post_title'] = $valuePost['post_title'];
                    $data[$keyPost]['post_content'] = $valuePost['post_content'];
                    $data[$keyPost]['url'] = $valuePost['url'];    
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                $data[$keyPost]['post_video_url'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_video_url") {
                        $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                    }
                    if (empty($data[$keyPost]['post_video_url'])) {
                        $data[$keyPost]['post_video_url'] = '';
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
               // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                
                if (!empty($authorData)) {
                    if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                         unset($data[$keyPost]['author_id']);
                        $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                    }else{
                       $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                    }
                    $data[$keyPost]['author_name'] = $authorData['author_name'];
                    $data[$keyPost]['author_url'] = $authorData['author_url'];

                } else {
                    $data[$keyPost]['author_name'] = "";
                    $data[$keyPost]['author_url'] = "";
                    $data[$keyPost]['author_id'] = "";
                }
                
                //----------- Category Return By post
                /* $categoryList = $this->getCategoryIDList($valuePost['id']);
                  //echo print_r($categoryList); die;
                  $matchCat = array_intersect($category, $categoryList);
                  if(count($category)> 1) {
                  if(in_array(JHARKHAND_STATE,$categoryList) ){
                  $data[$keyPost]['cat_id'] = JHARKHAND_STATE;
                  }else if(in_array(KARNATAKA_STATE,$categoryList) ){
                  $data[$keyPost]['cat_id'] = KARNATAKA_STATE;
                  }else if(in_array(TRENDING_CATEGORY,$categoryList) ){
                  $data[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                  }else if(in_array(NATIONAL_CATEGORY,$categoryList) ){
                  $data[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                  }else{
                  $matchCat = array_intersect($category, $categoryList);
                  if(!empty($matchCat)) {
                  $data[$keyPost]['cat_id'] = $matchCat[0];
                  }else{
                  $data[$keyPost]['cat_id'] = "";
                  }
                  }
                  }else{
                  if(in_array($arrPostData['cat_id'],$categoryList)){
                  $data[$keyPost]['cat_id'] = $arrPostData['cat_id'];
                  }else{
                  $data[$keyPost]['cat_id'] = "";
                  }
                  } */
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;
                $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                $data[$keyPost]['comment_count'] = $commentsDataCount;

                /* $postURL = get_permalink($valuePost['id']);
                  if(!empty($postURL)) {
                  $data[$keyPost]["url"] = $postURL;
                  }else{
                  $data[$keyPost]["url"] = "";
                  }
                  $postCustom = get_post_custom($valuePost['id']);
                  if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                  $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                  }else{
                  $data[$keyPost]['post_longitude'] = "";
                  }
                  if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                  $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                  }else{
                  $data[$keyPost]['post_latitude'] = "";
                  }
                  //------------- Get Featured Image
                  if (has_post_thumbnail($valuePost['id'])) {
                  $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                  $data[$keyPost]['featured_image'] = $featured_image;
                  } else {
                  $data[$keyPost]['featured_image'] = '';
                  }
                  // ------- Comments
                  $commentsData = $this->getCommentsData($valuePost['id']);
                  $data[$keyPost]['comments'] = $commentsData; */
                //------------- Remove
            }
            $generalData ['extraTab'] = $data;
            return $generalData;
           // echo "<pre>--extra--"; print_r($generalData); die;
        }
    }
    function updateAppVersion($appVersion) {
        
        global $dbh;
        //echo "kf"; die;
        //echo $appVersion.'--'. APP_VERSION ; die;
        //if ($appVersion <= APP_VERSION) {
        if (APP_VERSION <= $appVersion) {
           // echo "jfkkkk"; die;
            $res = array('show_update' => 'false', 'force_upgrade' => 'false');
          //  return $res;
        } else {
            //echo "jf"; die;
            $nv = APP_VERSION- $appVersion ;
                   // echo $nv; die;
           // if (($appVersion - APP_VERSION ) >= .02) {
            if (( APP_VERSION -$appVersion) >= .05) {
               //  echo "iiii"; die;
                $res = array('show_update' => 'true', 'force_upgrade' => FORCE_UPDATE);
               // return $res;
            } else {
              //  echo "ee"; die;
                $res = array('show_update' => 'false', 'force_upgrade' => 'false');
               // return $res;
            }
        }
        $query = "SELECT heading FROM nc_headings where id = 33";
        $stmtPost = $dbh->prepare($query);
        $stmtPost->execute();
        $heading = $stmtPost->fetch(PDO::FETCH_ASSOC);
      //  echo "<pre>----"; print_r($heading); die;
        $res['clear_pref']= CLEAR_PREF;
        $res['clear_code']= CLEAR_CODE;
        $res['event_cat_id']= TAB_CAT_ID;
        $res['event_title']= $heading['heading'];
        $res['event_name']= EVENT_NAME;
        $res['show_event']= SHOW_TAB;
        $res['is_image']= false;
        if($res['is_image']== true){
            $res['image_url'] = SITEURL.'api/v11/shravani_app.png';
        }else{
            $res['image_url'] = '';
        }        
        return $res;
    }

    function readingStoryInsert($readership) {
        global $dbh;
        for ($i = 0; $i < count($readership); $i++) {
            $storyRead = $readership[$i];
            // Check data exist or not
            $query = "SELECT user_id FROM nc_stories_readership WHERE user_id = " . $storyRead['user_id'] . " AND story_id = " . $storyRead['story_id'] . " AND date(read_datetime) = '" . date('Y-m-d', strtotime($storyRead['date'])) . "' ";
            $stmtPost = $dbh->prepare($query);
            $stmtPost->execute();
            $total = $stmtPost->rowCount();
            $stmtPost = null; // doing this is mandatory for connection to get closed
            $dbh = null;
            //echo $total; die;
            if ($total > 0) {
                $lastInsertId = "1";
            } else {
                /* ------ Get district name from nc_districts table start---- */
                //  $pincodeArray = explode(',',$storyRead['pincode']);
                if (strlen($storyRead['pincode']) > 0) {
                    $adverties_analytics = "SELECT district FROM nc_districts where pincode IN (" . $storyRead['pincode'] . ") group by district";
                    $stmtPost = $dbh->prepare($adverties_analytics);
                    $stmtPost->execute();
                    $total = $stmtPost->rowCount();
                    $districtData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
                    //  echo "<pre>"; print_r($districtData); die;
                    $districtArray = array();
                    foreach ($districtData as $result) {
                        $districtArray[] = $result['district'];
                    }
                    //   echo "<pre>"; print_r(array_unique($districtArray)); die;
                    $districtName = implode(',', $districtArray);
                    // echo $districtName; die;
                } else {
                    $districtName = '';
                }
                //echo $districtName."<br>";

                /* ------ Get district name from nc_districts table end---- */

/* 
                $sqlPostCountInsert = $dbh->prepare("INSERT INTO `nc_stories_readership`
                                                    (`user_id`,
                                                     `story_id`,
                                                     `read_datetime`,
                                                     `state`,
                                                     `district`,
                                                     `device`,
                                                     `ip_address`,
                                                     `post_title`
                                                     )
                                        VALUES     ( :user_id,
                                                     :story_id,
                                                     :read_datetime,
                                                     :state,
                                                     :district,
                                                     :device,
                                                     :ip_address,
                                                     :post_title
                                                     )"); */
				$sqlPostCountInsert = $dbh->prepare("INSERT INTO `nc_stories_readership`
                                                    (`user_id`,
                                                     `story_id`,
                                                     `read_datetime`,
                                                     `state`,
                                                     `district`,
                                                     `device`,
                                                     `post_title`
                                                     )
                                        VALUES     ( :user_id,
                                                     :story_id,
                                                     :read_datetime,
                                                     :state,
                                                     :district,
                                                     :device,
                                                     :post_title
                                                     )");

                $sqlPostCountInsert->execute(array(
                    ":user_id" => $storyRead['user_id'],
                    ":story_id" => $storyRead['story_id'],
                    ":read_datetime" => $storyRead['date'],
                    ":state" => $storyRead['state'],
                    ":district" => $districtName,
                    ":device" => $storyRead['device'],
                   // ":ip_address" => $storyRead['ip_address'],
                    ":post_title" => $storyRead['post_title']
                ));
                $lastInsertId = $dbh->lastInsertId();
                //  echo $lastInsertId; die;
            }
        }
        //  echo $lastInsertId; die;
        return $lastInsertId;
    }

     function eventAnalyticsInsert($story_array) {
        // echo "<pre>dsd"; print_r($story_array); die;
          global $dbh;
         // echo count($story_array); die;
          for ($i = 0; $i < count($story_array); $i++) {
              $res = $story_array[$i];
               
                /*------ New table----*/
				$eventData[0]['story_count']= '';
					$event_analytics = "SELECT id, cta_type,story_count FROM nc_event_analytics where post_id = ".$res['post_id']." AND user_id = ".$res['user_id']." AND  cta_type =".$res['cta_type']." AND date='".$res['date']."' AND device_type='Android'";
				 //   echo $event_analytics; die;
					$stmtPost = $dbh->prepare($event_analytics);
					$stmtPost->execute();
					$total = $stmtPost->rowCount();
					$eventData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
				   // echo "<pre>"; print_r($res); die; 
                if(count($eventData)<=0)   { 
                    $sqlPostCountInsert = $dbh->prepare("INSERT INTO `nc_event_analytics`
                                                                    (`user_id`,
                                                                     `title`,
                                                                     `date`,
                                                                     `state`,
                                                                     `cta_type`,
                                                                     `story_count`,
                                                                     `user_type`,
                                                                     `post_id`,
                                                                     `device_type`,
                                                                     `event_name`
                                                                     )
                                                VALUES    ( :user_id,
                                                            :title,
                                                            :date,
                                                            :state,
                                                            :cta_type,
                                                            :story_count,
                                                            :user_type,
                                                            :post_id,
                                                            :device_type,
                                                            :event_name
                                                            )");
                    $sqlPostCountInsert->execute(array(
                        ":user_id" => $res['user_id'],
                        ":title" => $res['title'],
                        ":date" => $res['date'],
                        ":state" => $res['state'],
                        ":cta_type" => $res['cta_type'],
                        ":story_count" => 1,
                        ":user_type" => $res['user_type'],
                        ":post_id" => $res['post_id'],
                        ":device_type" => $res['device_type'],
                        ":event_name" => $res['event_name']
                    ));
                   // var_dump($sqlPostCountInsert); die;
                }else{                   
                    $story_count = $eventData[0]['story_count']+1;
                        $updateEventAnalyticsCount = "UPDATE nc_event_analytics SET  story_count = '" . $story_count. "' WHERE id = '".(int)$eventData[0]['id']."'";
                  //  echo $updateAdvertiesAnalyticsCount; die;
                    $dbh->query($updateEventAnalyticsCount); 
                }
          }
           $lastInsertId = "1";
           return $lastInsertId;
     }
     function advertiesAnalyticsInsert($ads_array) {
        //	echo "<pre>"; print_r($ads_array); die;
        global $dbh;

//        for ($i = 0; $i < count($ads_array); $i++) {
//            $res = $ads_array[$i];
//            /*             * **	
//              user_type = 1=>Instance User,2=>Normal User
//              banner_type = 1=>Top Banner,2=>Bottom Banner,3=>Interstitial Banner,4=>detail Banner
//              cta_type - 1=>click,2=>view
//             * ** */
//
//       /*     // check for not insert duplicate entry in database
//			$adverties_analytics = "SELECT date FROM nc_adverties_analytics WHERE adverties_id = " . $res['adverties_id'] . " AND user_id = " . $res['user_id'] . " AND date = '" . $res['date'] . "' AND cta_type = " . $res['cta_type'] . " AND banner_type = " . $res['banner_type'] . " AND user_type = " . $res['user_type'] . " ";
//
//            $stmtPost = $dbh->prepare($adverties_analytics);
//            $stmtPost->execute();
//            $total = $stmtPost->rowCount();
//            //echo "total--".$total;
//            if ($total > 0) {
//                //$lastInsertId = "1";			
//            } else {*/
//                //echo "lkjg"."<br>"; //die;
//
//                /* ------ Get district name from nc_districts table start---- */
//
//                if (!empty($res['pincode'])) {
//                    $adverties_analytics = "SELECT district FROM nc_districts where pincode IN (" . $res['pincode'] . ") group by district";
//                    $stmtPost = $dbh->prepare($adverties_analytics);
//                    $stmtPost->execute();
//                    $total = $stmtPost->rowCount();
//                    $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
//                    $districtArray = array();
//                    foreach ($postData as $result) {
//                        $districtArray[] = $result['district'];
//                    }
//                    //	echo "<pre>"; print_r($districtArray); //die; 
//                    $districtName = implode(',', $districtArray);
//                } else {
//                    $districtName = '';
//                }
//                //echo $districtName."<br>";
//
//                /* ------ Get district name from nc_districts table end---- */
//				/*------ New table----*/
//				$adData[0]['ad_count']= '';
//					$adverties_analytics = "SELECT id, cta_type,ad_count FROM nc_adverties_analytics_improve where user_id = ".$res['user_id']." AND adverties_id = ".$res['adverties_id']." AND  cta_type =".$res['cta_type']." AND banner_type = ".$res['banner_type']." AND date='".$res['date']."'  AND pincode = '".$res['pincode']."'";
//				 //   echo $adverties_analytics; die;
//					$stmtPost = $dbh->prepare($adverties_analytics);
//					$stmtPost->execute();
//					$total = $stmtPost->rowCount();
//					$adData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
//				//    echo "<pre>"; print_r($adData); die; 
//                if(count($adData)<=0)   { 
//						$sqlPostCountInsert = $dbh->prepare("INSERT INTO `nc_adverties_analytics_improve`
//												(`adverties_id`,
//												`user_id`,
//												 `title`,
//												 `date`,
//												 `state`,
//												 `district`,
//												 `pincode`,
//												 `cta_type`,
//												 `ad_count`,
//												 `banner_type`,
//												 `user_type`
//												 )
//									VALUES     ( :adverties_id,
//												 :user_id,
//												 :title,
//												 :date,
//												 :state,
//												 :district,
//												 :pincode,
//												 :cta_type,
//												 :ad_count,
//												 :banner_type,
//												 :user_type
//												 )");
//                $sqlPostCountInsert->execute(array(
//                    ":adverties_id" => $res['adverties_id'],
//                    ":user_id" => $res['user_id'],
//                    ":title" => $res['title'],
//                    ":date" => $res['date'],
//                    ":state" => $res['state'],
//                    ":district" => $districtName,
//                    ":pincode" => $res['pincode'],
//                    ":cta_type" => $res['cta_type'],
//					":ad_count" => 1,
//                    ":banner_type" => $res['banner_type'],
//                    ":user_type" => $res['user_type']
//                ));
//				
//				}else{
//                   
//                    $ad_count = $adData[0]['ad_count']+1;
//                    $updateAdvertiesAnalyticsCount = "UPDATE nc_adverties_analytics_improve SET  ad_count = '" . $ad_count. "' WHERE id = '".(int)$adData[0]['id']."'";
//                  //  echo $updateAdvertiesAnalyticsCount; die;
//            $dbh->query($updateAdvertiesAnalyticsCount); 
//                }  
//               // $lastInsertId = $dbh->lastInsertId();
//                // echo $lastInsertId; die;
//           // }
//        }
        //die;
        $lastInsertId = "1";
        return $lastInsertId;
    }

    function getSinglePost($arrDataPosted) {
      //  echo "<pre>"; print_r($arrDataPosted); //die;
 
		//echo "<pre>"; print_r($arrDataPosted); die;
        // echo $arrDataPosted.'---'; //die;
               // $arrDataPosted['post_id']=$arrDataPosted;
               // echo $arrDataPosted; die;
               // echo "<pre>"; print_r($arrDataPosted['post_id']); die;
             //   echo $arrDataPosted['post_id']; die;
        global $dbh;
        $postData = array();
        $postDetail = array();
        $postDataCustom = array();
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        if(!empty($arrDataPosted['language_id'])){
            $languageID = $arrDataPosted['language_id'];
        }else{
            $languageID = 1;
        }
         if(!empty($arrDataPosted['cat_id'])){
            $cat_id = $arrDataPosted['cat_id'];
        }else{
            $cat_id = 15;
        }
      
      //  echo "dfsa"; die;
        //IFNULL(CONCAT('".SITEURL."',post_name,'/'),'' )AS url
        $stmtPost = $dbh->prepare("SELECT
            id,
            post_date,
            post_content,
            post_title,
            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
            FROM nc_posts
            WHERE ID = :ID AND
            post_type = :post_type AND
            post_status = :post_status
            ORDER BY ID DESC
            ");
       // echo $stmtPost ; die;
        //$arrPost = array(":ID" => $arrDataPosted['post_id'], ":post_type" => 'post', ":post_status" => 'publish');
            if (is_array($arrDataPosted) && array_key_exists("post_id",$arrDataPosted))
            {
                $arrPost = array(":ID" => $arrDataPosted['post_id'], ":post_type" => 'post', ":post_status" => 'publish');
            }
          else
            {
                $arrPost = array(":ID" => $arrDataPosted, ":post_type" => 'post', ":post_status" => 'publish');
            }
       
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
       // echo $totalPost ; die;
        $postDetail = array();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetch(PDO::FETCH_ASSOC);
           // echo "<pre>"; print_r($postData); die;
           // $postDataCustom = $this->getPostCustomData($arrDataPosted['post_id']);
            if (is_array($arrDataPosted) && array_key_exists("post_id",$arrDataPosted))
            {
                $postDataCustom = $this->getPostCustomData($arrDataPosted['post_id']);
            }
          else
            {
                $postDataCustom = $this->getPostCustomData($arrDataPosted);
            }            
//echo "<pre>pmmmm"; print_r($postDataCustom); die;
            $postDetail = array_merge($postData, $postDataCustom);
			
			if(!empty($arrDataPosted['pincode'])){	
			$advertiseList = array();
			//echo $arrPostData['pincode'] ; die;
			$advertiseList = $this->getAdvertise($arrDataPosted['pincode'], '', $languageID);
			
			if(!empty($advertiseList)){
					$postDetail['advertise'] = $advertiseList;
				}else{
					$postDetail['advertise'] = array();
				}
			}else{
				$advertiseList = array();
                $advertiseList = $this->getAdvertise('', $cat_id, $languageID);
				if(!empty($advertiseList)){
					$postDetail['advertise'] = $advertiseList;
				}else{
					$postDetail['advertise'] = array();
				}
			}
                     //   echo "<pre>pmmmm"; print_r($postDetail); die;
            return $postDetail;
        } else {
            $requestError = $this->generateRequestError("404", false, 13);
            echo json_encode($requestError);
            exit;
        }
    }

    //------------ Get Post by URL [Main API Function]
    function getPostByURL($arrDataPosted) {
		
        global $dbh;
		$postUrl = $arrDataPosted['post_url'];
        $stmtPost = $dbh->prepare("SELECT id,
            post_date,
            post_content,
            post_title,
            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
            FROM nc_posts
            WHERE post_name = :post_name AND
            post_type = :post_type AND
            post_status = :post_status
            ORDER BY ID DESC
            ");
        $arrPost = array(":post_name" => $postUrl, ":post_type" => 'post', ":post_status" => 'publish');
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        $postDetail = array();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetch(PDO::FETCH_ASSOC);
            $post_id = $postData['id'];
            $postDataCustom = $this->getPostCustomData($post_id);
            $postDetail = array_merge($postData, $postDataCustom);
			
			if(!empty($arrDataPosted['pincode'])){	
				$advertiseList = array();
                //echo $arrPostData['pincode'] ; die;
                $advertiseList = $this->getAdvertise($arrDataPosted['pincode'], '', $languageID);
                if(!empty($advertiseList)){
					$postDetail['advertise'] = $advertiseList;
				}else{
					$postDetail['advertise'] = array();
				}
			}else{
				$advertiseList = array();
              //  $advertiseList = $this->getAdvertise('', $arrDataPosted['cat_id'], $languageID);
               
				if(!empty($advertiseList)){
					$postDetail['advertise'] = $advertiseList;
				}else{
					$postDetail['advertise'] = array();
				}
			}
			
            return $postDetail;
        } else {
            $requestError = $this->generateRequestError("404", false, 75);
            echo json_encode($requestError);
            exit;
        }
    }

    //----------- For Post Custom Data
    function getPostCustomData($post_id) {
        $postData = array();
        $postImage = $this->getPostFeatureImage($post_id);
        if (!empty($postImage)) {
            $postData['featured_image'] = $postImage;
        } else {
            $postData['featured_image'] = "";
        }
        $postMetaData = $this->gePostMetaData($post_id);
        $postData['post_longitude'] = "";
        $postData['post_latitude'] = "";
        $postData['post_pincode'] = "";
        $postData['post_language'] = "";
        foreach ($postMetaData as $keyUser => $valueData) {
            if ($valueData['meta_key'] == "post-map-longitude-data") {
                $postData['post_longitude'] = $valueData['meta_value'];
            }
            if ($valueData['meta_key'] == "post-map-latitude-data") {
                $postData['post_latitude'] = $valueData['meta_value'];
            }
            if ($valueData['meta_key'] == "post-pin-code") {
                $postData['post_pincode'] = $valueData['meta_value'];
            }
            if ($valueData['meta_key'] == "post_language") {
                $postData['post_language'] = $valueData['meta_value'];
            }
        }
        //------------ Author Data
        $authorData = $this->getAuthorData($post_id);
        if (!empty($authorData)) {
            $postData['author_id'] = $authorData['author_id'];
            $postData['author_name'] = $authorData['author_name'];
            $postData['author_url'] = $authorData['author_url'];
        } else {
            $postData['author_id'] = "";
            $postData['author_name'] = "";
            $postData['author_url'] = "";
        }

        // ------- Get Category
        $cats = array();
        $cats = $this->getCategoryDataByPost($post_id);
    //    $postData['categories'] = $cats[0]['cat_id'];  // change for requirement array to single value
        $postData['cat_id'] = $cats[0]['cat_id'];
        //------- Get Comments
        $commentsData = array();
        $commentsData = $this->getCommentsData($post_id);
        $postData['comments'] = $commentsData;
        return $postData;
        //------------- Get Post URL
        /* $postURL = get_permalink($post_id);
          if (!empty($postURL)) {
          $postData['url'] = $postURL;
          } else {
          $postData['url'] = "";
          }
          //------------- Get Featured Image
          if (has_post_thumbnail($post_id)) {
          $featured_image = get_the_post_thumbnail_url($post_id, 'full');
          $postData['featured_image'] = $featured_image;
          } else {
          $postData['featured_image'] = '';
          }
          $postCustom = get_post_custom($post_id);
          if (isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])) {
          $postData['post_longitude'] = $postCustom['post-map-longitude-data'][0];
          } else {
          $postData['post_longitude'] = "";
          }
          if (isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])) {
          $postData['post_latitude'] = $postCustom['post-map-latitude-data'][0];
          } else {
          $postData['post_latitude'] = "";
          }
          if (isset($postCustom['post-pin-code']) && !empty($postCustom['post-pin-code'][0])) {
          $postData['post_pincode'] = $postCustom['post-pin-code'][0];
          } else {
          $postData['post_pincode'] = "";
          }
          if (isset($postCustom['post_language']) && !empty($postCustom['post_language'][0])) {
          $postData['post_language'] = $postCustom['post_language'][0];
          } else {
          $postData['post_language'] = "";
          }
          // ------- Get Category
          $cats = array();
          $cats = $this->getCategoryDataByPost($post_id);
          $postData['categories'] = $cats;
          //------- Get Comments
          $commentsData = array();
          $commentsData = $this->getCommentsData($post_id);
          $postData['comments'] = $commentsData;
          return $postData; */
    }

    function getAuthorData($post_id) {
        global $dbh;
        $getUser = "SELECT p.ID,p.post_title as author_name,pm.meta_value as author_id, IFNULL(CONCAT('" . SITEURL . "author/',p.post_title,'/'),'' )AS author_url  FROM  nc_posts as p left join nc_postmeta as pm on pm.post_id = p.ID WHERE  p.ID = $post_id AND pm.meta_value != '' AND meta_key='_molongui_guest_author_id'";
	$stmtUser = $dbh->prepare($getUser);
        $stmtUser->execute();
        $totalUser = $stmtUser->rowCount();
        if($totalUser>0){
            $postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);        
            
            //get guest author name
            $guest_author_id = $postUser['author_id'];
            $getUser = "SELECT p.ID as author_id,p.post_title as author_name, IFNULL(CONCAT('" . SITEURL . "author/',p.post_title,'/'),'') AS author_url from nc_posts as p where p.ID = $guest_author_id ";
            $stmtUser = $dbh->prepare($getUser);
            $stmtUser->execute();
            $totalUser = $stmtUser->rowCount();
            if($totalUser>0){
                $postGuestUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
               // echo "<pre>"; print_r($postGuestUser); die;
                return $postGuestUser;
            }
            
        }else{
             $getUser = "SELECT u.ID as author_id, u.display_name as author_name,
                        IFNULL(CONCAT('" . SITEURL . "author/',u.user_nicename,'/'),'' )AS author_url
                            FROM  `nc_users` AS u LEFT JOIN `nc_posts` AS p ON p.post_author  = u.ID
                            WHERE p.ID = " . $post_id . "";
            $stmtUser = $dbh->prepare($getUser);
            $stmtUser->execute();
            $totalUser = $stmtUser->rowCount();
            if ($totalUser > 0) {
                $postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
                return $postUser;
            } else {
                return false;
            }
        }
    }
    
    function getAuthorDataByPostID($author_id,$post_id ='') {
   // echo $author_id.'---';    echo $post_id; die;
    //     ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
   global $dbh;
	$getUser = "SELECT p.ID,p.post_title as author_name
	 FROM  nc_posts as p left join nc_postmeta as pm on pm.post_id = p.ID
                        WHERE pm.meta_key = '_molongui_guest_author' AND pm.meta_value = '1' AND p.ID = $post_id ";
		 $stmtUser = $dbh->prepare($getUser);
        $stmtUser->execute();
        $totalUser = $stmtUser->rowCount();
       // echo $totalUser; die;
        if ($totalUser > 0) {
          //  echo "dsf"; die;
		   /// geust author code
		   
					$getUser = "SELECT p.ID,pm.meta_value as guest_author_id  FROM  nc_posts as p left join nc_postmeta as pm on pm.post_id = p.ID WHERE  p.ID = $post_id AND pm.meta_value != '' AND meta_key='_molongui_guest_author_id'";
					 $stmtUser = $dbh->prepare($getUser);
					$stmtUser->execute();
					$totalUser = $stmtUser->rowCount();
                                      //  echo "ii--".$totalUser; //die;
                                    if ($totalUser > 0) {
                                            $postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
                                      //  echo "<pre>ggggg";            print_r($postUser); //die;
                                        $gust_user_id = $postUser['guest_author_id'];
                                        $getUser = "SELECT ID as author_id,post_title as author_name,IFNULL(CONCAT('" . SITEURL . "author/',post_title,'/'),'' )AS author_url  FROM  "
                                                . "nc_posts WHERE  ID = $gust_user_id";
					$stmtUser = $dbh->prepare($getUser);
					$stmtUser->execute();
					$totalUser = $stmtUser->rowCount();
                                            if ($totalUser > 0) {
                                                    $postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
                                                     $postUser['guest_user'] = 'guest';
                                                    //echo "<pre>rrrrr";            print_r($postUser); die;
                                                   
                                                    return $postUser;
                                            } else {
                                                    return false;
                                            }
                                    }
					
		}else{
                   // echo "ddd"; die;
			$getUser = "SELECT ID as author_id,display_name as author_name,
                    IFNULL(CONCAT('" . SITEURL . "author/',user_nicename,'/'),'' )AS author_url
                        FROM  `nc_users`
                        WHERE ID = " . $author_id . "";
                      //  echo $getUser; die;
			$stmtUser = $dbh->prepare($getUser);
			$stmtUser->execute();
			$totalUser = $stmtUser->rowCount();
			if ($totalUser > 0) {
				$postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
				
                                $postUser['register_user'] = 'register_user';
                                //echo "<pre>rrrrr";            print_r($postUser); die;
				return $postUser;
			} else {
				return false;
			}
		}				

    } 

    function getAuthorDataByID($author_id) {
        global $dbh;
        $getUser = "SELECT ID as author_id,display_name as author_name,
                    IFNULL(CONCAT('" . SITEURL . "author/',user_nicename,'/'),'' )AS author_url
                        FROM  `nc_users`
                        WHERE ID = " . $author_id . "";
        $stmtUser = $dbh->prepare($getUser);
        $stmtUser->execute();
        $totalUser = $stmtUser->rowCount();
        if ($totalUser > 0) {
            $postUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
            return $postUser;
        } else {
            return false;
        }
    }

    //--------- Get Post Feature image URL
    function getPostFeatureImage($post_id) {
        global $dbh;
        $catPost = "SELECT concat((select option_value from nc_options where option_name ='siteurl'  limit 1),'/wp-content/uploads/',childmeta.meta_value)
FROM nc_postmeta childmeta
INNER JOIN nc_postmeta parentmeta ON (childmeta.post_id=parentmeta.meta_value)
WHERE parentmeta.meta_key='_thumbnail_id' and childmeta.meta_key = '_wp_attached_file'
        AND parentmeta.post_id = " . $post_id . "";
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $image = $stmtPost->fetchColumn();
        if (!empty($image)) {
            $postImage = $image;
        } else {
            $postImage = "";
        }
        return $postImage;
    }

    //--------- Get Post meta data
    function gePostMetaData($post_id) {
        global $dbh;
        $stmtPost = $dbh->prepare('SELECT *
        FROM nc_postmeta
        WHERE post_id = :post_id');
        $arrPost = array(":post_id" => $post_id);

        $stmtPost->execute($arrPost);
        $postDetail = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        //echo "<pre>"; print_r($postDetail);
        return $postDetail;
    }

    //--------- Get Post Category By Post ID
    function getCategoryDataByPost($post_id) {
        global $dbh;

        /* $catPost = "select t.term_id as cat_id,t.name,t.slug from nc_terms t, nc_term_taxonomy tt, nc_term_relationships tr
          where t.term_id=tt.term_id AND tt.term_taxonomy_id=tr.term_taxonomy_id and tr.object_id= ".$post_id.""; */
        $catPost = "SELECT t.term_id as cat_id,t.name,t.slug
                        FROM  `nc_terms` t
                        JOIN  `nc_term_taxonomy` tt ON ( t.`term_id` = tt.`term_id` )
                        JOIN  `nc_term_relationships` ttr ON ( ttr.`term_taxonomy_id` = tt.`term_taxonomy_id` )
                        WHERE tt.`taxonomy` =  'category'
                        AND ttr.`object_id` =" . $post_id . "";

        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalCategory = $stmtPost->rowCount();
        if ($totalCategory > 0) {
            $cats = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $cats = array();
        }
        return $cats;
        /* $post_categories = wp_get_post_categories($post_id);
          if (count($post_categories) > 0) {
          $cats = array();
          foreach ($post_categories as $c) {
          $cat = get_category($c);
          $cats[] = array('cat_id' => $cat->cat_ID, 'name' => $cat->name, 'slug' => $cat->slug);
          }
          } else {
          $cats = array();
          } */
    }

    //-----------  Get post comment data
    function getCommentsData($post_id) {
        global $dbh;
        $stmtComment = $dbh->prepare('SELECT
                        comment_id,
                        comment_post_id,
                        comment_author,
                        comment_author_email,
                        comment_author_url,
                        comment_author_ip,
                        comment_date,
                        comment_content,
                        comment_karma,
                        comment_approved,
                        comment_type,
                        comment_agent,
                        user_id
                        FROM nc_comments
                        WHERE comment_post_id = :comment_post_id AND comment_approved = :comment_approved
                        ');
        $arrComment = array(":comment_post_id" => $post_id, ":comment_approved" => 1);
        $stmtComment->execute($arrComment);
        $totalComment = $stmtComment->rowCount();

        if ($totalComment > 0) {
            $commentsData = $stmtComment->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $commentsData = array();
        }
        return $commentsData;
    }
    
    
     //-----------  Get post comment count
    function getCommentsDataCount($post_id) {
       
        global $dbh;
        $stmtComment = $dbh->prepare('SELECT
                        comment_id,
                        comment_post_id,
                        comment_author,
                        comment_author_email,
                        comment_author_url,
                        comment_author_ip,
                        comment_date,
                        comment_content,
                        comment_karma,
                        comment_approved,
                        comment_type,
                        comment_agent,
                        user_id
                        FROM nc_comments
                        WHERE comment_post_id = :comment_post_id AND comment_approved = :comment_approved
                        ');
        $arrComment = array(":comment_post_id" => $post_id, ":comment_approved" => 1);
        $stmtComment->execute($arrComment);
        $totalComment = $stmtComment->rowCount();
     return $totalComment ; 

    }

    //----------- Get Local Post data by pinCode ,Wishes data [Main API Function]
    function getLocalPost($arrPostData, $totalCount) {
        //	print_r($arrPostData); die;
        global $dbh;
        //  $pinCode = explode(',',$arrPostData['pincode']);
        $pinCode = $arrPostData['pincode'];
        //echo count($pinCode); die;
        if (isset($arrPostData['page_no']) && !empty($arrPostData['page_no'])) {
            $startPageNo = $arrPostData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $page_no = 12 * ($startPageNo);
        $page_no_special_story = 4 * ($startPageNo); // local story news
        if (count($pinCode) > 0) {
            $total = count($pinCode);
            $resultGetPincode = array();
            //----------- Get All PinCode From Given PinCode
            $resultGetPincode = $this->getDistrictPincode($arrPostData['pincode']);
            //print_r($resultGetPincode); die;
            $resultPinCodeList = array();
            foreach ($resultGetPincode as $resPinCode) {
                $resultPinCodeList[] = $resPinCode['pincode'];
            }
            $resultAllPinCode = implode(',', $resultPinCodeList);
            //---------------- Pinning Story ID List
            $pinningStoryIDList = $this->getPinningStoryPostIds($arrPostData['pincode'], '', $arrPostData['language_id']);
            //print_r($pinningStoryIDList); die;
            $subQry = "";
            if (!empty($pinningStoryIDList)) {
                $subQry = " AND p.id NOT IN (" . $pinningStoryIDList . ") ";
            }
            //----------------
            $getLocalPost = "SET @search = '$resultAllPinCode';";
            $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                        FROM nc_posts AS p";
            $catPost .= " LEFT JOIN nc_postmeta AS pm ON pm.post_id = p.id ";
            $catPost .= " WHERE (pm.meta_key = 'post-pin-code' AND pm.meta_value REGEXP CONCAT('(^|,)(', REPLACE(@search, ',', '|'), ')(,|$)')) $subQry  AND p.post_type = 'post' AND p.post_status = 'publish' ORDER BY p.post_date DESC,(pm.meta_key = 'post-pin-code'  AND pm.meta_value IN (" . $arrPostData['pincode'] . ")) ASC LIMIT $page_no , 12";
            $stmtLocalPost = $dbh->prepare($getLocalPost);
            $stmtLocalPost->execute();
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            $generalData = array();
            if ($totalPost > 0) {
                $data = array();
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
               // $data = $postData;
                foreach ($postData as $keyPost => $valuePost) {
                    $data[$keyPost]['id'] = $valuePost['id'];
                    $data[$keyPost]['post_date'] = $valuePost['post_date'];
                    $data[$keyPost]['post_title'] = $valuePost['post_title'];
                    $data[$keyPost]['post_content'] = $valuePost['post_content'];
                    $data[$keyPost]['url'] = $valuePost['url']; 
                    //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                    //------------- Remove
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    $data[$keyPost]['post_video_url'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_video_url") {
                            $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                        } 
                        if(empty($trendingData[$keyPost]['post_video_url'])){
                                    $trendingData[$keyPost]['post_video_url'] = '';
                                }
                    }
                    $data[$keyPost]['cat_id'] = 99999; //Static Number Return As per android developer requirement
                    //------------ Author Data
                    $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
                   // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($data[$keyPost]['author_id']);
                            $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                        $data[$keyPost]['author_id'] = "";
                    }
                    
                    //------- Get Comments
                    $commentsData = array();
                     $commentsData = $this->getCommentsData($valuePost['id']);
                    $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                    $data[$keyPost]['comments'] = $commentsData;
                    $data[$keyPost]['comment_count'] = $commentsDataCount;

                    // ------- Get Category
                    //$cats = array();
                    //$cats = $this->getCategoryDataByPost($valuePost['id']);
                    //$data[$keyPost]['categories'] = $cats;
                    //------- Get Comments
                    //$commentsData = array();
                    //$commentsData = $this->getCommentsData($valuePost['id']);
                    //$data[$keyPost]['comments'] = $commentsData;
                    /* $postURL = get_permalink($valuePost['id']);
                      if(!empty($postURL)) {
                      $data[$keyPost]["url"] = $postURL;
                      }else{
                      $data[$keyPost]["url"] = "";
                      }
                      $postCustom = get_post_custom($valuePost['id']);
                      if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                      $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                      }else{
                      $data[$keyPost]['post_longitude'] = "";
                      }
                      if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                      $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                      }else{
                      $data[$keyPost]['post_latitude'] = "";
                      }
                      //------------- Get Featured Image
                      if (has_post_thumbnail($valuePost['id'])) {
                      $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                      $data[$keyPost]['featured_image'] = $featured_image;
                      } else {
                      $data[$keyPost]['featured_image'] = '';
                      }
                      // ------- Comments
                      $commentsData = $this->getCommentsData($valuePost['id']);
                      $data[$keyPost]['comments'] = $commentsData; */
                    //------------- Remove
                    // ------- Category
                    //$cats = $this->getCategoryDataByPost($valuePost['id']);
                    //$data[$keyPost]['categories'] = $cats;
                }
                $generalData['mainStoryData'] = $data;
                //----------- Get WishesList
                $whishedList = array();
                if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                    $whishedList = $this->getWishes($arrPostData['language_id'],'',$pinCode);
                }
                $generalData['whishesData'] = $whishedList;

                //----------- Get Trending Story start
                // echo $page_no; die;
                if ($page_no == 0) {
                    $languageID = $arrPostData['language_id'];
                    $trendingCatList = '5832,53,63';
                    //echo "<pre>"; print_r($trendingCatList); die;  
                    $trendingData = array();
                    $trendingCatPost = "SELECT DISTINCT
							p.id,
							p.post_date,
							p.post_content,
							p.post_title,
							p.post_author as author_id,
							IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
							FROM
							nc_posts AS p
							LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
							LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
							LEFT JOIN nc_term_taxonomy AS tt ON (
												tr.term_taxonomy_id = tt.term_taxonomy_id
											  )
							LEFT JOIN nc_terms AS t ON (
												tt.term_id = t.term_id
											)
							
							WHERE
							tt.taxonomy = 'category'
							$subQry
							AND  tt.term_id IN (" . $trendingCatList . ")
							AND p.post_type = 'post'
							AND p.post_status = 'publish' AND (pm.post_id IN(select pm.post_id as postmetaid from nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id where p.post_type = 'post' AND p.post_status = 'publish' AND meta_key = 'post_language' AND meta_value = " . $languageID . " ORDER BY p.post_date DESC)) AND pm.meta_key = 'post_video_url' AND pm.meta_value != ''
							ORDER BY
							p.post_date DESC LIMIT $page_no , 10";



                    //echo $trendingCatPost; die;

                    $trendingStmtPost = $dbh->prepare($trendingCatPost);
                    $trendingStmtPost->execute();
                    $totalPost = $trendingStmtPost->rowCount();
                    //$totalPost; die;					
                    if ($totalPost > 0) {
                        $postData = $trendingStmtPost->fetchAll(PDO::FETCH_ASSOC);
                       // $trendingData = $postData;
                        //	print_r($trendingData); die;
                        // ----- Total Count
                        foreach ($postData as $keyPost => $valuePost) {
                            //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                            //------------- Remove
                            
                            $trendingData[$keyPost]['id'] = $valuePost['id'];
                            $trendingData[$keyPost]['post_date'] = $valuePost['post_date'];
                            $trendingData[$keyPost]['post_title'] = $valuePost['post_title'];
                            $trendingData[$keyPost]['post_content'] = $valuePost['post_content'];
                            $trendingData[$keyPost]['url'] = $valuePost['url']; 
                            
                            $postImage = $this->getPostFeatureImage($valuePost['id']);
                            if (!empty($postImage)) {
                                $trendingData[$keyPost]['featured_image'] = $postImage;
                            } else {
                                $trendingData[$keyPost]['featured_image'] = "";
                            }
                            $postMetaData = $this->gePostMetaData($valuePost['id']);
                            $trendingData[$keyPost]['post_longitude'] = "";
                            $trendingData[$keyPost]['post_latitude'] = "";
                            $trendingData[$keyPost]['post_pincode'] = "";
                            $trendingData[$keyPost]['post_language'] = "";
                            $trendingData[$keyPost]['post_video_url'] = "";
                            foreach ($postMetaData as $keyUser => $valueData) {
                                if ($valueData['meta_key'] == "post-map-longitude-data") {
                                    $trendingData[$keyPost]['post_longitude'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post-map-latitude-data") {
                                    $trendingData[$keyPost]['post_latitude'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post-pin-code") {
                                    $trendingData[$keyPost]['post_pincode'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post_language") {
                                    $trendingData[$keyPost]['post_language'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post_video_url") {
                                    $trendingData[$keyPost]['post_video_url'] = $valueData['meta_value'];
                                } 
                                if(empty($trendingData[$keyPost]['post_video_url'])){
                                    $trendingData[$keyPost]['post_video_url'] = '';
                                }
                            }
                            //------------ Author Data
                            $authorData = $this->getAuthorDataByID($valuePost['author_id'],$valuePost['id']);
                           // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                            
                            if (!empty($authorData)) {
                                if($authorData['guest_user'] == 'guest'){
                                     unset($trendingData[$keyPost]['author_id']);
                                    $trendingData[$keyPost]['author_id'] = $authorData['author_id'];                            
                                }else{
                                   $trendingData[$keyPost]['author_id'] = $valuePost['author_id'];    
                                }
                                $trendingData[$keyPost]['author_name'] = $authorData['author_name'];
                                $trendingData[$keyPost]['author_url'] = $authorData['author_url'];

                            } else {
                                $trendingData[$keyPost]['author_name'] = "";
                                $trendingData[$keyPost]['author_url'] = "";
                                $trendingData[$keyPost]['author_id'] = "";
                            }
                            
                            //----------- Category Return By post
                            $categoryList = $this->getCategoryIDList($valuePost['id']);
                            $matchCat = array_intersect($category, $categoryList);
                            if (count($category) > 1) {
                                if (in_array(JHARKHAND_STATE, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = JHARKHAND_STATE;
                                } else if (in_array(KARNATAKA_STATE, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = KARNATAKA_STATE;
                                } else if (in_array(TRENDING_CATEGORY, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                                } else if (in_array(NATIONAL_CATEGORY, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                                } else {
                                    $matchCat = array_intersect($category, $categoryList);
                                    if (!empty($matchCat)) {
                                        $trendingData[$keyPost]['cat_id'] = $matchCat[0];
                                    } else {
                                        $trendingData[$keyPost]['cat_id'] = "";
                                    }
                                }
                            } else {
                                if (in_array($arrPostData['cat_id'], $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = $arrPostData['cat_id'];
                                } else {
                                    $trendingData[$keyPost]['cat_id'] = "";
                                }
                            }
                            //------- Get Comments
                            $commentsData = array();
                            $commentsData = $this->getCommentsData($valuePost['id']);
                            $trendingData[$keyPost]['comments'] = $commentsData;
                             $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                            $trendingData[$keyPost]['comment_count'] = $commentsDataCount;
                        }
                    }
                    $generalData['trendingData'] = $trendingData;
                } else {
                    $trendingData = array();
                    $generalData['trendingData'] = $trendingData;
                }
                //----------- Get Slide Story
                $slideStoryList = array();
                /* if(isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                  $slideStoryList = $this->getSlideStory($arrPostData['language_id']);
                  } */
                $generalData['slideStoryData'] = $slideStoryList;
                //----------- Get Pinning Story
                $pinningStoryList = array();
                /*  if(isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                  $pinningStoryList = $this->getPinningStory($arrPostData['pincode'],'',$arrPostData['language_id']);
                  } */
                $generalData['pinningStoryData'] = $pinningStoryList;

                //----------- Get Special Story
                $specialStoryList = array();
                               
//              if (($page_no_special_story == 0 )|| ($startPageNo == 1) ) {
//                 // echo "gfds"; die;
//                     if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
//                       $specialStoryList = $this->getSpecialStory($arrPostData['pincode'], '', $arrPostData['language_id'],$page_no_special_story);
//                    }
//                     $generalData['specialStoryData'] = $specialStoryList;
//              }else{
//                   $generalData['specialStoryData'] = array();
//              }
                
                // if ($page_no == 0  ) {
                 // echo "gfds"; die;
             //   echo $page_no_special_story; die;
                     if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                       $specialStoryList = $this->getSpecialStory($arrPostData['pincode'], '', $arrPostData['language_id'],$page_no_special_story);
                    }
                     $generalData['specialStoryData'] = $specialStoryList;
             // }
                
                

                //----------- Get Advertise
                $advertiseList = array();
                //echo $arrPostData['pincode'] ; die;
                $advertiseList = $this->getAdvertise($arrPostData['pincode'], '', $arrPostData['language_id']);
                $generalData['advertise'] = $advertiseList;

                //----------- Related Story
                //$relatedPost = array();
                //$relatedPost = $this->relatedPostLocalStory($arrPostData['pincode']);
                //$generalData['relatedStory'] = $relatedPost;
                //------------ Count Total Post by PinCode
                $totalPostCount = 0;
                if ($totalCount == 1) {
                    $getLocalPost = "SET @search = '$resultAllPinCode';";
                    $catPost = "SELECT DISTINCT
                        p.id
                        FROM nc_posts AS p";
                    $catPost .= " LEFT JOIN nc_postmeta AS pm ON pm.post_id = p.id ";
                    $catPost .= " WHERE (pm.meta_key = 'post-pin-code' AND pm.meta_value REGEXP CONCAT('(^|,)(', REPLACE(@search, ',', '|'), ')(,|$)')) $subQry AND p.post_type = 'post' AND p.post_status = 'publish' ORDER BY p.post_date DESC,(pm.meta_key = 'post-pin-code' AND pm.meta_value IN (" . $arrPostData['pincode'] . "))  ASC";
                    $stmtLocaPost = $dbh->prepare($getLocalPost);
                    $stmtLocaPost->execute();
                    $stmtPost = $dbh->prepare($catPost);
                    $stmtPost->execute();
                    $total = $stmtPost->rowCount();
                    if ($total > 0) {
                        $totalPostCount = $total;
                    } else {
                        $totalPostCount = 0;
                    }
                }
                $generalData['totalPost'] = $totalPostCount;
                return $generalData;
                exit;
            } else {
                $requestError = $this->generateRequestError("404", false, 13);
                echo json_encode($requestError);
                exit;
            }
        } else {
            $requestError = $this->generateRequestError("404", false, 13);
            echo json_encode($requestError);
            exit;
        }
    }

    //--------- Get District All Pincode
    function getDistrictPincode($pincode) {
        global $dbh;
        $stmtPincodeRef = "SELECT DISTINCT(pincode) AS pincode FROM nc_districts WHERE district IN ( SELECT DISTINCT(district) AS district FROM nc_districts WHERE pincode IN (" . $pincode . "))";
     //  echo $stmtPincodeRef; die;
        $arrPincodeRef = $dbh->prepare($stmtPincodeRef);
        $arrPincodeRef->execute();
        $totalStateRef = $arrPincodeRef->rowCount();
        if ($totalStateRef > 0) {
            $pincodeData = $arrPincodeRef->fetchAll(PDO::FETCH_ASSOC);
            //echo "<pre>"; print_r($pincodeData); die;
            return $pincodeData;
        }
    }

   //------------ Get Wishes by Language ID
    function getWishes($language_id,$category,$pincode) {
       // echo $language_id.'---'. $category; die;
        global $dbh;
        
     
        
        $postWishes = array();
        $wishImages = IMAGEPATH . "wishes/";
        if (!empty($pincode)) 
        {
            //echo "pp"; die;
            $getPostPincode = "SET @search = '$pincode';";
            $getWishes = "SELECT w.wishes_id,
                          w.wishes_name,
                          IFNULL(CONCAT('$wishImages',w.wishes_image),'') AS wishes_image,
                          w.wishes_msg,
                          w.language_id,
                          w.wishes_pincode,
                          w.pincodes,
                          w.banner_image,
                          w.banner_size,
                          w.company_name,
                          w.local_visibility,
                          w.city,
                          w.location_type,
                          w.location_url
                          FROM nc_wishes AS w JOIN nc_wishes_type AS wt ON wt.wishes_type_id = w.wishes_type AND wt.is_active = 1 WHERE w.language_id = '" . $language_id . "' AND w.is_active = 1 AND w.is_delete = 0 AND w.local_visibility = 1";
        //	echo $getWishes; die;
              $stmtAdv1 = $dbh->prepare($getPostPincode);
              $stmtAdv1->execute();
          }
        if (!empty($category)) 
        {  
          //  echo "cccc"; die;
            $getWishes = "SELECT w.wishes_id,
                          w.wishes_name,
                          IFNULL(CONCAT('$wishImages',w.wishes_image),'') AS wishes_image,
                          w.wishes_msg,
                          w.language_id,
                          w.wishes_pincode,
                          w.pincodes,
                          w.banner_image,
                          w.banner_size,
                          w.state_visibility,
                          w.company_name,
                          w.city,
                          w.location_type,
                          w.location_url
                          FROM nc_wishes AS w JOIN nc_wishes_type AS wt ON wt.wishes_type_id = w.wishes_type AND wt.is_active = 1 WHERE w.language_id = '" . $language_id . "' AND w.is_active = 1 AND w.is_delete = 0 AND w.state_visibility = 1";
        //	echo $getWishes; die;
          }
          
      
        $stmtWishes = $dbh->prepare($getWishes);
        $stmtWishes->execute();
        $totalPost = $stmtWishes->rowCount();
      //  echo $totalPost ; die;  
        if ($totalPost > 0) {
            $advData = $stmtWishes->fetchAll(PDO::FETCH_ASSOC);
          //  echo "<pre>"; print_r($advData); die;
            if (strlen($pincode) > 0) {
                $pinCodeArray = explode(",", $pincode);
                	//echo "<pre>"; print_r($pinCodeArray); //die;
                $finalAdvArray = array();

                for ($i = 0; $i < count($advData); $i++) {
                    $advPinCodeArray = explode(",", $advData[$i]["pincodes"]);
                   // echo "<pre>"; print_r($advPinCodeArray); //die;
                    $intersectArray = array_intersect($pinCodeArray, $advPinCodeArray);
 //echo "<pre>iiii--"; print_r($intersectArray); //die;
                   // $language_id = explode(",", $advData[$i]["language_id"]);
                    if (($advData[$i]["language_id"] == 1)) {
                        if ($advData[$i]["local_visibility"] == 1 && count($intersectArray) > 0) {
                           // echo "-----".$i."<br>";
                            //$temp = $this->removeImage($advData[$i]);
                            array_push($finalAdvArray,  $advData[$i]);
                        }                       
                    }
                }        
               $postWishes = $finalAdvArray;
            }else{
                $postWishes = $advData;
            }
                //echo "<pre>"; print_r($finalAdvArray); die;
                //die;
           // echo "<pre>"; print_r($postWishes); die;
             
        } 
        else {
            $postWishes = array();
        }
            
            
//        } else {
//            $postWishes = array();
//        }
        return $postWishes;
    }

    //------------ Get Slide Story
    function getSlideStory($language_id) {
        global $dbh;
        $date = date('Y-m-d h:i:s');
        $getStory = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            pm.story_type,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_slider_story AS pm LEFT JOIN
                            nc_posts AS p ON p.ID = pm.post_id
                            WHERE
                            p.post_type = 'post'
                            AND p.post_status = 'publish'
                            AND DATE(pm.end_date) >= NOW()
                            AND pm.language_id = '" . $language_id . "'
                            ORDER BY
                            pm.start_date DESC";
        $stmtStory = $dbh->prepare($getStory);
        $stmtStory->execute();
        $totalPost = $stmtStory->rowCount();
        $data = array();
        if ($totalPost > 0) {
            $postStoryList = $stmtStory->fetchAll(PDO::FETCH_ASSOC);
            $data = $postStoryList;
            foreach ($postStoryList as $keyPost => $valuePost) {
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                if (!empty($authorData)) {
                    $data[$keyPost]['author_name'] = $authorData['author_name'];
                    $data[$keyPost]['author_url'] = $authorData['author_url'];
                } else {
                    $data[$keyPost]['author_name'] = "";
                    $data[$keyPost]['author_url'] = "";
                }
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;

                /* $postURL = get_permalink($valuePost['id']);
                  if(!empty($postURL)) {
                  $data[$keyPost]["url"] = $postURL;
                  }else{
                  $data[$keyPost]["url"] = "";
                  }
                  $postCustom = get_post_custom($valuePost['id']);
                  if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                  $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                  }else{
                  $data[$keyPost]['post_longitude'] = "";
                  }
                  if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                  $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                  }else{
                  $data[$keyPost]['post_latitude'] = "";
                  }
                  //------------- Get Featured Image
                  if (has_post_thumbnail($valuePost['id'])) {
                  $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                  $data[$keyPost]['featured_image'] = $featured_image;
                  } else {
                  $data[$keyPost]['featured_image'] = '';
                  }
                  // ------- Comments
                  $commentsData = $this->getCommentsData($valuePost['id']);
                  $data[$keyPost]['comments'] = $commentsData; */
                //------------- Remove
            }
        } else {
            $data = array();
        }
        return $data;
    }

    //----------- Get Post data by Category ID(State,National,Trending News) [Main API Function]
    // Category ID : 5832 (For Trending Stories)
    // Category ID : 53 (For India - National Stories)
    function getPostByCategory($arrPostData, $totalCount) {
        //echo "jhgfj"; die;
        //print_r($arrPostData); die;
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        global $dbh;
        $generalData = array();
        if (isset($arrPostData['page_no']) && !empty($arrPostData['page_no']) && is_numeric($arrPostData['page_no'])) {
            $startPageNo = $arrPostData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $advPincode = $arrPostData['advPincode'];
        //echo $advPincode; die;
        $page_no = 12 * ($startPageNo);
        $page_no_special_story = 4 *($startPageNo); // this for special story
        // -------  Explode Category
        $category = explode(',', $arrPostData['cat_id']);
        $languageID = "";
        if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'])) {
            $languageID = trim($arrPostData['language_id']);
        } else {
            if (isset($arrPostData['user_id']) && !empty($arrPostData['user_id'])) {
                $languageID = $this->getLanguageID(trim($arrPostData['user_id']));
            }
        }


        //---------------- Pinning Story ID List
        $subQry = "";
        // $subQry = " AND p.id NOT IN (" . $specialStoryArray . ") ";
        if (in_array(JHARKHAND_STATE, $category) || in_array(KARNATAKA_STATE, $category)) {
            $pinningStoryIDList = $this->getPinningStoryPostIds('', $arrPostData['cat_id'], $arrPostData['language_id']); //this method use for get special story ids
            //	echo "<pre>"; print_r($pinningStoryIDList); die;
            if (!empty($pinningStoryIDList)) {
                $subQry = " AND p.id NOT IN (" . $pinningStoryIDList . ") ";
            }
        }
        //----------------
        if (count($category) > 0) {
            $catList = trim($arrPostData['cat_id']);
            //echo $catList; die;
            //if($catList == '5832' || $catList == '53') {
            if (in_array(TRENDING_CATEGORY, $category) || in_array(NATIONAL_CATEGORY, $category)) {
                /* if(in_array(5832,$category)){
                  $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 7 DAY ) OR ";
                  }else{
                  $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) OR ";
                  } */
                if ($languageID == 1) {
                    $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_title,
                            p.post_content,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url,
                                t.term_id as cat_id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND ((pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value )) OR NOT EXISTS (
                                  SELECT * FROM nc_postmeta
                                   WHERE nc_postmeta.meta_key = 'post_language'
                                    AND nc_postmeta.post_id = p.ID
                                ))
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
                } else {
                    $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_title,
                            p.post_content,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
                }
            } else {
                //echo $catList ; die;
                if ($catList == '15' || $catList == '16' || $catList == '15,16') {
                    $catList = $catList . ',5832,53,63'; // add video cetegory in list
                } else {
                    $catList = $catList;
                }

                if (in_array(JHARKHAND_STATE, $category) && in_array(KARNATAKA_STATE, $category)) {
                    $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_title,
                            p.post_content,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            $subQry
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
                } else {
                    //	echo $catList; die;
                    if ($catList != 63) {
                        //echo "g23"; die;
                        $catPost = "SELECT 
                            p.id,
                            p.post_date,
                            p.post_title,
                            p.post_content,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url,
							t.term_id as cat_id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            $subQry
                            AND  tt.term_id IN (" . $catList . ")							
                            AND p.post_type = 'post' 
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                             GROUP BY p.id ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
                        //	echo $catPost; die;
                    } else {
                        $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_title,
                            p.post_content,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            $subQry
                            AND  tt.term_id IN (" . $catList . ")							
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND(pm.post_id IN(select pm.post_id as postmetaid from nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id where p.post_type = 'post' AND p.post_status = 'publish' AND meta_key = 'post_language' AND meta_value = " . $languageID . "ORDER BY p.post_date DESC)) AND pm.meta_key = 'post_video_url' AND pm.meta_value != ''
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 12";
                        //echo $catPost; die;
                    }
                }
            }

            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            $data = array();
            if ($totalPost > 0) {
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
               // $data = $postData;

                // ----- Total Count

                foreach ($postData as $keyPost => $valuePost) {
                    $data[$keyPost]['id'] = $valuePost['id'];
                    $data[$keyPost]['post_date'] = $valuePost['post_date'];
                    $data[$keyPost]['post_title'] = $valuePost['post_title'];
                    $data[$keyPost]['post_content'] = $valuePost['post_content'];
                    $data[$keyPost]['url'] = $valuePost['url'];
                    $data[$keyPost]['cat_id'] = $valuePost['cat_id'];   
                    //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                    //------------- Remove
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    $data[$keyPost]['post_video_url'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_video_url") {
                            $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                        } 
                        if(empty($data[$keyPost]['post_video_url'])){
                             $data[$keyPost]['post_video_url'] = '';
                        }
                    }
                    //------------ Author Data
                 //   $authorData = $this->getAuthorDataByPostID(1,222176);
                    $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
                  //  $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($data[$keyPost]['author_id']);
                            $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                        $data[$keyPost]['author_id'] = "";
                    }
                    //----------- Category Return By post
                    /* $categoryList = $this->getCategoryIDList($valuePost['id']);
                      //echo print_r($categoryList); die;
                      $matchCat = array_intersect($category, $categoryList);
                      if(count($category)> 1) {
                      if(in_array(JHARKHAND_STATE,$categoryList) ){
                      $data[$keyPost]['cat_id'] = JHARKHAND_STATE;
                      }else if(in_array(KARNATAKA_STATE,$categoryList) ){
                      $data[$keyPost]['cat_id'] = KARNATAKA_STATE;
                      }else if(in_array(TRENDING_CATEGORY,$categoryList) ){
                      $data[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                      }else if(in_array(NATIONAL_CATEGORY,$categoryList) ){
                      $data[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                      }else{
                      $matchCat = array_intersect($category, $categoryList);
                      if(!empty($matchCat)) {
                      $data[$keyPost]['cat_id'] = $matchCat[0];
                      }else{
                      $data[$keyPost]['cat_id'] = "";
                      }
                      }
                      }else{
                      if(in_array($arrPostData['cat_id'],$categoryList)){
                      $data[$keyPost]['cat_id'] = $arrPostData['cat_id'];
                      }else{
                      $data[$keyPost]['cat_id'] = "";
                      }
                      } */
                    //------- Get Comments
                    $commentsData = array();
                    $commentsData = $this->getCommentsData($valuePost['id']);
                    $data[$keyPost]['comments'] = $commentsData;
                    $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                    $data[$keyPost]['comment_count'] = $commentsDataCount;

                    /* $postURL = get_permalink($valuePost['id']);
                      if(!empty($postURL)) {
                      $data[$keyPost]["url"] = $postURL;
                      }else{
                      $data[$keyPost]["url"] = "";
                      }
                      $postCustom = get_post_custom($valuePost['id']);
                      if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                      $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                      }else{
                      $data[$keyPost]['post_longitude'] = "";
                      }
                      if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                      $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                      }else{
                      $data[$keyPost]['post_latitude'] = "";
                      }
                      //------------- Get Featured Image
                      if (has_post_thumbnail($valuePost['id'])) {
                      $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                      $data[$keyPost]['featured_image'] = $featured_image;
                      } else {
                      $data[$keyPost]['featured_image'] = '';
                      }
                      // ------- Comments
                      $commentsData = $this->getCommentsData($valuePost['id']);
                      $data[$keyPost]['comments'] = $commentsData; */
                    //------------- Remove
                }
                $generalData ['mainStoryData'] = $data;
                //echo "<pre>"; print_r($generalData); die;
                //----------- Get WishesList
                $whishedList = array();
                if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                    if($arrPostData['cat_id'] != '6290628'){
                        $whishedList = $this->getWishes($arrPostData['language_id'],$arrPostData['cat_id'],'');
                    }
                }
                $generalData['whishesData'] = $whishedList;

                //----------- Get Trending Story start
                if ($page_no == 0) {
                    //	$trendingCatList = '5832,53,63';
                    $trendingCatList = '63';
                    //echo "<pre>"; print_r($trendingCatList); die;  
                    $trendingData = array();
                    if($arrPostData['cat_id'] != '6290628'){
                    $trendingCatPost = "SELECT DISTINCT
							p.id,
							p.post_date,
							p.post_title,
                                                        p.post_content,
							p.post_author as author_id,
							pm.meta_key,
							pm.meta_value,
							IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url,
                                                        t.term_id as cat_id
							FROM
							nc_posts AS p
							LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
							LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
							LEFT JOIN nc_term_taxonomy AS tt ON (
												tr.term_taxonomy_id = tt.term_taxonomy_id
											  )
							LEFT JOIN nc_terms AS t ON (
												tt.term_id = t.term_id
											)
							WHERE
							tt.taxonomy = 'category'
							$subQry
							AND  tt.term_id IN (" . $trendingCatList . ")
							AND p.post_type = 'post'
							AND p.post_status = 'publish' AND (pm.post_id IN(select pm.post_id as postmetaid from nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id where p.post_type = 'post' AND p.post_status = 'publish' AND meta_key = 'post_language' AND meta_value = " . $languageID . " ORDER BY p.post_date DESC)) AND pm.meta_key = 'post_video_url' AND pm.meta_value != ''
							ORDER BY
							p.post_date DESC LIMIT $page_no , 10";


                    //	SELECT DISTINCT p.id, p.post_date, p.post_content, p.post_title, p.post_author as author_id, pm.meta_key, pm.meta_value, IFNULL(CONCAT('http://newscode.in/',post_name,'/'),'' )AS url FROM nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id) LEFT JOIN nc_term_taxonomy AS tt ON ( tr.term_taxonomy_id = tt.term_taxonomy_id ) LEFT JOIN nc_terms AS t ON ( tt.term_id = t.term_id ) WHERE tt.taxonomy = 'category' AND p.id NOT IN (109325,135443) AND tt.term_id IN (63) AND p.post_type = 'post' AND p.post_status = 'publish' AND (pm.post_id IN(select post_id from nc_postmeta where meta_key = 'post_language' AND meta_value = 1 ORDER BY meta_id DESC)) AND pm.meta_key = 'post_video_url' AND pm.meta_value != '' ORDER BY p.post_date DESC LIMIT 0 , 12
                    //	echo $trendingCatPost; die;

                    $trendingStmtPost = $dbh->prepare($trendingCatPost);
                    $trendingStmtPost->execute();
                    $totalPost = $trendingStmtPost->rowCount();
                    if ($totalPost > 0) {
                        $postData = $trendingStmtPost->fetchAll(PDO::FETCH_ASSOC);
                        $trendingData = $postData;
                    //    echo "<pre>"; print_r($postData); die;
                        // ----- Total Count
                        foreach ($postData as $keyPost => $valuePost) {
                            $trendingData[$keyPost]['id'] = $valuePost['id'];
                            $trendingData[$keyPost]['post_date'] = $valuePost['post_date'];
                            $trendingData[$keyPost]['post_title'] = $valuePost['post_title'];
                            $trendingData[$keyPost]['post_content'] = $valuePost['post_content'];
                            $trendingData[$keyPost]['url'] = $valuePost['url'];
                            $trendingData[$keyPost]['cat_id'] = $valuePost['cat_id'];  
                            //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                            //------------- Remove
                            $postImage = $this->getPostFeatureImage($valuePost['id']);
                            if (!empty($postImage)) {
                                $trendingData[$keyPost]['featured_image'] = $postImage;
                            } else {
                                $trendingData[$keyPost]['featured_image'] = "";
                            }
                            $postMetaData = $this->gePostMetaData($valuePost['id']);
                            $trendingData[$keyPost]['post_longitude'] = "";
                            $trendingData[$keyPost]['post_latitude'] = "";
                            $trendingData[$keyPost]['post_pincode'] = "";
                            $trendingData[$keyPost]['post_language'] = "";
                            $trendingData[$keyPost]['post_video_url'] = "";
                            foreach ($postMetaData as $keyUser => $valueData) {
                                if ($valueData['meta_key'] == "post-map-longitude-data") {
                                    $trendingData[$keyPost]['post_longitude'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post-map-latitude-data") {
                                    $trendingData[$keyPost]['post_latitude'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post-pin-code") {
                                    $trendingData[$keyPost]['post_pincode'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post_language") {
                                    $trendingData[$keyPost]['post_language'] = $valueData['meta_value'];
                                }
                                if ($valueData['meta_key'] == "post_video_url") {
                                    $trendingData[$keyPost]['post_video_url'] = $valueData['meta_value'];
                                } 
                                if(empty($trendingData[$keyPost]['post_video_url'])){
                                    $trendingData[$keyPost]['post_video_url'] = '';
                                }
                            }
                            //------------ Author Data
                            $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
                           // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                                                      
                            if (!empty($authorData)) {
                                if(array_key_exists("guest_user",$authorData) &&  $authorData['guest_user'] == 'guest'){
                                     unset($trendingData[$keyPost]['author_id']);
                                    $trendingData[$keyPost]['author_id'] = $authorData['author_id'];                            
                                }else{
                                   $trendingData[$keyPost]['author_id'] = $valuePost['author_id'];    
                                }
                                $trendingData[$keyPost]['author_name'] = $authorData['author_name'];
                                $trendingData[$keyPost]['author_url'] = $authorData['author_url'];

                            } else {
                                $trendingData[$keyPost]['author_name'] = "";
                                $trendingData[$keyPost]['author_url'] = "";
                                $trendingData[$keyPost]['author_id'] = "";
                            }
                            //----------- Category Return By post
                            $categoryList = $this->getCategoryIDList($valuePost['id']);
                            $matchCat = array_intersect($category, $categoryList);
                            if (count($category) > 1) {
                                if (in_array(JHARKHAND_STATE, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = JHARKHAND_STATE;
                                } else if (in_array(KARNATAKA_STATE, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = KARNATAKA_STATE;
                                } else if (in_array(TRENDING_CATEGORY, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                                } else if (in_array(NATIONAL_CATEGORY, $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                                } else {
                                    $matchCat = array_intersect($category, $categoryList);
                                    if (!empty($matchCat)) {
                                        $trendingData[$keyPost]['cat_id'] = $matchCat[0];
                                    } else {
                                        $trendingData[$keyPost]['cat_id'] = "";
                                    }
                                }
                            } else {
                                if (in_array($arrPostData['cat_id'], $categoryList)) {
                                    $trendingData[$keyPost]['cat_id'] = $arrPostData['cat_id'];
                                } else {
                                    $trendingData[$keyPost]['cat_id'] = "";
                                }
                            }
                            //------- Get Comments
                            $commentsData = array();
                            $commentsData = $this->getCommentsData($valuePost['id']);
                            $trendingData[$keyPost]['comments'] = $commentsData;
                            $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                            $trendingData[$keyPost]['comment_count'] = $commentsDataCount;
                        }
                    }
                    }
                    $generalData['trendingData'] = $trendingData;
                } else {
                    $trendingData = array();
                    $generalData['trendingData'] = $trendingData;
                }
                //print_r($trendingData); die;
                //----------- Get Trending Story start end			
                //----------- Get Slide Story
                $slideStoryList = array();
                /* if(isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                  $slideStoryList = $this->getSlideStory($arrPostData['language_id']);
                  } */
                $generalData['slideStoryData'] = $slideStoryList;
                //----------- Get Pinning Story
                $pinningStoryList = array();
                /*  if(isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                  $pinningStoryList = $this->getPinningStory('',$arrPostData['cat_id'],$arrPostData['language_id']);
                  }
                  $generalData['pinningStoryData'] = $pinningStoryList; */
                $generalData['pinningStoryData'] = $pinningStoryList;

                //----------- Get Special Story
                $specialStoryList = array();
                //	echo $catList ; die;
                //echo ".".$arrPostData['cat_id']; die;
             // if (($page_no_special_story == 0 )|| ($startPageNo == 1) ) {
             // if ($page_no_special_story == 0 ) {
              
                    if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'] && is_numeric($arrPostData['language_id']))) {
                        if($arrPostData['cat_id'] != '6290628'){
                            $specialStoryList = $this->getSpecialStory('', $arrPostData['cat_id'], $arrPostData['language_id'],$page_no_special_story);
                        }
                        //echo "<pre>"; print_r($specialStoryList); die;
                    }
                     $generalData['specialStoryData'] = $specialStoryList;
//              }else{
//                   $generalData['specialStoryData'] = array();
//              }
               
                   
               

                //----------- Get Advertise
                $advertiseList = array();
                if($arrPostData['cat_id'] != '6290628'){
                    $advertiseList = $this->getAdvertise('', $arrPostData['cat_id'], $languageID, $advPincode);
                }
                $generalData['advertise'] = $advertiseList;

                //----------- Related Story
                //$relatedPost = array();
                //$relatedPost = $this->relatedPostByCategory($catList,$arrPostData['language_id']);
                //$generalData['relatedStory'] = $relatedPost;
                //------------ Count Total Post by PinCode
                $totalPostCount = 0;
                if ($totalCount == 1) {
                    if (in_array(TRENDING_CATEGORY, $category) || in_array(NATIONAL_CATEGORY, $category)) {
                        /* if(in_array(5832,$category)){
                          $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 7 DAY ) OR ";
                          }else{
                          $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) OR ";
                          } */
                        if ($languageID == 1) {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND ((pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value )) OR NOT EXISTS (
                                  SELECT * FROM nc_postmeta
                                   WHERE nc_postmeta.meta_key = 'post_language'
                                    AND nc_postmeta.post_id = p.ID
                                ))";
                        } else {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))";
                        }
                    } else {
                        if (in_array(JHARKHAND_STATE, $category) && in_array(KARNATAKA_STATE, $category)) {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            $subQry
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'";
                        } else {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            $subQry
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))";
                        }
                    }
                    $stmtPost = $dbh->prepare($catPost);
                    $stmtPost->execute();
                    $total = $stmtPost->rowCount();
                    if ($total > 0) {
                        $totalPostCount = $total;
                    } else {
                        $totalPostCount = 0;
                    }
                }
                $generalData['totalPost'] = $totalPostCount;
                return $generalData;
            } else {
                $arrResponse = $this->generateRequestError("404", false, 37);
                echo json_encode($arrResponse);
                exit;
            }
        } else {
            $requestError = $this->generateRequestError("404", false, 15);
            echo json_encode($requestError);
            exit;
        }
    }

    //--------- Get User selected Language by ID
    function getLanguageID($user_id) {
        global $dbh;
        $data = array();
        $stmtPost = $dbh->prepare("SELECT language_id
                    FROM nc_users
                    WHERE ID = :ID");
        $arrPost = array(":ID" => $user_id);
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $languageData = $stmtPost->fetchColumn();
        } else {
            $languageData = '';
        }
        return $languageData;
    }

    //--------- Add comment by user [Main API Function]
    function addComment($arrPostData) {
        global $dbh;
        $data = array();
        $checkPost = get_post($arrPostData['post_id']);

        if (!empty($checkPost)) {
            $post_id = $arrPostData['post_id'];
        } else {
            $arrResponse = $this->generateRequestError("400", false, 20);
            return $arrResponse;
            exit;
        }
        $checkPostOpen = comments_open($arrPostData['post_id']);
        if (empty($checkPostOpen)) {
            $arrResponse = $this->generateRequestError("401", false, 21);
            return $arrResponse;
            exit;
        }
        if (isset($arrPostData['user_id']) && !empty($arrPostData['user_id'])) {
            $user_id = $arrPostData['user_id'];
            $status = 1;
        } else {
            $user_id = 0;
            $status = 0;
        }
        $getUser = $this->getSingleUser($arrPostData['user_id']);
        if (empty($getUser)) {
            $arrResponse = $this->generateRequestError("404", false, 11);
            echo json_encode($arrResponse);
            exit;
        }
        $userMetaData = $this->getMetaData($arrPostData['user_id']);
        $arrUserInformation = array();
        foreach ($userMetaData as $keyUser => $valueUser) {

            if ($valueUser['meta_key'] == "first_name") {
                $arrUserInformation['first_name'] = $valueUser['meta_value'];
            }
            if ($valueUser['meta_key'] == "last_name") {
                $arrUserInformation['last_name'] = $valueUser['meta_value'];
            }
        }
        $name = $arrUserInformation['first_name'] . ' ' . $arrUserInformation['last_name'];
        if (empty($name)) {
            $name = $getUser['user_email'];
        }

        $time = current_time('mysql');
        $insert = array(
            'comment_post_ID' => $post_id,
            'comment_author' => $name,
            'comment_author_email' => $getUser['user_email'],
            'comment_author_url' => $getUser['user_url'],
            'comment_content' => $arrPostData['content'],
            'comment_type' => '',
            'comment_parent' => 0,
            'user_id' => $user_id,
            'comment_author_IP' => '',
            'comment_agent' => $arrPostData['platform'],
            'comment_date' => $time,
            'comment_approved' => $status,
        );
        //if ( !$this->my_comment_already_exists( $name, $arrPostData['content'] ) ) {
        $commentId = wp_insert_comment($insert);
        /* }else{
          $arrResponse = $this->generateRequestError("401", false, 22);
          return $arrResponse;
          exit;
          } */
        if (!empty($commentId)) {
            $stmtComment = "SELECT
                comment_ID as comment_id,
                comment_post_ID as comment_post_id,
                comment_author,
                comment_author,
                comment_author_email,
                comment_author_url,
                comment_author_IP as comment_author_ip,
                comment_date,
                comment_content,
                comment_approved,
                comment_karma,
                user_id
                FROM
                nc_comments
                WHERE comment_ID ='" . $commentId . "'";
            $arrComment = $dbh->prepare($stmtComment);
            $arrComment->execute();
            $data = $arrComment->fetch(PDO::FETCH_ASSOC);

            if ($status == 1) {
                $arrResponse = $this->generateRequestError("200", true, 16, $data);
            } else {
                $arrResponse = $this->generateRequestError("200", true, 10, $data);
            }
            return $arrResponse;
            exit;
        } else {
            $arrResponse = $this->generateRequestError("500", false, 7);
            return $arrResponse;
            exit;
        }
    }

    //--------- This function check comment already exist or not
    function my_comment_already_exists($author, $comment) {
        $already_exists = false;
        global $wpdb;
        $comment_bit = substr($comment, 0, 40);
        $like_bit = $wpdb->esc_like($comment_bit) . '%';
        $query = "SELECT comment_ID FROM {$wpdb->prefix}comments WHERE comment_author = %s AND comment_content LIKE %s";
        $query = $wpdb->prepare($query, $author, $like_bit);
        $results = $wpdb->get_results($query);
        if (is_null($results)) {
            if ($wpdb->last_error) {
                echo "<p>Error: {$wpdb->last_error}</p>";
            }
        } else if (is_array($results) && 0 < count($results)) {
            $already_exists = true;
        }
        return $already_exists;
    }

    //--------- Search post  [Main API Function]
    function searchPost($content) {
        global $dbh;
        $data = array();
        $totalPost = 0;
        /* if(isset($arrPostData['page_no']) && !empty($arrPostData['page_no']) && is_numeric($arrPostData['page_no'])){
          $startPageNo = $arrPostData['page_no'];
          }else{
          $startPageNo = 0;
          }
          $page_no = 10*($startPageNo); */
        $totalResultArr = array();
        $catPost = $this->advanced_custom_search('content', 'content', $content);
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
            $data = $postData;
            foreach ($postData as $keyPost => $valuePost) {
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                }

                //------------ Author Data
                $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                if (!empty($authorData)) {
                    $data[$keyPost]['author_name'] = $authorData['author_name'];
                    $data[$keyPost]['author_url'] = $authorData['author_url'];
                } else {
                    $data[$keyPost]['author_name'] = "";
                    $data[$keyPost]['author_url'] = "";
                }
                //----------- Category Return By post
                $categoryList = $this->getCategoryIDList($valuePost['id']);
                //$matchCat = array_intersect($category, $categoryList);
                if (count($categoryList) > 1) {
                    if (in_array(JHARKHAND_STATE, $categoryList)) {
                        $data[$keyPost]['cat_id'] = JHARKHAND_STATE;
                    } else if (in_array(KARNATAKA_STATE, $categoryList)) {
                        $data[$keyPost]['cat_id'] = KARNATAKA_STATE;
                    } else if (in_array(TRENDING_CATEGORY, $categoryList)) {
                        $data[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                    } else if (in_array(NATIONAL_CATEGORY, $categoryList)) {
                        $data[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                    } else {
                        //$matchCat = array_intersect($category, $categoryList);
                        if (!empty($categoryList[0])) {
                            $data[$keyPost]['cat_id'] = $categoryList[0];
                        } else {
                            $data[$keyPost]['cat_id'] = "";
                        }
                    }
                } else {
                    $data[$keyPost]['cat_id'] = $categoryList;
                }
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;
                /* $postURL = get_permalink($valuePost['id']);
                  if(!empty($postURL)) {
                  $data[$keyPost]["url"] = $postURL;
                  }else{
                  $data[$keyPost]["url"] = "";
                  }
                  $postCustom = get_post_custom($valuePost['id']);
                  if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                  $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                  }else{
                  $data[$keyPost]['post_longitude'] = "";
                  }
                  if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                  $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                  }else{
                  $data[$keyPost]['post_latitude'] = "";
                  }
                  //------------- Get Featured Image
                  if (has_post_thumbnail($valuePost['id'])) {
                  $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                  $data[$keyPost]['featured_image'] = $featured_image;
                  } else {
                  $data[$keyPost]['featured_image'] = '';
                  }
                  // ------- Comments
                  $commentsData = $this->getCommentsData($valuePost['id']);
                  $data[$keyPost]['comments'] = $commentsData; */
                //------------- Remove
            }
            $unique = array_map('unserialize', array_unique(array_map('serialize', $data)));
            $arr = array();
            for ($i = 0; $i < count($unique); $i++) {
                if (!is_null($unique[$i])) {
                    $arr[] = $unique[$i];
                }
            }
            $totalResultArr['mainStoryData'] = $arr;
            // ----- Total Count
            $totalResultArr['totalPost'] = $totalPost;
            return $totalResultArr;
        } else {
            $requestError = $this->generateRequestError("404", false, 35);
            echo json_encode($requestError);
            exit;
        }
    }

    //--------- Advance search result
    function advanced_custom_search($search, $wp_query, $content) {
        global $wpdb;
        /* if($totalCount == 1){
          $subQry = '';
          }else{
          $subQry = " LIMIT ".$page_no." , 30 ";
          } */
        if (empty($search)) {
            return $search;
        }
        // 1- get search expression
        $terms_raw = $content;
        // 2- check search term for XSS attacks
        $terms_xss_cleared = strip_tags($terms_raw);
        // 3- do another check for SQL injection, use WP esc_sql
        $terms = esc_sql($terms_xss_cleared);
        // 4- explode search expression to get search terms
        $exploded = explode(' ', $terms);
        if ($exploded === FALSE || count($exploded) == 0) {
            $exploded = array(0 => $terms);
        }
        // 5- setup search variable as a string
        $search = '';
        // 6- get searcheable_acf, a list of advanced custom fields you want to search content in
        $list_searcheable_acf = $this->list_searcheable_acf();
        $table_prefix = $wpdb->prefix;
        // 7- search through tags, inject each into SQL query
        foreach ($exploded as $tag) {
            $search .= " SELECT DISTINCT
                        nc_posts.id,
                        nc_posts.post_date,
                        nc_posts.post_content,
                        nc_posts.post_title,
                        nc_posts.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',nc_posts.post_name,'/'),'' )AS url
                        FROM nc_posts AS nc_posts WHERE nc_posts.post_type = 'post' AND
                    nc_posts.post_status = 'publish'
           AND (
             (" . $table_prefix . "posts.post_title LIKE '%$tag%')
             OR (" . $table_prefix . "posts.post_content LIKE '%$tag%')
             OR EXISTS (
               SELECT * FROM " . $table_prefix . "postmeta
                WHERE post_id = " . $table_prefix . "posts.ID
                  AND (";
            // 7b - add each custom post-type into SQL query
            foreach ($list_searcheable_acf as $searcheable_acf) {
                if ($searcheable_acf == $list_searcheable_acf[0]) {
                    $search .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
                } else {
                    $search .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
                }
            }
            // 8- Add to search string info from comments and custom taxonomies
            // You would need to customize the taxonomies below to match your site
            $search .= ")
             )
             OR EXISTS (
               SELECT * FROM " . $table_prefix . "comments
               WHERE comment_post_ID = " . $table_prefix . "posts.ID
                 AND comment_content LIKE '%$tag%'
             )
             OR EXISTS (
               SELECT * FROM " . $table_prefix . "terms
               INNER JOIN " . $table_prefix . "term_taxonomy
                 ON " . $table_prefix . "term_taxonomy.term_id = " . $table_prefix . "terms.term_id
               INNER JOIN " . $table_prefix . "term_relationships
                 ON " . $table_prefix . "term_relationships.term_taxonomy_id = " . $table_prefix . "term_taxonomy.term_taxonomy_id
               WHERE (
              taxonomy = 'your'
      OR taxonomy = 'custom'
      OR taxonomy = 'taxonomies'
      OR taxonomy = 'here'
            )
                AND object_id = " . $table_prefix . "posts.ID
                AND " . $table_prefix . "terms.name LIKE '%$tag%'
             )
         ) ORDER BY nc_posts.post_date DESC LIMIT 0 , 30";
        }
        return $search;
    }

    function list_searcheable_acf() {
        $list_searcheable_acf = array("title", "sub_title", "excerpt_short", "excerpt_long", "xyz", "myACF", "post-pin-code");
        return $list_searcheable_acf;
    }

    /* function getCategoryID($post_id,$language_id){
      global $dbh;
      $catPost = "select GROUP_CONCAT(t.term_id) as cat_id from nc_terms t, nc_term_taxonomy tt, nc_term_relationships tr
      where t.term_id=tt.term_id AND tt.term_taxonomy_id=tr.term_taxonomy_id and tr.object_id= ".$post_id."";
      $stmtPost = $dbh->prepare($catPost);
      $stmtPost->execute();
      $totalCategory = $stmtPost->rowCount();
      if(!empty($totalCategory)) {
      $cats = $stmtPost->fetchColumn();
      $category = explode(",",$cats);
      if($language_id == 1 && in_array(15,$category)){
      $cat_id = 15;
      }
      if($language_id == 2 && in_array(16,$category)){
      $cat_id = 16;
      }
      }else{
      $cat_id = false;
      }
      return $cat_id;
      } */

    //--------------- OTHER API ----------------//
    //--------- Send Push notification from backend side of website  [Main API Function]
    public function _send_notification($arrUserData) {
 $txt = 'test';
        	//file_put_contents('log.txt', $log, FILE_APPEND);
               // file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
                
//                $my_file = 'logs.txt';
//                $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
//                $data = 'This is the data';
//                fwrite($handle, $data);
//echo FOLDER_PATH1 ; die; 

        $data = array();
        $postID = trim($arrUserData['important_post_id']);
       //  echo "ss"; die;
        $postData = $this->getSinglePost($postID);
     // echo "<pre>ppp"; print_r($postData); die;
        if(!empty($postData['post_language'])){
            $language_id = trim($postData['post_language']);
        }else{
            $language_id = "";
        }
        
        if(empty($language_id)){
            $requestError = $this->generateRequestError("404", false, 77);
            echo json_encode($requestError);
            exit;
        }
        //$catList = wp_get_post_categories( $postID );
        $catList = $this->getCategoryIDList($postID);
      //   echo "<pre>ngh"; print_r($catList); die;
        $pinCode = "";
        if(isset($postData['post_pincode']) && !empty($postData['post_pincode'])){
            $pinCode = $postData['post_pincode'];
        }
      //  echo "<pre>ngh"; print_r($pinCode); die;
        //------------ CODE FOR ANDROID DEVICES START------------//
        $androidDevicesList = array();
        // For National and Trending Category User's
        // Category ID : 5832 (For Trending Stories)
        // Category ID : 53 (For India - National Stories)
        if(in_array(NATIONAL_CATEGORY,$catList) || in_array(TRENDING_CATEGORY,$catList)){
         //  echo "nnntttt----";die;
            $androidDevicesListUser = array();
            $androidDevicesListForInstance = array();
            $androidDevicesListUser = $this->getAllUserNotification('android',$language_id);
           //  echo "<pre>"; print_r($androidDevicesListUser); die;
            $androidDevicesListForInstance = $this->getAllInstanceUserNotification('android',$language_id);
            $androidDevicesList = array_merge($androidDevicesListForInstance,$androidDevicesListUser);

        }else{
           $userByCategoryData = array();
            $userByCategoryDataArr = array();
            $InstanceuserByCategoryData = array();
            $InstanceuserByCategoryDataArr = array();
            $userByCategoryDataAllArr = array();
            // For Jharkhand and Karnataka Category User's
            // Category ID : 15 (For Jharkhand)
            // Category ID : 16 (For Karnataka)
           // echo "<pre>ccc"; print_r($postData['categories']); die;
            
          //  if(count($postData['categories'])>0 && (in_array(JHARKHAND_STATE,$catList) || in_array(KARNATAKA_STATE,$catList))){
            if(count($catList)>0 && (in_array(JHARKHAND_STATE,$catList) || in_array(KARNATAKA_STATE,$catList))){
               // echo "jjjjj---"; die;
          /*      foreach($postData['categories'] as $category) {
                    if($category['cat_id'] == JHARKHAND_STATE || $category['cat_id'] == KARNATAKA_STATE) {
                        $userByCategoryData[] = $this->getUsersByCategory(trim($category['cat_id']), 'android',$language_id);
                        $InstanceuserByCategoryData[] = $this->getInstanceUsersByCategory(trim($category['cat_id']), 'android',$language_id);
                    }
                }*/
                
                // change for push problem
                
                foreach($catList as $category) {
                    if($category == JHARKHAND_STATE || $category == KARNATAKA_STATE) {
                        $userByCategoryData[] = $this->getUsersByCategory(trim($category), 'android',$language_id);
                        $InstanceuserByCategoryData[] = $this->getInstanceUsersByCategory(trim($category), 'android',$language_id);
                    }
                }
                
  // echo "<pre>uuu"; print_r($InstanceuserByCategoryData); die;
                if(count($userByCategoryData)>0) {
                    for ($i = 0; $i<count($userByCategoryData); $i++) {
                        $userByCategoryDataArr = array_merge($userByCategoryDataArr, $userByCategoryData[$i]);
                    }
                }
  //echo "<pre>iii"; print_r($userByCategoryDataArr); die;
                if(count($InstanceuserByCategoryData)>0) {
                    for ($i = 0; $i<count($InstanceuserByCategoryData); $i++) {
                        $InstanceuserByCategoryDataArr = array_merge($InstanceuserByCategoryDataArr, $InstanceuserByCategoryData[$i]);
                    }
                }
                $userByCategoryDataAllArr = array_merge($InstanceuserByCategoryDataArr,$userByCategoryDataArr);
  //  echo "<pre>"; print_r($userByCategoryDataAllArr); die;
            }
            //----- Send Notification by Post PINCODE
            $userByZipcodeData = array();
            $instanceUserByZipcodeData = array();
            $userByZipcodeDataAllUser = array();
            if(!empty($postData['post_pincode'])){
                $post_pincode = trim($postData['post_pincode']);
                $zipcodePost = explode(',',$post_pincode);
                $userByZipcodeDataList = array();
                $instanceUserByZipcodeDataList = array();
                // ----- Added By
                for($i=0;$i<count($zipcodePost);$i++){
                    if(!empty($zipcodePost[$i])) {
                        $resultGetPincode[] = $this->getDistrictPincode(trim($zipcodePost[$i]));
//echo "<pre>"; print_r($resultGetPincode); die;
                       // $resultAllPincode .= $resultGetPincode.',';
                        $resultAllPincode = array();
                        for($j=0;$j<count($resultGetPincode);$j++){
                            for($k=0;$k<count($resultGetPincode[$j]);$k++){
                               $resultAllPincode[]= $resultGetPincode[$j][$k]['pincode'];
                            }
                          
                        }
                        
                    }
                }
        
                $resultAllPincode1 = implode(",",$resultAllPincode);
                $resultPincode = implode(',',array_unique(explode(',',rtrim($resultAllPincode1,','))));
                $zipcodePostLast = explode(',',$resultPincode);
                // --------
        

                for($i=0;$i<count($zipcodePostLast);$i++) {
                    $userByZipcodeDataList[] = $this->getUserByZipcode($zipcodePostLast[$i], 'android');
                    $instanceUserByZipcodeDataList[] = $this->getInstanceUserByZipcode($zipcodePostLast[$i], 'android');

                }

                if(count($userByZipcodeDataList)>0) {
                    for ($i = 0; $i<count($userByZipcodeDataList); $i++) {
                        $userByZipcodeData = array_merge($userByZipcodeData, $userByZipcodeDataList[$i]);
                    }
                }
                if(count($instanceUserByZipcodeDataList)>0) {
                    for ($i = 0; $i<count($instanceUserByZipcodeDataList); $i++) {
                        $instanceUserByZipcodeData = array_merge($instanceUserByZipcodeData, $instanceUserByZipcodeDataList[$i]);
                    }
                }
                $userByZipcodeDataAllUser = array_merge($userByZipcodeData ,$instanceUserByZipcodeData );
  //echo "<pre>zz"; print_r($userByZipcodeDataAllUser); die;
            }
            $androidDevicesList = array_merge($userByZipcodeDataAllUser, $userByCategoryDataAllArr);
        }
        $androidDevicesList = array_unique(array_map(function($elem){return $elem['device_token'];}, $androidDevicesList));
      // echo "<pre>tttt"; print_r($androidDevicesList); die;
      
        if (count($androidDevicesList) > 0) {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $key = 'AAAAFWklK5g:APA91bFrgNl_zm_zmXSmS8MFhxPwYsZE-9QpT7IQqsGIFWNw9aPHxGjXxC75dlqrR_gmvoDWInswK2z6dl4AVhp1zFdIIAAxzxJIqrF0MKO9XHwvNWJElr2EGy0FuP3Bg69tDE9oKMgF';
            //$key = 'AIzaSyBb8P-6lz2ASWb211IBMbigXnKgaY5ZhxY';
            $headers = array(
                'Authorization: key=' . $key,
                'Content-Type: application/json'
            );
            if(isset($arrUserData['important_post_id']) && !empty($arrUserData['important_post_id'])){
                $categories = $this->getCategoryDataByPost($arrUserData['important_post_id']);
                $notificationArr = array(
                    "title" => $arrUserData['important_post'],
                    "id" => $arrUserData['important_post_id'],
                    "image" => $arrUserData['important_post_image'],
                    "categories" => $categories,
                    "pincode" =>$pinCode
                );
            }else{
                $notificationArr = $arrUserData['important_post'];
            }
            $devideArray = array_chunk($androidDevicesList,1000);
		
            foreach ($devideArray AS $device) {
                $fields = array(
                    'registration_ids' => $device,
                    'priority' => 'high',
                    'data' => array(
                        "message" => $notificationArr
                    )
                );
                // Open connection
                $ch = curl_init();
                // Set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                // Execute post
                $result[] = curl_exec($ch);
                // Close connection
                curl_close($ch);
            }
        }
        return $result;
        exit;
        //------------ CODE FOR ANDROID DEVICES END ------------//
        
        //------------ CODE FOR IOS DEVICES START ------------//
        // For National and Trending Category User's
        // Category ID : 5832 (For Trending Stories)
        // Category ID : 53 (For India - National Stories)
        if (in_array(NATIONAL_CATEGORY, $catList) || in_array(TRENDING_CATEGORY, $catList)) {
            $iosUserList = array();
            $iosInstanceUserList = array();
            $iosUserList = $this->getAllUserNotification('ios', $language_id);
            $iosInstanceUserList = $this->getAllInstanceUserNotification('ios', $language_id);
            $iosDevicesList = array_merge($iosUserList, $iosInstanceUserList);
        } else {
            // For Jharkhand and Karnataka Category User's
            // Category ID : 15 (For Jharkhand)
            // Category ID : 16 (For Karnataka)
            $userByCategoryDataIOS = array();
            $userByCategoryDataIOSArr = array();
            $InstanceuserByCategoryDataIOS = array();
            $InstanceuserByCategoryDataIOSArr = array();
            $userByCategoryDataIOSAllArr = array();
            if (count($postData['categories']) > 0 && (in_array(JHARKHAND_STATE, $catList) || in_array(KARNATAKA_STATE, $catList))) {
                foreach ($postData['categories'] as $category) {
                    if ($category['cat_id'] == JHARKHAND_STATE || $category['cat_id'] == KARNATAKA_STATE) {
                        $userByCategoryDataIOS[] = $this->getUsersByCategoryIOS(trim($category['cat_id']), 'ios', $language_id);
                        $InstanceuserByCategoryDataIOS[] = $this->getInstanceUsersByCategoryIOS(trim($category['cat_id']), 'ios', $language_id);
                    }
                }
                if (count($userByCategoryDataIOS) > 0) {
                    for ($i = 0; $i < count($userByCategoryDataIOS); $i++) {
                        $userByCategoryDataIOSArr = array_merge($userByCategoryDataIOSArr, $userByCategoryDataIOS[$i]);
                    }
                }
                if (count($InstanceuserByCategoryDataIOS) > 0) {
                    for ($i = 0; $i < count($InstanceuserByCategoryDataIOS); $i++) {
                        $InstanceuserByCategoryDataIOSArr = array_merge($InstanceuserByCategoryDataIOSArr, $InstanceuserByCategoryDataIOS[$i]);
                    }
                }
                $userByCategoryDataIOSAllArr = array_merge($userByCategoryDataIOSArr, $InstanceuserByCategoryDataIOSArr);
            }
            //----- Send Notification by Post PINCODE
            $userByZipcodeDataIOSAllArr = array();
            if (!empty($postData['post_pincode'])) {
                $post_pincode = trim($postData['post_pincode']);
                $zipcodePost = explode(',', $post_pincode);
                $userByZipcodeDataListIOS = array();
                $instanceUserByZipcodeDataListIOS = array();
                $instanceUserByZipcodeDataIOS = array();
                $userByZipcodeDataIOS = array();
                // ----- Added
                $resultAllPincode = '';
                for ($i = 0; $i < count($zipcodePost); $i++) {
                    if (!empty($zipcodePost[$i])) {
                        $resultGetPincode = $this->getDistrictPincode(trim($zipcodePost[$i]));
                        $resultAllPincode .= $resultGetPincode . ',';
                    }
                }
                $resultPincode = implode(',', array_unique(explode(',', rtrim($resultAllPincode, ','))));
                $zipcodePostLast = explode(',', $resultPincode);
                //--------------
                for ($i = 0; $i < count($zipcodePostLast); $i++) {
                    $userByZipcodeDataListIOS[] = $this->getUserByZipcode($zipcodePostLast[$i], 'ios');
                    $instanceUserByZipcodeDataListIOS[] = $this->getInstanceUserByZipcode($zipcodePostLast[$i], 'ios');
                }
                if (count($userByZipcodeDataListIOS) > 0) {
                    for ($i = 0; $i < count($userByZipcodeDataListIOS); $i++) {
                        $userByZipcodeDataIOS = array_merge($userByZipcodeDataIOS, $userByZipcodeDataListIOS[$i]);
                    }
                }
                if (count($instanceUserByZipcodeDataListIOS) > 0) {
                    for ($i = 0; $i < count($instanceUserByZipcodeDataListIOS); $i++) {
                        $instanceUserByZipcodeDataIOS = array_merge($instanceUserByZipcodeDataIOS, $instanceUserByZipcodeDataListIOS[$i]);
                    }
                }
                $userByZipcodeDataIOSAllArr = array_merge($userByZipcodeDataIOS, $instanceUserByZipcodeDataIOS);
            }
            $iosDevicesList = array_merge($userByZipcodeDataIOSAllArr, $userByCategoryDataIOSAllArr);
        }
        $iosDevicesList = array_unique(array_map(function($elem) {
                    return $elem['device_token'];
                }, $iosDevicesList));
        //-----------------
        /* Google FCM API KEY AND URL
         * URL : https://fcm.googleapis.com/fcm/send
         * Key : AAAAFWklK5g:APA91bFrgNl_zm_zmXSmS8MFhxPwYsZE-9QpT7IQqsGIFWNw9aPHxGjXxC75dlqrR_gmvoDWInswK2z6dl4AVhp1zFdIIAAxzxJIqrF0MKO9XHwvNWJElr2EGy0FuP3Bg69tDE9oKMgF
         */
        if (count($iosDevicesList) > 0) {
            $devices = array();
            $devideArray = array_chunk($iosDevicesList, 1000);
            foreach ($devideArray AS $device) {
                $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                //The device token.
                $token = $device;
                //Title of the Notification.
                $title = '';
                //Body of the Notification.
                $body = $arrUserData['important_post'];
                // The Badge Number for the Application Icon (integer >=0).
                $tBadge = 1;
                // Audible Notification Option.
                $tSound = 'default';
                //Creating the notification array.
                $notification = array(
                    'title' => $title,
                    'text' => $body,
                    'badge' => $tBadge,
                    'sound' => $tSound
                );
                //This array contains, the token and the notification. The 'to' attribute stores the token.

                $dateNew = array('id' => $arrUserData['important_post_id']);
                $arrayToSend = array(
                    'to' => $token,
                    'notification' => $notification,
                    'priority' => 'high',
                    'data' => $dateNew,
                );
                /* if($device['device_api_version'] >= 2){

                  $dateNew = array('id' => $arrUserData['important_post_id']);

                  $arrayToSend = array(
                  'to' => $token,
                  'notification' => $notification,
                  'priority' => 'high',
                  'data' => $dateNew,
                  );
                  }else{
                  $arrayToSend = array(
                  'to' => $token,
                  'notification' => $notification,
                  'priority' => 'high'
                  );
                  } */

                //Generating JSON encoded string form the above array.
                $json = json_encode($arrayToSend);
                $key = 'AAAAFWklK5g:APA91bFrgNl_zm_zmXSmS8MFhxPwYsZE-9QpT7IQqsGIFWNw9aPHxGjXxC75dlqrR_gmvoDWInswK2z6dl4AVhp1zFdIIAAxzxJIqrF0MKO9XHwvNWJElr2EGy0FuP3Bg69tDE9oKMgF';
                //$key = 'AIzaSyBb8P-6lz2ASWb211IBMbigXnKgaY5ZhxY';
                //Setup headers:
                $headers = array(
                    'Authorization: key=' . $key,
                    'Content-Type: application/json'
                ); //server key here
                //Setup curl, add headers and post parameters.
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                //Send the request
                $result[] = curl_exec($ch);
                //Close request
                curl_close($ch);
            }
        }
        return $result;
        exit;
        //------------ CODE FOR IOS DEVICES START ------------//
    }

    function getCategoryIDList($post_id) {
        global $dbh;
        $catPost = "select GROUP_CONCAT(t.term_id) as cat_id from nc_terms t, nc_term_taxonomy tt, nc_term_relationships tr
where t.term_id=tt.term_id AND tt.term_taxonomy_id=tr.term_taxonomy_id and tr.object_id= " . $post_id . "";
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalCategory = $stmtPost->rowCount();
        if ($totalCategory > 0) {
            $catsArr = $stmtPost->fetchColumn();
            $cats = explode(',', $catsArr);
            return $cats;
        } else {
            $cats = array();
        }
        return $cats;
    }

    //-------- Get Register User's list by language id
    // Language ID  1 : Hindi
    // Language ID  2 : Kannad
    function getAllUserNotification($device, $langauge_id) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_users u";
            $catPost .= " WHERE u.tokenhash !='android' AND u.device = '" . $device . "' AND u.language_id = '" . $langauge_id . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_users u ";
            $catPost .= " WHERE u.device = '" . $device . "' AND u.language_id = '" . $langauge_id . "'";
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Instance User's list by language id
    function getAllInstanceUserNotification($device, $langauge_id) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance ";
            $catPost .= " WHERE tokenhash !='android' AND device = '" . $device . "' AND language_id = '" . $langauge_id . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance ";
            $catPost .= " WHERE device = '" . $device . "' AND language_id = '" . $langauge_id . "'";
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Register User's list by category id FOR ANDROID
    public function getUsersByCategory($cat_id, $device, $language_id) {
        global $dbh;
        $data = array();
        /* if($cat_id == 53 || $cat_id == 5832){
          $stmtPost = $dbh->prepare("SELECT
          u.tokenhash as device_token
          FROM
          nc_user_reference  AS ur
          LEFT JOIN nc_users AS u ON u.ID = ur.user_id
          WHERE
          u.tokenhash != :tokenhash AND
          u.device = :device AND
          u.language_id = :language_id
          ");
          $arrPost = array(":tokenhash" => 'android',":device" => $device,":language_id" => $language_id);
          }else{ */
        $stmtPost = $dbh->prepare("SELECT
                u.tokenhash as device_token
                FROM
                nc_user_reference AS ur
                LEFT JOIN nc_users AS u ON u.ID = ur.user_id
                WHERE
                ur.category_id = :category_id AND
                u.tokenhash != :tokenhash AND
                u.device = :device AND
                u.language_id = :language_id
                ");
        $arrPost = array(":category_id" => $cat_id, ":tokenhash" => 'android', ":device" => $device, ":language_id" => $language_id);
        //}
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Instance User's list by category id FOR ANDROID
    public function getInstanceUsersByCategory($cat_id, $device, $language_id) {
        global $dbh;
        $data = array();
        $stmtPost = $dbh->prepare("SELECT
                i.tokenhash as device_token
                FROM
                nc_instance_reference AS ir
                LEFT JOIN nc_instance AS i ON i.instance_id = ir.instance_id
                WHERE
                ir.category_id = :category_id AND
                i.tokenhash != :tokenhash AND
                i.device = :device AND
                i.language_id = :language_id
                ");
        $arrPost = array(":category_id" => $cat_id, ":tokenhash" => 'android', ":device" => $device, ":language_id" => $language_id);
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Register User's list by category id FOR IOS
    public function getUsersByCategoryIOS($cat_id, $device, $language_id) {
        global $dbh;
        $data = array();
        /* if($cat_id == 53 || $cat_id == 5832){
          $stmtPost = $dbh->prepare("SELECT
          u.tokenhash as device_token
          FROM
          nc_user_reference  AS ur
          LEFT JOIN nc_users AS u ON u.ID = ur.user_id
          WHERE
          ur.category_id = :category_id AND
          u.tokenhash != :tokenhash AND
          u.device = :device AND
          u.language_id = :language_id
          ");
          $arrPost = array(":tokenhash" => 'ios',":device" => $device,":language_id" => $language_id);
          }else{ */
        $stmtPost = $dbh->prepare("SELECT
                    u.tokenhash as device_token
                    FROM
                    nc_user_reference AS ur
                    LEFT JOIN nc_users AS u ON u.ID = ur.user_id
                    WHERE
                    ur.category_id = :category_id AND
                    u.tokenhash != :tokenhash AND
                    u.device = :device AND
                    u.language_id = :language_id
                    ");
        $arrPost = array(":category_id" => $cat_id, ":tokenhash" => 'ios', ":device" => $device, ":language_id" => $language_id);
        //}
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Instance User's list by category id FOR IOS
    public function getInstanceUsersByCategoryIOS($cat_id, $device, $language_id) {
        global $dbh;
        $data = array();
        $stmtPost = $dbh->prepare("SELECT
                i.tokenhash as device_token
                FROM
                nc_instance_reference AS ir
                LEFT JOIN nc_instance AS i ON i.instance_id = ir.instance_id
                WHERE
                ir.category_id = :category_id AND
                i.tokenhash != :tokenhash AND
                i.device = :device AND
                i.language_id = :language_id
                ");
        $arrPost = array(":category_id" => $cat_id, ":tokenhash" => 'ios', ":device" => $device, ":language_id" => $language_id);
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get register user's list by pincode
    function getUserByZipcode($zipcode, $device) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_usermeta AS um";
            $catPost .= " LEFT JOIN nc_users AS u ON um.user_id = u.ID ";
            $catPost .= " WHERE (um.meta_key = 'user_zipcode' AND FIND_IN_SET('" . $zipcode . "', um.meta_value )) AND u.tokenhash !='android' AND u.device = '" . $device . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_usermeta AS um";
            $catPost .= " LEFT JOIN nc_users AS u ON um.user_id = u.ID ";
            $catPost .= " WHERE (um.meta_key = 'user_zipcode' AND FIND_IN_SET('" . $zipcode . "', um.meta_value )) AND u.device = '" . $device . "'";
        }

        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get register user's list by pincode
    function getInstanceUserByZipcode($zipcode, $device) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance";
            $catPost .= " WHERE FIND_IN_SET('" . $zipcode . "', zipcode ) AND tokenhash !='android' AND device = '" . $device . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance";
            $catPost .= " WHERE FIND_IN_SET('" . $zipcode . "', zipcode ) AND device='" . $device . "'";
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //--------- Send Breaking news notification from backend side of website  [Main API Function]
    public function send_single_notification($arrUserData) {
        $data = array();
        $newsId = trim($arrUserData['news_id']);
        $newsData = $this->getSingleNews($newsId);

        if (!empty($newsData)) {
            // ------ ANDROID ---- //
            $androidDevicesListUser = array();
            $androidDevicesListInstance = array();
            //------ Get Register User's Token
            $androidDevicesListUser = $this->getUserNotificationWithLanguage('android', trim($newsData['state_id']));
            //------ Get Instance User's Token
            $androidDevicesListInstance = $this->getInstanceUserNotificationWithLanguage('android', trim($newsData['state_id']));
            $androidDevicesList = array_merge($androidDevicesListInstance, $androidDevicesListUser);
            $androidDevicesList = array_unique(array_map(function($elem) {
                        return $elem['device_token'];
                    }, $androidDevicesList));
            //$androidDevicesList = array('e_KTVfI-yJg:APA91bG9mc-O7pV8GBDM13R50v2_oL_24cKCkVQXdeVQelxgiWAxQ7q1LiTLlZ8dpsRY26kW37K_IKMY2X52CZav0sqxud0HFjZZZQUkvEK-_XYgrAZz9E5jJLyjzouQAh6HrwceK31z');
            if (count($androidDevicesList) > 0) {
                $url = 'https://fcm.googleapis.com/fcm/send';
                $key = 'AAAAFWklK5g:APA91bFrgNl_zm_zmXSmS8MFhxPwYsZE-9QpT7IQqsGIFWNw9aPHxGjXxC75dlqrR_gmvoDWInswK2z6dl4AVhp1zFdIIAAxzxJIqrF0MKO9XHwvNWJElr2EGy0FuP3Bg69tDE9oKMgF';
                //$key = 'AIzaSyBb8P-6lz2ASWb211IBMbigXnKgaY5ZhxY';
                $headers = array(
                    'Authorization: key=' . $key,
                    'Content-Type: application/json'
                );
                $notificationArr = array(
                    "title" => $newsData['title'],
                    "id" => '',
                    "image" => $newsData['image']
                );
                $devideArray = array_chunk($androidDevicesList, 1000);
                foreach ($devideArray AS $device) {
                    $fields = array(
                        'registration_ids' => $device,
                        'priority' => 'high',
                        'data' => array(
                            "message" => $notificationArr
                        )
                    );
                    // Open connection
                    $ch = curl_init();
                    // Set the url, number of POST vars, POST data
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // Disabling SSL Certificate support temporarly
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    // Execute post
                    $result[] = curl_exec($ch);
                    // Close connection
                    curl_close($ch);
                }
            }
            // ------ IOS ---- //
            //------ Get Register User's Token
            /* $iosDevicesListUser = $this->getUserNotificationWithLanguage('ios',trim($newsData['state_id']));
              //------ Get Instance User's Token
              $iosDevicesListInstance = $this->getInstanceUserNotificationWithLanguage('ios',trim($newsData['state_id']));
              $iosDevicesList = array_merge($androidDevicesListInstance,$androidDevicesListUser);
              $androidDevicesList = array_unique(array_map(function($elem){return $elem['device_token'];}, $androidDevicesList));
              if (count($iosDevicesList) > 0) {
              $devices=array();
              $devideArray = array_chunk($iosDevicesList,1000);
              foreach ($devideArray AS $device){
              //foreach ($iosDevicesList AS $device) {
              $ch = curl_init("https://fcm.googleapis.com/fcm/send");
              //The device token.
              $token = $device;
              //Title of the Notification.
              $title = '';
              //Body of the Notification.
              $body = $newsData['title'];
              // The Badge Number for the Application Icon (integer >=0).
              $tBadge = 1;
              // Audible Notification Option.
              $tSound = 'default';
              //Creating the notification array.
              $notification = array(
              'title' => $title,
              'text' => $body,
              'badge' => $tBadge,
              'sound' => $tSound
              );
              //This array contains, the token and the notification. The 'to' attribute stores the token.
              //$dateNew = array('id' => $arrUserData['important_post_id']);
              $arrayToSend = array(
              'to' => $token,
              'notification' => $notification,
              'priority' => 'high'
              //'data' => $dateNew,
              );
              //Generating JSON encoded string form the above array.
              $json = json_encode($arrayToSend);
              $key = 'AIzaSyBb8P-6lz2ASWb211IBMbigXnKgaY5ZhxY';
              //Setup headers:
              $headers = array(
              'Authorization: key=' . $key,
              'Content-Type: application/json'
              ); //server key here

              //Setup curl, add headers and post parameters.
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
              curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

              // Disabling SSL Certificate support temporarly
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              //Send the request
              $result[] = curl_exec($ch);
              //Close request
              curl_close($ch);
              }
              } */
            return $result;
        } else {
            $requestError = $this->generateRequestError("404", false, 7);
            echo json_encode($requestError);
            exit;
        }
    }

    //-------- Get Breaking news story
    public function getSingleNews($news_id) {
        global $dbh;
        $data = array();
        $stmtPost = $dbh->prepare("SELECT *
                    FROM nc_notifications
                    WHERE notification_id = :notification_id");
        $arrPost = array(":notification_id" => $news_id);
        $stmtPost->execute($arrPost);
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $newsData = $stmtPost->fetch(PDO::FETCH_ASSOC);
        } else {
            $newsData = '';
        }
        return $newsData;
    }

    //-------- Get Register User's list by language id
    // Language ID  1 : Hindi
    // Language ID  2 : Kannad
    public function getUserNotificationWithLanguage($device, $language) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_users u";
            $catPost .= " WHERE u.tokenhash !='android' AND u.device = '" . $device . "' AND u.language_id = '" . $language . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        u.tokenhash as device_token
                        FROM nc_users u ";
            $catPost .= " WHERE u.device = '" . $device . "' AND u.language_id = '" . $language . "'";
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    //-------- Get Instance User's list by language id
    public function getInstanceUserNotificationWithLanguage($device, $language) {
        global $dbh;
        if ($device == 'android') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance ";
            $catPost .= " WHERE tokenhash !='android' AND device = '" . $device . "' AND language_id = '" . $language . "'";
        }
        if ($device == 'ios') {
            $catPost = "SELECT
                        tokenhash as device_token
                        FROM nc_instance ";
            $catPost .= " WHERE device = '" . $device . "' AND language_id = '" . $language . "'";
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $postData = array();
        }
        return $postData;
    }

    function getAdvertise($pincode, $category, $languageID, $advPincode = '') {
        // echo $languageID; die;
        global $dbh;
        $curent_date_time = date('Y-m-d H:i:s');
        $bannerImages = IMAGEPATH . "banner/";
        $topImages = IMAGEPATH . "banner/topBanner/";
        $bottomImages = IMAGEPATH . "banner/bottomBanner/";
        $interstitialImages = IMAGEPATH . "banner/interstitialBanner/";
        $detailImages = IMAGEPATH . "banner/detailBanner/";
        $totalAdv = 0;
        if (!empty($pincode)) {
           // echo "pincode"; die;
            $getPostFirst = "SET @search = '$pincode'";
            $getAdvert = "SELECT adverties_id,
                                advertiser_id,
                                adverties_title,
								state,
								pincode,
                                IFNULL(CONCAT('$topImages',top_banner),'') AS top_banner,
                                IFNULL(CONCAT('$bottomImages',bottom_banner),'') AS bottom_banner,
                                IFNULL(CONCAT('$interstitialImages',interstitial_banner),'') AS interstitial_banner,
                                IFNULL(CONCAT('$detailImages',detail_banner),'') AS detail_banner,
								state_visibility,
								local_visibility,
                                adverties_banner_url,
                                adverties_type
                              FROM nc_adverties_new WHERE is_active = 1 AND is_delete = 0 AND local_visibility = 1 AND '$curent_date_time' between TIMESTAMP(adverties_start_date) and TIMESTAMP(adverties_end_date)";

             //echo $getAdvert; die; 
            $stmtAdv1 = $dbh->prepare($getPostFirst);
            $stmtAdv1->execute();
            $stmtAdv = $dbh->prepare($getAdvert);
            $stmtAdv->execute();
            //$stmtAdv->debugDumpParams(); die;
            $totalAdv = $stmtAdv->rowCount();
          //  echo $totalAdv; die;
        }

        if (!empty($category)) {
            	//echo $category; die;
            // echo $advPincode; die;
            $getPostFirst = "SET @search = '$category';";
            $getAdvert = "SELECT
                                adverties_id,
                                advertiser_id,
                                adverties_title,
								state,                               
								pincode,                               
                                IFNULL(CONCAT('$topImages',top_banner),'') AS top_banner,
                                IFNULL(CONCAT('$bottomImages',bottom_banner),'') AS bottom_banner,
                                IFNULL(CONCAT('$interstitialImages',interstitial_banner),'') AS interstitial_banner,
                                IFNULL(CONCAT('$detailImages',detail_banner),'') AS detail_banner,
								state_visibility,
								local_visibility,
                                adverties_banner_url,
                                adverties_type FROM nc_adverties_new WHERE is_active = 1 AND is_delete = 0 AND state_visibility = 1 AND DATE('$curent_date_time') between adverties_start_date and adverties_end_date";
          //  echo $getAdvert; die;
            $stmtAdv1 = $dbh->prepare($getPostFirst);
            $stmtAdv1->execute();
            $stmtAdv = $dbh->prepare($getAdvert);
            $stmtAdv->execute();
            $totalAdv = $stmtAdv->rowCount();
            //echo $totalAdv ; die;
        }

        if (!empty($pincode) && !empty($category)) {
//echo "dsf"; die;
            $getPostPincode = "SET @search = '$pincode';";
            $getPostCat = "SET @search = '$category';";
            $getAdvert = "SELECT adverties_id,
                                advertiser_id,
                                adverties_title,
								state,                               
								pincode, 
                                IFNULL(CONCAT('$topImages',top_banner),'') AS top_banner,
                                IFNULL(CONCAT('$bottomImages',bottom_banner),'') AS bottom_banner,
                                IFNULL(CONCAT('$interstitialImages',interstitial_banner),'') AS interstitial_banner,
                                IFNULL(CONCAT('$detailImages',detail_banner),'') AS detail_banner,
								state_visibility,
								local_visibility,
                                adverties_banner_url,
                                adverties_type
                              FROM nc_adverties_new WHERE is_active = 1 AND is_delete = 0 AND '$curent_date_time' between TIMESTAMP(adverties_start_date, STR_TO_DATE(adverties_start_time, '%h:%i %p')) and TIMESTAMP(adverties_end_date, STR_TO_DATE(adverties_end_time, '%h:%i %p')) || AND pincode REGEXP CONCAT('(^|,)(', REPLACE(@search, ',', '|'), ')(,|$)') AND state REGEXP CONCAT('(^|,)(', REPLACE(@search, ',', '|'), ')(,|$)')";
            $stmtAdv1 = $dbh->prepare($getPostPincode);
            $stmtAdv1->execute();
            $stmtAdv2 = $dbh->prepare($getPostCat);
            $stmtAdv2->execute();
            $stmtAdv = $dbh->prepare($getAdvert);
            $stmtAdv->execute();
            $totalAdv = $stmtAdv->rowCount();
        }

        if ($totalAdv > 0) {
            $advData = $stmtAdv->fetchAll(PDO::FETCH_ASSOC);
            	//echo "<pre>"; print_r($advData); die;
            if (strlen($pincode) > 0) {
                $pinCodeArray = explode(",", $pincode);
                //	echo "<pre>"; print_r($pinCodeArray); die;
                $finalAdvArray = array();

                for ($i = 0; $i < count($advData); $i++) {
                    $advPinCodeArray = explode(",", $advData[$i]["pincode"]);
                    $intersectArray = array_intersect($pinCodeArray, $advPinCodeArray);
//echo "<pre>"; print_r($advPinCodeArray); die;
                    $stateArray = explode(",", $advData[$i]["state"]);
                    if (($languageID == "1") && in_array("15", $stateArray)) {
                        if ($advData[$i]["local_visibility"] == 1 && strlen($advData[$i]["pincode"]) == 0) {
                            $temp = $this->removeImage($advData[$i]);
                            array_push($finalAdvArray, $temp);
                        }
                        if (count($intersectArray) > 0) {
                            $temp = $this->removeImage($advData[$i]);
                            array_push($finalAdvArray, $temp);
                        }
                    } else if (($languageID == "2") && in_array("16", $stateArray)) {
                        if ($advData[$i]["local_visibility"] == 1 && strlen($advData[$i]["pincode"]) == 0) {
                            $temp = $this->removeImage($advData[$i]);
                            array_push($finalAdvArray, $temp);
                        }
                        if (count($intersectArray) > 0) {
                            $temp = $this->removeImage($advData[$i]);
                            array_push($finalAdvArray, $temp);
                        }
                    }
                    /* else{	
                      if($advData[$i]["local_visibility"] == 1 && strlen($advData[$i]["pincode"]) == 0)
                      {
                      $temp = $this->removeImage($advData[$i]);
                      array_push($finalAdvArray,$temp);
                      }
                      if(count($intersectArray) > 0)
                      {
                      $temp = $this->removeImage($advData[$i]);
                      array_push($finalAdvArray,$temp);
                      }
                      } */
                }
                //echo "<pre>"; print_r($finalAdvArray); die;
                //die;
            } else {
                //echo "lg"; die;
			//echo "<pre>eee"; print_r($advData); die;	
                $apiStateArray = explode(",", $category);
                $apiPincodeArray = explode(",", $advPincode);
                $finalAdvArray = array();
                for ($i = 0; $i < count($advData); $i++) {
                    $advStateArray = explode(",", $advData[$i]["state"]);
                    $advPincodeArray = explode(",", $advData[$i]["pincode"]);
				//	echo "<pre>"; print_r($advPincodeArray); //die;

                    $intersectStateArray = array_intersect($apiStateArray, $advStateArray);
                    $intersectPincodeArray = array_intersect($apiPincodeArray, $advPincodeArray);
//echo "<pre>"; print_r($advPincodeArray); die;
                    if (count($intersectStateArray) > 0 && count(array_filter($advPincodeArray)) == 0) {
                        $temp = $this->removeImage($advData[$i]);
                        if (!in_array($temp, $finalAdvArray)) {
                            array_push($finalAdvArray, $temp);
                        }
                    }
                    if ((count($intersectStateArray) > 0 && count($advPincodeArray) > 0 && count($intersectPincodeArray) > 0) || (count($intersectStateArray) > 0 && count($advPincodeArray) > 0 || count($intersectPincodeArray) > 0) ) {
                   // if (count($intersectStateArray) > 0 && count($advPincodeArray) > 0) {
                      //  echo "kf"."<br>"; die;
                        $temp = $this->removeImage($advData[$i]);
						//echo "<pre>"; print_r($temp); //die;
                        //array_push($finalAdvArray,$temp);
                        if (!in_array($temp, $finalAdvArray)) {
							//echo "asda"; //die;
                            array_push($finalAdvArray, $temp);
                        }
                    }
                }
                //die;
            }
        }
//echo "<pre>"; print_r($finalAdvArray); die;
        return $finalAdvArray;
    }

    function removeImage($advData) {
       
        $extensions = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG');
        $top_arr =explode('/', $advData["top_banner"]);
           // echo "<pre>"; print_r($top_arr); 
           // echo count($top_arr); //die;
        if(end($top_arr) != ''){
            if (!in_array(pathinfo($advData["top_banner"])['extension'], $extensions) && array_key_exists("extension",$a)) {
                $advData["top_banner"] = "";
            }        
        }else{
            $advData["top_banner"] = "";
        }
        
        $bottom_arr =explode('/', $advData["bottom_banner"]);
        if(end($bottom_arr) != ''){
        if (!in_array(pathinfo($advData["bottom_banner"])
    ['extension'], 
                $extensions)) {
            $advData["bottom_banner"] = "";
        }
        }else{
            $advData["bottom_banner"] = "";
        }
        
        $interstitial_arr =explode('/', $advData["interstitial_banner"]);
        if(end($interstitial_arr) != ''){
            if (!in_array(pathinfo($advData["interstitial_banner"])['extension'], $extensions)) {
                $advData["interstitial_banner"] = "";
            }
        }else{
            $advData["interstitial_banner"] = "";
        }

        $detail_arr =explode('/', $advData["detail_banner"]);
        if(end($detail_arr) != ''){
            if (!in_array(pathinfo($advData["detail_banner"])['extension'], $extensions)) {
                $advData["detail_banner"] = "";
            }
        }else{
            $advData["detail_banner"] = "";
        }
        //echo "<pre>"; print_r($advData);die;
        return $advData;
    }

    //------- Page Views Count
    function postViewCount($post_id) {
        global $dbh;
        //-------- Total Post Count Update
        $postCount = 0;
        $getPostCount = "SELECT post_view_count FROM nc_posts WHERE ID = " . (int) $post_id;
        $stmtPostCount = $dbh->prepare($getPostCount);
        $stmtPostCount->execute();
        $postCountData = $stmtPostCount->fetchColumn();
        $postCount = $postCountData + 1;

        $updatePostCount = "UPDATE nc_posts SET  post_view_count = '" . $postCount . "' WHERE ID = " . (int) $post_id;
        $dbh->query($updatePostCount);
        //-------- All Count Store
        $postCountTp = 0;
        $date = date('Y-m-d');
        $getPostCountTp = "SELECT total_count FROM nc_post_view_count WHERE DATE(`post_count_date`) = '" . $date . "' AND post_id = " . (int) $post_id;
        $stmtPostCountTp = $dbh->prepare($getPostCountTp);
        $stmtPostCountTp->execute();
        $totalPostCountTp = $stmtPostCountTp->rowCount();
        if ($totalPostCountTp > 0) {
            $postCountData = $stmtPostCountTp->fetchColumn();
            $postCountTp = $postCountData + 1;
            $updatePostCount = "UPDATE nc_post_view_count SET  total_count = '" . $postCountTp . "' WHERE DATE(`post_count_date`) = '" . $date . "' AND post_id = " . (int) $post_id;
            $dbh->query($updatePostCount);
        } else {
            $postCountTp = $postCountTp + 1;
            $sqlPostCountInsert = $dbh->prepare("INSERT INTO `nc_post_view_count`
											(`post_id`,
											 `post_count_date`,
											 `total_count`)
								VALUES     ( :post_id,
											 :post_count_date,
											 :total_count)");
            $sqlPostCountInsert->execute(array(
                ":post_id" => $post_id,
                ":post_count_date" => $date,
                ":total_count" => $postCountTp
            ));
        }
        //-------- All Count Store
    }

    //------- Related Post
    function getRelatedPost($arrPostData, $limit) {
        global $dbh;
        //$limit = 10; //-------- Set Related Post Limit
        //echo "<pre>"; print_r($arrPostData);die;
        $generalData = array();
        if (!empty($arrPostData['pincode'])) {
            $pinCode = explode(',', $arrPostData['pincode']);
            $generalData = array();
            if (count($pinCode) > 0) {
               // echo "ds"; die;
                $total = count($pinCode);
                $resultGetPincode = array();
                //----------- Get All PinCode From Given PinCode
               // echo $arrPostData['pincode']; die;
                $resultGetPincode = $this->getDistrictPincode($arrPostData['pincode']);
              //  echo "<pre>"; print_r($resultGetPincode);die;
                $resultPinCodeList = array();
                if (is_array($resultGetPincode) || is_object($resultGetPincode)) {
                    foreach ($resultGetPincode as $resPinCode) {
                        $resultPinCodeList[] = $resPinCode['pincode'];
                    }
                }
              //  echo "<pre>"; print_r($resultPinCodeList);die;
                $resultAllPinCode = implode(',', $resultPinCodeList);
                $getLocalPost = "SET @search = '$resultAllPinCode';";
                $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        pc.total_count,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                        FROM nc_posts AS p LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.id
                        LEFT JOIN nc_postmeta AS pm ON pm.post_id = p.id
                        WHERE (pm.meta_key = 'post-pin-code' AND pm.meta_value REGEXP CONCAT('(^|,)(', REPLACE(@search, ',', '|'), ')(,|$)'))
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND p.id != " . $arrPostData['post_id'] . "
                        AND pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) GROUP BY pc.post_id
                        ORDER BY total_count DESC,
                        p.post_date DESC,(pm.meta_key = 'post-pin-code'
                        AND pm.meta_value IN (" . $arrPostData['pincode'] . "))  ASC LIMIT $limit";
                $stmtLocalPost = $dbh->prepare($getLocalPost);
                $stmtLocalPost->execute();
            }
        } else if (!empty($arrPostData['cat_id'])) {
            //$category = explode(',',$categoryList);
            $category = $arrPostData['cat_id'];
            $languageID = "";
            if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'])) {
                $languageID = trim($arrPostData['language_id']);
            } else {
                if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'])) {
                    $languageID = $this->getLanguageID(trim($arrPostData['language_id']));
                }
            }
            //--------- Related Post For JHARKHAND AND KARNATAKA
            //------- Jharkhand : 15
            //------- Karnataka : 16
            if ($category == JHARKHAND_STATE || $category == KARNATAKA_STATE) {
                $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        SUM(pc.total_count) as total_count,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' )AS url,
                        t.term_id as cat_id
                        FROM
                        nc_posts AS p LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.id
                        LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                        LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                        LEFT JOIN nc_term_taxonomy AS tt ON (
                                            tr.term_taxonomy_id = tt.term_taxonomy_id
                                          )
                        LEFT JOIN nc_terms AS t ON (
                                            tt.term_id = t.term_id
                                        )
                        WHERE tt.taxonomy = 'category'
                        AND  tt.term_id = " . $category . "
                        AND p.post_type = 'post'
                        AND p.id != " . $arrPostData['post_id'] . "
                        AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                        AND pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) GROUP BY pc.post_id
                        ORDER BY total_count DESC,
                        p.post_date DESC LIMIT $limit";
            } else if ($category == TRENDING_CATEGORY || $category == NATIONAL_CATEGORY) {
                if ($languageID == 1) {
                    $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                        FROM
                        nc_posts AS p
                        LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                        LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                        LEFT JOIN nc_term_taxonomy AS tt ON (
                                            tr.term_taxonomy_id = tt.term_taxonomy_id
                                          )
                        LEFT JOIN nc_terms AS t ON (
                                            tt.term_id = t.term_id
                                        )
                        WHERE
                        tt.taxonomy = 'category'
                        AND  tt.term_id = " . $category . "
                        AND p.post_type = 'post'
                        AND p.id != " . $arrPostData['post_id'] . "
                        AND p.post_status = 'publish' AND ((pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value )) OR NOT EXISTS (
                              SELECT * FROM nc_postmeta
                               WHERE nc_postmeta.meta_key = 'post_language'
                                AND nc_postmeta.post_id = p.ID
                            ))
                        ORDER BY
                        p.post_date DESC LIMIT $limit";
                } else {
                    $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                        FROM
                        nc_posts AS p
                        LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                        LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                        LEFT JOIN nc_term_taxonomy AS tt ON (
                                            tr.term_taxonomy_id = tt.term_taxonomy_id
                                          )
                        LEFT JOIN nc_terms AS t ON (
                                            tt.term_id = t.term_id
                                        )
                        WHERE
                        tt.taxonomy = 'category'
                        AND  tt.term_id = " . $category . "
                        AND p.post_type = 'post'
                        AND p.id != " . $arrPostData['post_id'] . "
                        AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                        ORDER BY
                        p.post_date DESC LIMIT $limit";
                }
            } else {              
                $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url,
                        t.term_id as cat_id
                        FROM
                        nc_posts AS p
                        LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                        LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                        LEFT JOIN nc_term_taxonomy AS tt ON (
                                            tr.term_taxonomy_id = tt.term_taxonomy_id
                                          )
                        LEFT JOIN nc_terms AS t ON (
                                            tt.term_id = t.term_id
                                        )
                        WHERE
                        tt.taxonomy = 'category'
                        AND  tt.term_id = " . $category . "
                        AND p.post_type = 'post'
                        AND p.id != " . $arrPostData['post_id'] . "
                        AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                        ORDER BY
                        p.post_date DESC LIMIT $limit";
            }
        } else {
            $requestError = $this->generateRequestError("404", false, 79);
            echo json_encode($requestError);
            exit;
        }
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
        if ($totalPost > 0) {
            $data = array();
            $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
            $data = $postData;
           // echo "<pre>"; print_r($data); die;
            foreach ($postData as $keyPost => $valuePost) {
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                
                $data[$keyPost]['id'] = $valuePost['id'];
                $data[$keyPost]['post_date'] = $valuePost['post_date'];
                $data[$keyPost]['post_title'] = $valuePost['post_title'];
                $data[$keyPost]['post_content'] = $valuePost['post_content'];
                $data[$keyPost]['url'] = $valuePost['url'];
                if(array_key_exists("total_count",$valuePost)){
                    $data[$keyPost]['total_count'] = $valuePost['total_count'];  
                }
                
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
               // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                               
                if (!empty($authorData)) {
                    if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                         unset($data[$keyPost]['author_id']);
                        $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                    }else{
                       $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                    }
                    $data[$keyPost]['author_name'] = $authorData['author_name'];
                    $data[$keyPost]['author_url'] = $authorData['author_url'];

                } else {
                    $data[$keyPost]['author_name'] = "";
                    $data[$keyPost]['author_url'] = "";
                    $data[$keyPost]['author_id'] = "";
                }
                
                //------- Get Comments
                $commentsData[''] = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;
            }
            $generalData['mainStoryData'] = $data;
            //----------- Get Advertise
            $advertiseList = array();
            if (!empty($arrPostData['pincode'])) {
                $advertiseList = $this->getAdvertise($arrPostData['pincode'], '', $languageID);
            } else if (!empty($arrPostData['cat_id'])) {
                $advertiseList = $this->getAdvertise('', $arrPostData['cat_id'], $languageID);
            } else if (!empty($arrPostData['cat_id']) && !empty($arrPostData['pincode'])) {
                $advertiseList = $this->getAdvertise($arrPostData['pincode'], $arrPostData['cat_id'], $languageID);
            }
            $generalData['advertise'] = $advertiseList;
        } else {
            $generalData = array();
        }
        return $generalData;
        exit;
    }

    //------- Related Story for LOCAL Section
    function relatedPostLocalStory($pincode) {
        global $dbh;
        $limit = 10; //-------- Set Related Post Limit
        $pinCode = explode(',', $pincode);
        $generalData = array();
        if (count($pinCode) > 0) {
            $total = count($pinCode);
            $resultGetPincode = array();
            //----------- Get All PinCode From Given PinCode
            $resultGetPincode = $this->getDistrictPincode($pincode);
            $resultPinCodeList = array();
            foreach ($resultGetPincode as $resPinCode) {
                $resultPinCodeList[] = $resPinCode['pincode'];
            }
            $resultAllPinCode = implode(',', $resultPinCodeList);
            $catPost = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        pc.total_count,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                        FROM nc_posts AS p";
            $catPost .= " LEFT JOIN nc_postmeta AS pm ON pm.post_id = p.id ";
            $catPost .= " LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.id ";
            $catPost .= " WHERE pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) AND (pm.meta_key = 'post-pin-code' AND pm.meta_value IN (" . $resultAllPinCode . ")) AND p.post_type = 'post' AND p.post_status = 'publish' ORDER BY total_count DESC,p.post_date DESC,(pm.meta_key = 'post-pin-code' AND pm.meta_value IN (" . $pincode . "))  ASC LIMIT $limit";
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            if ($totalPost > 0) {
                $data = array();
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
                $data = $postData;
                foreach ($postData as $keyPost => $valuePost) {
                    //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                    //------------- Remove
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                    }
                    //------------ Author Data
                    $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    if (!empty($authorData)) {
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                    }
                    //------- Get Comments
                    $commentsData = array();
                    $commentsData = $this->getCommentsData($valuePost['id']);
                    $data[$keyPost]['comments'] = $commentsData;
                }
                $generalData = $data;
            } else {
                $generalData = array();
            }
            return $generalData;
            exit;
        } else {
            return $generalData;
            exit;
        }
    }

    //------- Related Story for State/Category Section
    function relatedPostByCategory($categoryList, $language_id) {
        global $dbh;
        $generalData = array();
        $limit = 10; //-------- Set Related Post Limit
        // -------  Explode Category
        $category = explode(',', $categoryList);
        $languageID = "";
        if (isset($language_id) && !empty($language_id)) {
            $languageID = trim($language_id);
        } else {
            if (isset($language_id) && !empty($language_id)) {
                $languageID = $this->getLanguageID(trim($language_id));
            }
        }
        if (count($category) > 0) {
            $catList = trim($categoryList);
            //--------- Related Post For JHARKHAND AND KARNATAKA
            //------- Jharkhand : 15
            //------- Karnataka : 16
            if ($catList == JHARKHAND_STATE || $catList == KARNATAKA_STATE) {
                $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            pc.total_count,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) AND
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            ORDER BY total_count DESC,
                            p.post_date DESC LIMIT $limit";
            } else if ($catList == TRENDING_CATEGORY || $catList == NATIONAL_CATEGORY) {
                if ($languageID == 1) {
                    $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND ((pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value )) OR NOT EXISTS (
                                  SELECT * FROM nc_postmeta
                                   WHERE nc_postmeta.meta_key = 'post_language'
                                    AND nc_postmeta.post_id = p.ID
                                ))
                            ORDER BY
                            p.post_date DESC LIMIT $limit";
                } else {
                    $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            ORDER BY
                            p.post_date DESC LIMIT $limit";
                }
            } else {
                $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            ORDER BY
                            p.post_date DESC LIMIT $limit";
            }
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            $data = array();
            if ($totalPost > 0) {
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
                $data = $postData;
                // ----- Total Count
                foreach ($postData as $keyPost => $valuePost) {
                    //------------- Remove
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                    }
                    //------------ Author Data
                    $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    if (!empty($authorData)) {
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                    }
                    //------- Get Comments
                    $commentsData = array();
                    $commentsData = $this->getCommentsData($valuePost['id']);
                    $data[$keyPost]['comments'] = $commentsData;
                }
                $generalData = $data;
                return $generalData;
            } else {
                $generalData = array();
            }
            return $generalData;
        } else {
            return array();
        }
    }

    //----------- Get Trending news(State,National,Trending News) [Main API Function]
    // Category ID : 5832 (For Trending Stories)
    // Category ID : 53 (For India - National Stories)
    function getTrendingNews($arrPostData, $totalCount) {
        global $dbh;
        $generalData = array();
        if (isset($arrPostData['page_no']) && !empty($arrPostData['page_no']) && is_numeric($arrPostData['page_no'])) {
            $startPageNo = $arrPostData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $page_no = 10 * ($startPageNo);
        // -------  Explode Category
        $category = explode(',', $arrPostData['cat_id']);
        $languageID = "";
        if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'])) {
            $languageID = trim($arrPostData['language_id']);
        } else {
            if (isset($arrPostData['user_id']) && !empty($arrPostData['user_id'])) {
                $languageID = $this->getLanguageID(trim($arrPostData['user_id']));
            }
        }
        if (count($category) > 0) {
            $catList = trim($arrPostData['cat_id']);
            $catList = $catList . ',63';
            $subQry = "  AND pm.meta_key = 'post_video_url' AND pm.meta_value != '' ORDER BY p.post_date DESC ";
            /* if(in_array(5832,$category)){
              $subQry = " AND pc.post_count_date >= ( CURDATE() - INTERVAL 7 DAY ) GROUP BY pc.post_id
              ORDER BY total_count DESC, p.post_date DESC ";
              }else{
              $subQry = " AND pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) GROUP BY pc.post_id
              ORDER BY total_count DESC, p.post_date DESC ";
              } */
            if ($languageID == 1) {
                $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            /*SUM(pc.total_count) as total_count,*/
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.id
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.post_id IN(select pm.post_id as postmetaid from nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id where p.post_type = 'post' AND p.post_status = 'publish' AND meta_key = 'post_language' AND meta_value = 1 ORDER BY p.post_date DESC))
                            " . $subQry . "
                            LIMIT $page_no , 10";
            } else {
                $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            /*SUM(pc.total_count) as total_count,*/
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.post_id IN(select pm.post_id as postmetaid from nc_posts AS p LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id where p.post_type = 'post' AND p.post_status = 'publish' AND meta_key = 'post_language' AND meta_value = 2 ORDER BY p.post_date DESC))
                            " . $subQry . "
                            LIMIT $page_no , 10";
            }
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            $data = array();
            if ($totalPost > 0) {
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
                //echo "<pre>"; print_r($postData); die;
                //$data = $postData;
                // ----- Total Count
                foreach ($postData as $keyPost => $valuePost) {
                    //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                    //------------- Remove
                    
                    $data[$keyPost]['id'] = $valuePost['id'];
                    $data[$keyPost]['post_date'] = $valuePost['post_date'];
                    $data[$keyPost]['post_title'] = $valuePost['post_title'];
                    $data[$keyPost]['post_content'] = $valuePost['post_content'];
                    $data[$keyPost]['url'] = $valuePost['url'];
                    
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    $data[$keyPost]['post_video_url'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_video_url") {
                            $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                        }
                    }
                    //------------ Author Data
                    $authorData = $this->getAuthorDataByPostID($valuePost['author_id']);
                  //  $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($data[$keyPost]['author_id']);
                            $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                        $data[$keyPost]['author_id'] = "";
                    }
                    
                    //------- Get Comments
                    $commentsData = array();
                    $commentsData = $this->getCommentsData($valuePost['id']);
                    $data[$keyPost]['comments'] = $commentsData;

                    //----------- Category Return By post
                    $categoryList = $this->getCategoryIDList($valuePost['id']);
                    $matchCat = array_intersect($category, $categoryList);
                    if (count($category) > 1) {
                        if (in_array(JHARKHAND_STATE, $categoryList)) {
                            $data[$keyPost]['cat_id'] = JHARKHAND_STATE;
                        } else if (in_array(KARNATAKA_STATE, $categoryList)) {
                            $data[$keyPost]['cat_id'] = KARNATAKA_STATE;
                        } else if (in_array(TRENDING_CATEGORY, $categoryList)) {
                            $data[$keyPost]['cat_id'] = TRENDING_CATEGORY;
                        } else if (in_array(NATIONAL_CATEGORY, $categoryList)) {
                            $data[$keyPost]['cat_id'] = NATIONAL_CATEGORY;
                        } else {
                            $matchCat = array_intersect($category, $categoryList);
                            if (!empty($matchCat)) {
                                $data[$keyPost]['cat_id'] = $matchCat[0];
                            } else {
                                $data[$keyPost]['cat_id'] = "";
                            }
                        }
                    } else {
                        if (in_array($arrPostData['cat_id'], $categoryList)) {
                            $data[$keyPost]['cat_id'] = $arrPostData['cat_id'];
                        } else {
                            $data[$keyPost]['cat_id'] = "";
                        }
                    }

                    /* $postURL = get_permalink($valuePost['id']);
                      if(!empty($postURL)) {
                      $data[$keyPost]["url"] = $postURL;
                      }else{
                      $data[$keyPost]["url"] = "";
                      }
                      $postCustom = get_post_custom($valuePost['id']);
                      if(isset($postCustom['post-map-longitude-data']) && !empty($postCustom['post-map-longitude-data'][0])){
                      $data[$keyPost]['post_longitude'] = $postCustom['post-map-longitude-data'][0];
                      }else{
                      $data[$keyPost]['post_longitude'] = "";
                      }
                      if(isset($postCustom['post-map-latitude-data']) && !empty($postCustom['post-map-latitude-data'][0])){
                      $data[$keyPost]['post_latitude'] = $postCustom['post-map-latitude-data'][0];
                      }else{
                      $data[$keyPost]['post_latitude'] = "";
                      }
                      //------------- Get Featured Image
                      if (has_post_thumbnail($valuePost['id'])) {
                      $featured_image = get_the_post_thumbnail_url($valuePost['id'], 'full');
                      $data[$keyPost]['featured_image'] = $featured_image;
                      } else {
                      $data[$keyPost]['featured_image'] = '';
                      }
                      // ------- Comments
                      $commentsData = $this->getCommentsData($valuePost['id']);
                      $data[$keyPost]['comments'] = $commentsData; */
                    //------------- Remove
                }

                $generalData['mainStoryData'] = $data;
                //------------ Count Total Post by PinCode
                $totalPostCount = 0;
                if ($totalCount == 1) {
                    if (in_array(TRENDING_CATEGORY, $category) || in_array(NATIONAL_CATEGORY, $category)) {
                        $subQry = "";
                        /* if(in_array(5832,$category)){
                          $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 7 DAY ) OR ";
                          }else{
                          $subQry = " pc.post_count_date >= ( CURDATE() - INTERVAL 3 DAY ) OR ";
                          } */
                        if ($languageID == 1) {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.ID
                            WHERE " . $subQry . "
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND ((pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value )) OR NOT EXISTS (
                                  SELECT * FROM nc_postmeta
                                   WHERE nc_postmeta.meta_key = 'post_language'
                                    AND nc_postmeta.post_id = p.ID
                                ))";
                        } else {
                            $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            LEFT JOIN nc_post_view_count AS pc ON pc.post_id = p.ID
                            WHERE " . $subQry . "
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (" . $catList . ")
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))";
                        }
                    }
                    $stmtPost = $dbh->prepare($catPost);
                    $stmtPost->execute();
                    $total = $stmtPost->rowCount();
                    if ($total > 0) {
                        $totalPostCount = $total;
                    } else {
                        $totalPostCount = 0;
                    }
                }
                $generalData['totalPost'] = $totalPostCount;
                return $generalData;
            } else {
                $arrResponse = $this->generateRequestError("404", false, 80);
                echo json_encode($arrResponse);
                exit;
            }
        } else {
            $requestError = $this->generateRequestError("404", false, 15);
            echo json_encode($requestError);
            exit;
        }
    }

    //----------- Get Video News [Main API Function]
    function getVideoStory($arrPostData) {
        global $dbh;
        if (isset($arrPostData['page_no']) && !empty($arrPostData['page_no']) && is_numeric($arrPostData['page_no'])) {
            $startPageNo = $arrPostData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $page_no = 10 * ($startPageNo);
        $languageID = "";
        if (isset($arrPostData['language_id']) && !empty($arrPostData['language_id'])) {
            $languageID = trim($arrPostData['language_id']);
        } else {
            if (isset($arrPostData['user_id']) && !empty($arrPostData['user_id'])) {
                $languageID = $this->getLanguageID(trim($arrPostData['user_id']));
            }
        }
        if (!empty($arrPostData['cat_id'])) {
            $catPost = "SELECT DISTINCT
                            p.id,
							p.post_date,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('" . SITEURL . "',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id = " . $arrPostData['cat_id'] . "
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'
                            AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            AND EXISTS (
                            SELECT * FROM nc_postmeta WHERE nc_postmeta.meta_key = 'post_video_url'
                            AND nc_postmeta.post_id = p.ID AND nc_postmeta.meta_value IS NOT NULL AND nc_postmeta.meta_value <>'')
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 10";
            /* AND (pm.meta_key = 'post_video_url' AND pm.meta_key IS NOT NULL OR pm.meta_key <> '') */
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
            $data = array();
            if ($totalPost > 0) {
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
                //	echo "<pre>"; print_r($postData); die;
                $data = $postData;
                foreach ($postData as $keyPost => $valuePost) {
                    //------------- Remove
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $data[$keyPost]['post_video_url'] = "";
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post_video_url") {
                            $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                        }
                    }
                }
                $generalData['mainStoryData'] = $data;
                $totalPostCount = 0;
                $catPostTotal = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id = " . $arrPostData['cat_id'] . "
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'
                            AND (pm.meta_key = 'post_language' AND FIND_IN_SET('" . $languageID . "', pm.meta_value ))
                            AND EXISTS (
                            SELECT * FROM nc_postmeta WHERE nc_postmeta.meta_key = 'post_video_url'
                            AND nc_postmeta.post_id = p.ID AND nc_postmeta.meta_value IS NOT NULL AND nc_postmeta.meta_value <>'')
                            ";
                /* AND (pm.meta_key = 'post_video_url' AND pm.meta_key IS NOT NULL OR pm.meta_key <> '') */
                $stmtPostTotal = $dbh->prepare($catPostTotal);
                $stmtPostTotal->execute();
                $totalPostCount = $stmtPostTotal->rowCount();
                $generalData['totalPost'] = $totalPostCount;
                return $generalData;
            }
        } else {
            return array();
        }
    }

    //------------ Get Special Story
    function getSpecialStory($pincode, $category, $language_id, $page_no_special_story) {
       // echo "jj".$page_no_special_story; die;
        global $dbh;
        $totalPost = 0;
        if (!empty($pincode)) {
            $getStory = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        ss.story_type,
                        ss.video_story,
                        ss.story_position,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url
                        FROM nc_special_story AS ss LEFT JOIN nc_posts AS p ON p.ID = ss.post_id
                        WHERE
                        ss.pincode IN (" . $pincode . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND ss.language_id = '" . $language_id . "'
                        ORDER BY ss.story_position DESC,p.post_date DESC limit 1";
           
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();


            //-----------------Special cetegory	 for local section

            $getSpecialcat = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,                       
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url
                        FROM
                        nc_posts AS p								
						 LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (50081)
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND pm.meta_key = 'post_language' AND pm.meta_value = '" . $language_id . "'
                            ORDER BY
                            p.post_date DESC limit $page_no_special_story , 4";
            //echo $getSpecialcat; die;		

            $stmtSpecialcat = $dbh->prepare($getSpecialcat);
            $stmtSpecialcat->execute();
            $totalSpecialcat = $stmtSpecialcat->rowCount();
            //echo "kf--". $totalSpecialcat; die;
        }
        if (!empty($category)) {
            //	echo $category; die;
            /* if($page_no == 0){
              $page_no = 2*($page_no);
              $limit = "LIMIT $page_no , 2";
              }else{
              //echo $page_no; die;
              $page_no = 4*($page_no);
              $page_no = $page_no - 2;
              //echo $page_no; die;
              $limit = "LIMIT $page_no , 4";
              //echo $limit; die;
              } */
            $getStory = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_title,
                        p.post_content,
                        ss.story_type,
                        ss.video_story,
                        ss.story_position,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url
                        FROM
                        nc_special_story AS ss LEFT JOIN nc_posts AS p ON p.ID = ss.post_id
                        WHERE
                        ss.state_id IN (" . $category . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND ss.language_id = '" . $language_id . "'
                        ORDER BY ss.story_position ASC,p.post_date DESC limit $page_no_special_story , 4";
//echo $getStory; die;
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();
            //-----------------Special cetegory	 for state section

            $getSpecialcat = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_title,
                        p.post_content,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url,
                             t.term_id as cat_id
                        FROM
                        nc_posts AS p								
						 LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            LEFT JOIN nc_term_relationships AS tr ON (p.ID = tr.object_id)
                            LEFT JOIN nc_term_taxonomy AS tt ON (
                                                tr.term_taxonomy_id = tt.term_taxonomy_id
                                              )
                            LEFT JOIN nc_terms AS t ON (
                                                tt.term_id = t.term_id
                                            )
                            WHERE
                            tt.taxonomy = 'category'
                            AND  tt.term_id IN (50081)
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish' AND pm.meta_key = 'post_language' AND pm.meta_value = '" . $language_id . "'
                            ORDER BY
                            p.post_date DESC limit $page_no_special_story , 4";
            //echo $getSpecialcat; die;		

            $stmtSpecialcat = $dbh->prepare($getSpecialcat);
            $stmtSpecialcat->execute();
            $totalSpecialcat = $stmtSpecialcat->rowCount();
            //echo "kf--". $totalSpecialcat; die;
        }
        $data = array();
        if ($totalPost > 0) {
            $postStoryList = $stmtStory->fetchAll(PDO::FETCH_ASSOC);
            $data = $postStoryList;

            foreach ($postStoryList as $keyPost => $valuePost) {
                $data[$keyPost]['id'] = $valuePost['id'];
                $data[$keyPost]['post_date'] = $valuePost['post_date'];
                $data[$keyPost]['post_title'] = $valuePost['post_title'];
                $data[$keyPost]['post_content'] = $valuePost['post_content'];
                $data[$keyPost]['story_type'] = $valuePost['story_type'];
                $data[$keyPost]['video_story'] = $valuePost['video_story'];
                $data[$keyPost]['story_position'] = $valuePost['story_position'];
                $data[$keyPost]['url'] = $valuePost['url'];
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);

                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                $data[$keyPost]['post_video_url'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_video_url") {
                        $data[$keyPost]['post_video_url'] = $valueData['meta_value'];
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
              //  $authorData = $this->getAuthorDataByID($valuePost['author_id']);               
                
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($data[$keyPost]['author_id']);
                            $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                        $data[$keyPost]['author_id'] = "";
                    }
                
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;
                 $commentsDataCount = $this->getCommentsDataCount($valuePost['id']);
                $data[$keyPost]['comment_count'] = $commentsDataCount;
            }
        }
        $dataSpecialcat = array();
        if ($totalSpecialcat > 0) {
            $postSpecialcat = $stmtSpecialcat->fetchAll(PDO::FETCH_ASSOC);
           // $dataSpecialcat = $postSpecialcat;
            //echo "<pre>"; print_r($dataSpecialcat); die;
            
            
           
            
            foreach ($postSpecialcat as $keyPost => $valuePost) {
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                
                 $dataSpecialcat[$keyPost]['id'] = $valuePost['id'];
                 $dataSpecialcat[$keyPost]['post_date'] = $valuePost['post_date'];
                 $dataSpecialcat[$keyPost]['post_title'] = $valuePost['post_title'];
                 $dataSpecialcat[$keyPost]['post_content'] = $valuePost['post_content'];
                 $dataSpecialcat[$keyPost]['url'] = $valuePost['url'];   
                  $dataSpecialcat[$keyPost]['cat_id'] = $valuePost['cat_id'];
                
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $dataSpecialcat[$keyPost]['featured_image'] = $postImage;
                } else {
                    $dataSpecialcat[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $dataSpecialcat[$keyPost]['story_type'] = "";
                $dataSpecialcat[$keyPost]['video_story'] = "";
                $dataSpecialcat[$keyPost]['story_position'] = "3";

                $dataSpecialcat[$keyPost]['post_longitude'] = "";
                $dataSpecialcat[$keyPost]['post_latitude'] = "";
                $dataSpecialcat[$keyPost]['post_pincode'] = "";
                $dataSpecialcat[$keyPost]['post_language'] = "";
                $dataSpecialcat[$keyPost]['post_video_url'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $dataSpecialcat[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $dataSpecialcat[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $dataSpecialcat[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $dataSpecialcat[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_video_url") {
                        $dataSpecialcat[$keyPost]['post_video_url'] = $valueData['meta_value'];
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
              //  $authorData = $this->getAuthorDataByID($valuePost['author_id']);                
                
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($dataSpecialcat[$keyPost]['author_id']);
                            $dataSpecialcat[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $dataSpecialcat[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $dataSpecialcat[$keyPost]['author_name'] = $authorData['author_name'];
                        $dataSpecialcat[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $dataSpecialcat[$keyPost]['author_name'] = "";
                        $dataSpecialcat[$keyPost]['author_url'] = "";
                        $dataSpecialcat[$keyPost]['author_id'] = "";
                    }
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $dataSpecialcat[$keyPost]['comments'] = $commentsData;
            }
            //echo "<pre>"; print_r($dataSpecialcat); die;
        } else {
            $dataSpecialcat = array();
        }
        // echo "<pre>"; print_r($data); die;
        // echo "<pre>"; print_r($dataSpecialcat); die;
        $arryMerge = array_merge($data, $dataSpecialcat);
        // echo "<pre>"; print_r($arryMerge); die;
        return $arryMerge;
    }

    //------------ Get Pinning Story
    function getPinningStoryPostIds($pincode, $category, $language_id) {
        global $dbh;
        $totalPost = 0;
        if (!empty($pincode)) {
            $getStory = "SELECT
                        GROUP_CONCAT(DISTINCT(p.id))
                        FROM  nc_special_story AS pn LEFT JOIN nc_posts AS p ON p.ID = pn.post_id
                        WHERE
                        pn.pincode IN (" . $pincode . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND pn.language_id = '" . $language_id . "'
                        ORDER BY pn.story_position ASC, p.post_date DESC LIMIT 5";
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();
        }
        if (!empty($category)) {
            $getStory = "SELECT
                        GROUP_CONCAT(DISTINCT(p.id))
                        FROM
                         nc_special_story AS pn LEFT JOIN nc_posts AS p ON p.ID = pn.post_id
                        WHERE
                        pn.state_id IN (" . $category . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND pn.language_id = '" . $language_id . "'
                        ORDER BY pn.story_position ASC, p.post_date DESC LIMIT 5";
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();
        }
        if (!empty($totalPost)) {
            $postStoryList = $stmtStory->fetchColumn();
            $data = $postStoryList;
        } else {
            $data = "";
        }
        return $data;
    }

    //------------ Get Pinning Story
    function getPinningStory($pincode, $category, $language_id) {
        global $dbh;
        //$date = date('Y-m-d h:i:s');
        $totalPost = 0;
        if (!empty($pincode)) {
            $getStory = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        pn.story_type,
                        pn.story_position,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url
                        FROM nc_pinning_story AS pn LEFT JOIN nc_posts AS p ON p.ID = pn.post_id
                        WHERE
                        pn.pincode IN (" . $pincode . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND pn.language_id = '" . $language_id . "'
                        ORDER BY pn.story_position ASC, p.post_date DESC LIMIT 5";
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();
        }
        if (!empty($category)) {
            $getStory = "SELECT DISTINCT
                        p.id,
                        p.post_date,
                        p.post_content,
                        p.post_title,
                        pn.story_type,
                        pn.story_position,
                        p.post_author as author_id,
                        IFNULL(CONCAT('" . SITEURL . "',p.post_name,'/'),'' ) AS url
                        FROM
                        nc_pinning_story AS pn LEFT JOIN nc_posts AS p ON p.ID = pn.post_id
                        WHERE
                        pn.state_id IN (" . $category . ")
                        AND p.post_type = 'post'
                        AND p.post_status = 'publish'
                        AND pn.language_id = '" . $language_id . "'
                        ORDER BY pn.story_position ASC, p.post_date DESC LIMIT 5";
            $stmtStory = $dbh->prepare($getStory);
            $stmtStory->execute();
            $totalPost = $stmtStory->rowCount();
        }
        $data = array();
        if ($totalPost > 0) {
            $postStoryList = $stmtStory->fetchAll(PDO::FETCH_ASSOC);
            $data = $postStoryList;
            foreach ($postStoryList as $keyPost => $valuePost) {
                //$data[$keyPost] = $this->getPostCustomData($valuePost['id']);
                //------------- Remove
                $postImage = $this->getPostFeatureImage($valuePost['id']);
                if (!empty($postImage)) {
                    $data[$keyPost]['featured_image'] = $postImage;
                } else {
                    $data[$keyPost]['featured_image'] = "";
                }
                $postMetaData = $this->gePostMetaData($valuePost['id']);
                $data[$keyPost]['post_longitude'] = "";
                $data[$keyPost]['post_latitude'] = "";
                $data[$keyPost]['post_pincode'] = "";
                $data[$keyPost]['post_language'] = "";
                foreach ($postMetaData as $keyUser => $valueData) {
                    if ($valueData['meta_key'] == "post-map-longitude-data") {
                        $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-map-latitude-data") {
                        $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post-pin-code") {
                        $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                    }
                    if ($valueData['meta_key'] == "post_language") {
                        $data[$keyPost]['post_language'] = $valueData['meta_value'];
                    }
                }
                //------------ Author Data
                $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                if (!empty($authorData)) {
                    $data[$keyPost]['author_name'] = $authorData['author_name'];
                    $data[$keyPost]['author_url'] = $authorData['author_url'];
                } else {
                    $data[$keyPost]['author_name'] = "";
                    $data[$keyPost]['author_url'] = "";
                }
                //------- Get Comments
                $commentsData = array();
                $commentsData = $this->getCommentsData($valuePost['id']);
                $data[$keyPost]['comments'] = $commentsData;
            }
        } else {
            $data = array();
        }
        return $data;
    }

    //------------ Get post by Author id
    function getPostByAuthor($arrPostData, $totalCount) {
//        ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
       // print_r($arrPostData); die;
        global $dbh;
        $data = array();
        if (isset($arrPostData['page_no']) && !empty($arrPostData['page_no']) && is_numeric($arrPostData['page_no'])) {
            $startPageNo = $arrPostData['page_no'];
        } else {
            $startPageNo = 0;
        }
        $page_no = 10 * ($startPageNo);
        $generalData = array();
        // -------  Author Profile
        
        $catPost = "SELECT post_author from nc_posts where post_author = ".$arrPostData['author_id'];
       // echo $catPost; die;
        $stmtPost = $dbh->prepare($catPost);
        $stmtPost->execute();
        $totalPost = $stmtPost->rowCount();
   //    echo $totalPost; die;
        if($totalPost>0){
            $author = $this->getAuthorDataByPostID($arrPostData['author_id'],'');
           //  echo "<pre>";                print_r($author); die;
        }else{
            //echo "ee"; die;
            $author['register_user'] = 'guest';          
        }
        
       // echo "<pre>aaa";  print_r($author); die;
      //  $author = 1;
       // echo 'aa--'.$author; die;
        if (!empty($author)) {
            //echo "dfc";  die;
            $generalData["author"] = $author;
            if(array_key_exists("register_user",$author) && $author['register_user'] == 'register_user'){
            $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.post_author as author_id,
                            IFNULL(CONCAT('\" . SITEURL . \"',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            WHERE
                            p.post_author = " . $arrPostData['author_id'] . "
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 10";
                
            }else{
             //   echo "sad"; die;
            $catPost = "SELECT DISTINCT
                            p.id,
                            p.post_date,
                            p.post_content,
                            p.post_title,
                            p.id as author_id,
                            IFNULL(CONCAT('\" . SITEURL . \"',post_name,'/'),'' )AS url
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            WHERE
                             pm.meta_key = '_molongui_guest_author_id' AND pm.meta_value = ".$arrPostData['author_id']."
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'
                            ORDER BY
                            p.post_date DESC LIMIT $page_no , 10";
            }
            $stmtPost = $dbh->prepare($catPost);
            $stmtPost->execute();
            $totalPost = $stmtPost->rowCount();
           
            if ($totalPost > 0) {
                $postData = $stmtPost->fetchAll(PDO::FETCH_ASSOC);
               // $data = $postData;
             //  echo "<pre>";                print_r($postData); die;
                foreach ($postData as $keyPost => $valuePost) {
                    $data[$keyPost]['id'] = $valuePost['id'];
                    $data[$keyPost]['post_date'] = $valuePost['post_date'];
                    $data[$keyPost]['post_title'] = $valuePost['post_title'];
                    $data[$keyPost]['post_content'] = $valuePost['post_content'];
                    $data[$keyPost]['url'] = $valuePost['url'];
                     
                    $postImage = $this->getPostFeatureImage($valuePost['id']);
                    if (!empty($postImage)) {
                        $data[$keyPost]['featured_image'] = $postImage;
                    } else {
                        $data[$keyPost]['featured_image'] = "";
                    }
                    $postMetaData = $this->gePostMetaData($valuePost['id']);
                    $data[$keyPost]['post_longitude'] = "";
                    $data[$keyPost]['post_latitude'] = "";
                    $data[$keyPost]['post_pincode'] = "";
                    $data[$keyPost]['post_language'] = "";
                    foreach ($postMetaData as $keyUser => $valueData) {
                        if ($valueData['meta_key'] == "post-map-longitude-data") {
                            $data[$keyPost]['post_longitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-map-latitude-data") {
                            $data[$keyPost]['post_latitude'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post-pin-code") {
                            $data[$keyPost]['post_pincode'] = $valueData['meta_value'];
                        }
                        if ($valueData['meta_key'] == "post_language") {
                            $data[$keyPost]['post_language'] = $valueData['meta_value'];
                        }
                    }
                    //------------ Author Data
                    $authorData = $this->getAuthorDataByPostID($valuePost['author_id'],$valuePost['id']);
                   // $authorData = $this->getAuthorDataByID($valuePost['author_id']);
                    if (!empty($authorData)) {
                        if(array_key_exists("guest_user",$authorData) && $authorData['guest_user'] == 'guest'){
                             unset($data[$keyPost]['author_id']);
                            $data[$keyPost]['author_id'] = $authorData['author_id'];                            
                        }else{
                           $data[$keyPost]['author_id'] = $valuePost['author_id'];    
                        }
                        $data[$keyPost]['author_name'] = $authorData['author_name'];
                        $data[$keyPost]['author_url'] = $authorData['author_url'];
                        
                    } else {
                        $data[$keyPost]['author_name'] = "";
                        $data[$keyPost]['author_url'] = "";
                        $data[$keyPost]['author_id'] = "";
                    }
                    //------- Get Comments
                    $commentsData = array();
                    $commentsData = $this->getCommentsData($valuePost['author_id']);
                    $data[$keyPost]['comments'] = $commentsData;
                }
                $generalData['mainStoryData'] = $data;

                //------------ Count Total Post by PinCode
                $totalPostCount = 0;
               // echo $author['register_user']; die;
                if ($totalCount == 1) {
                    if(array_key_exists("register_user",$author) && $author['register_user'] == 'register_user'){
                        $catPost = "SELECT DISTINCT
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            WHERE
                            p.post_author = " . $arrPostData['author_id'] . "
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'";
                     }else{
                          $catPost = "SELECT DISTINCT                   
                            p.id
                            FROM
                            nc_posts AS p
                            LEFT JOIN nc_postmeta AS pm ON p.ID = pm.post_id
                            WHERE
                            pm.meta_key = '_molongui_guest_author_id' AND pm.meta_value = ".$arrPostData['author_id']. "
                            AND p.post_type = 'post'
                            AND p.post_status = 'publish'";
                     }
                    $stmtPost = $dbh->prepare($catPost);
                    $stmtPost->execute();
                    $total = $stmtPost->rowCount();
                    if ($total > 0) {
                        $totalPostCount = $total;
                    } else {
                        $totalPostCount = 0;
                    }
                }
                $generalData['totalPost'] = $totalPostCount;
                return $generalData;
            } else {
                $generalData["author"] = $author;
                $generalData["mainStoryData"] = array();
                $arrResponse = $this->generateRequestError("201", true, 9, $generalData);
                echo json_encode($arrResponse);
                exit;
            }
        } else {
            $requestError = $this->generateRequestError("404", false, 16);
            echo json_encode($requestError);
            exit;
        }
    }

    //---------   [Main API Function]
    function getSuggestedPincodeList() {
        global $dbh;
        $stmtPincode = "SELECT suggested_id,state_id,pincode FROM nc_suggested_pincode WHERE is_active = 1 AND is_deleted = 0";
        $arrPincode = $dbh->prepare($stmtPincode);
        $arrPincode->execute();
        $totalPincode = $arrPincode->rowCount();
        if ($totalPincode > 0) {
            $pincodeData = $arrPincode->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $pincodeData = "";
        }
        return $pincodeData;
    }

    /*     * ************            Un-Used Function         ************* */

    //------------ Count Total Post by PinCode
    /* function localTotalPostCount($pinCodeList){
      global $dbh;
      if(!empty($pinCodeList)) {
      $resultGetPincode = array();
      //----------- Get All PinCode From Given PinCode
      $resultGetPincode = $this->getDistrictPincode($pinCodeList);
      $resultPinCodeList = array();
      foreach($resultGetPincode as $resPinCode){
      $resultPinCodeList[] = $resPinCode['pincode'];
      }
      $resultAllPinCode = implode(',', $resultPinCodeList);

      $catPost = "SELECT DISTINCT
      p.id
      FROM nc_posts AS p";
      $catPost .= " LEFT JOIN nc_postmeta AS pm ON pm.post_id = p.id ";
      $catPost .= " WHERE (pm.meta_key = 'post-pin-code' AND pm.meta_value IN (" . $resultAllPinCode . ")) AND p.post_type = 'post' AND p.post_status = 'publish' ORDER BY p.post_date DESC,(pm.meta_key = 'post-pin-code' AND pm.meta_value IN (" . $pinCodeList . "))  ASC";
      $stmtPost = $dbh->prepare($catPost);
      $stmtPost->execute();
      $total = $stmtPost->rowCount();
      if($total > 0){
      $totalPost = $total;
      }else{
      $totalPost = 0;
      }
      }else{
      $totalPost = 0;
      }

      return $totalPost;
      } */

    //-----------  Get post extra data
    //function getPostData($post_id){
    /* global $wpdb,$dbh,$post;
      $data = array();
      //------------- Get Featured Image
      if ( has_post_thumbnail( $post_id ) ) {
      $featured_image = get_the_post_thumbnail_url($post_id,'full');
      //$featured_image =  wp_get_attachment_url( get_post_thumbnail_id($post_id) );
      $data['featured_image'] = $featured_image;
      }else{
      $data['featured_image'] = '';
      }
      //------- Get Comments
      $commentsData = $this->getCommentsData($post_id);
      $data['comments'] = $commentsData; */
    //------------- Get Category
    /* $cats = $this->getCategoryDataByPost($post_id);
      $data['categories'] = $cats; */
    //------------- Get Tags
    /* $postTags = wp_get_post_tags($post_id);
      if(!empty($postTags)){
      $data['tags'] = $postTags;
      }else{
      $data['tags'] = array();
      } */
    //------------- Custom Fields
    /* $postCustom = get_post_custom($post_id);
      if(!empty($postCustom)){
      $data['custom_fields'] = $postCustom;
      }else{
      $data['custom_fields'] = array();
      } */
    //------------- Get Next Previous Links
    /* $post = get_post($post_id);
      $previous_post = get_previous_post();
      $next_post = get_next_post();
      if(!empty($next_post)) {
      $data['next_post_id'] = $next_post->ID;
      }else{
      $data['next_post_id'] = '';
      }
      if(!empty($previous_post)) {
      $data['previous_post_id'] = $previous_post->ID;
      }else{
      $data['previous_post_id'] = '';
      } */
    //return $data;
    //}
}
