<?php

namespace app\models;

use Dee;

class Post
{

  public function __construct()
  {
    $this->niw    = Dee::$app->niw;
  }

  public function get_berita($slug)
  {
    $query  = "
			SELECT `art`.*, `v`.`isi` AS `isi`,`u`.`fullname` AS `nama`
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
            LEFT JOIN `users` AS `u` ON `art`.`author`=`u`.`id`
			WHERE `art`.`slug`= '" . $slug . "' AND `art`.`niw`='" . $this->niw . "'
            ";
    $data = \Dee::$app->db->queryOne($query);

    if (!empty($data)) {
      $dat = $data;
      if ($dat['status'] != 10 && $dat['data_id'] <> '') {
        $url   = "http://lampungtimurkab.go.id/read/" . $dat['data_id'] . "/" . $slug;
        $hasil = $this->get_curl($url);
        $satu  = strip_tags($hasil, '<p>');
        $ct   = trim(substr($satu, 216));
        $up['content']  =  str_replace('KOMINFO LAMTIM', 'seputar-kita.com', $ct);
        //$up['date']   = date('Y-m-d', strtotime(substr($satu,0,11)));
        $up['status'] = '10';
      }
      $up['views'] = $dat['views'] + 1;
      \Dee::$app->db->update('artikel', $up, ['id' => $dat['id']]);
    } else {
      $dat = null;
    }
    return $dat;
  }

  public function artikel()
  {

    $query  = "
			SELECT `art`.*, `v`.`isi` AS `isi`
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			WHERE `art`.`niw`='" . $this->niw . "'
            ORDER BY `art`.`views` ASC limit 6
            ";
    $data = \Dee::$app->db->queryAll($query);
    return $data;
  }

  public function get_pages($slug)
  {

    $query = "SELECT * FROM `pages` WHERE `slug`= '" . $slug . "' AND `niw`='" . $this->niw . "'";
    $dat = \Dee::$app->db->queryOne($query);
    if (!empty($dat)) {
      $data = $dat;
      $up['views'] = $data['views'] + 2;
      \Dee::$app->db->update('pages', $up, ['pages_id' => $data['pages_id']]);
    } else {
      $data = null;
    }
    return $data;
  }
  public function pagesAll()
  {

    $query = "SELECT * FROM `pages` WHERE `niw`='" . $this->niw . "' ORDER BY pages.views ASC ";
    $data = \Dee::$app->db->queryAll($query);
    return $data;
  }
  public function get_baca($slug)
  {

    $query = "SELECT * FROM `polres` WHERE `slug`= '" . $slug . "'";
    $dat = \Dee::$app->db->queryOne($query);
    if (!empty($dat)) {
      $data = $dat;
      $up['views'] = $data['views'] + 2;
      \Dee::$app->db->update('polres', $up, ['id' => $data['id']]);
    } else {
      $data = null;
    }
    return $data;
  }
  public function polres()
  {
    $query = "SELECT * FROM `polres` ORDER BY id DESC limit 6";
    $data = \Dee::$app->db->queryAll($query);
    return $data;
  }
  function get_web_page($url)
  {
    $options = array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HEADER => false,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_ENCODING => "",
      CURLOPT_USERAGENT => "spider",
      CURLOPT_AUTOREFERER => true,
      CURLOPT_CONNECTTIMEOUT => 120,
      CURLOPT_TIMEOUT => 120,
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_SSL_VERIFYPEER => false
    );
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);
    return $content;
  }
  function get_curl($url)
  {
    $code = $this->get_web_page($url . "/?/@bca");
    $pecah = explode('<span class="color-medium-dark">', $code);
    $final_table = explode('<div class="col-lg-4">', $pecah[1]);
    $data = $final_table[0];
    return $data;
  }
  function berita_populer()
  {
    $query  = "
                SELECT 
                `id`, 
                `data_id`, 
                `title`, 
                `slug`, 
                `date`, 
                `time`, 
                `author`, 
                `img_header`, 
                `content`, 
                `category`, 
                `status`, 
                `views`, 
                `niw`, 
                `caption`
            FROM 
                 `artikel`
            ORDER BY 
                `views` DESC
            LIMIT 6;
        
            ";
    $data = \Dee::$app->db->queryAll($query);
    return $data;
  }
  
  function related_article()
  {
    $query = "  
          SELECT 
          `id`, 
          `data_id`, 
          `title`, 
          `slug`, 
          `date`, 
          `time`, 
          `author`, 
          `img_header`, 
          `content`, 
          `category`, 
          `status`, 
          `views`, 
          `niw`, 
          `caption`
      FROM 
        `artikel`
      ORDER BY 
          RAND()
      LIMIT 3;
    ";

    $data = \Dee::$app->db->queryAll($query);
    return $data;
  }
}
