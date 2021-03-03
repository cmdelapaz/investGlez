<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_in extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function sign_in($u,$p)
    {
        $this->db->where('username', $u);
        $this->db->where('pswd', $p);
        $sql = $this->db->get('investor_tbl');
        if($sql->num_rows() > 0){
            return $sql->row();
        }else{
            return false;
        }
    }

    public function fetch_single_privilege($invtID){
        $this->db->where('investor_tbl_investorID', $invtID);
        $sql = $this->db->get('privilege_tbl');
        if($sql->num_rows() > 0){
            return  $sql->row();
        }else{
            return false;
        }
    }
    
    
    
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
      $output = NULL;
      if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
          $ip = $_SERVER["REMOTE_ADDR"];
          if ($deep_detect) {
              if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
              if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                  $ip = $_SERVER['HTTP_CLIENT_IP'];
          }
      }
      $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
      $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
      $continents = array(
          "AF" => "Africa",
          "AN" => "Antarctica",
          "AS" => "Asia",
          "EU" => "Europe",
          "OC" => "Australia (Oceania)",
          "NA" => "North America",
          "SA" => "South America"
      );
      if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
          $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
          if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
              switch ($purpose) {
                  case "location":
                      $output = array(
                          "city"           => @$ipdat->geoplugin_city,
                          "state"          => @$ipdat->geoplugin_regionName,
                          "country"        => @$ipdat->geoplugin_countryName,
                          "country_code"   => @$ipdat->geoplugin_countryCode,
                          "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                          "continent_code" => @$ipdat->geoplugin_continentCode
                      );
                      break;
                  case "address":
                      $address = array($ipdat->geoplugin_countryName);
                      if (@strlen($ipdat->geoplugin_regionName) >= 1)
                          $address[] = $ipdat->geoplugin_regionName;
                      if (@strlen($ipdat->geoplugin_city) >= 1)
                          $address[] = $ipdat->geoplugin_city;
                      $output = implode(", ", array_reverse($address));
                      break;
                  case "city":
                      $output = @$ipdat->geoplugin_city;
                      break;
                  case "state":
                      $output = @$ipdat->geoplugin_regionName;
                      break;
                  case "region":
                      $output = @$ipdat->geoplugin_regionName;
                      break;
                  case "country":
                      $output = @$ipdat->geoplugin_countryName;
                      break;
                  case "countrycode":
                      $output = @$ipdat->geoplugin_countryCode;
                      break;
              }
          }
      }
      return $output;
    }
    
    
    

  }
