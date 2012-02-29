<?php
$site_root = $_SERVER['DOCUMENT_ROOT'];
$api=true;
include "$site_root/include/db.php";
include "$site_root/include/general.php";
include "$site_root/include/search_functions.php";
include "$site_root/include/resource_functions.php";
include "$site_root/include/authenticate.php";

// required: check that this plugin is available to the user
if (!in_array("api_markasused",$plugins)){die("no access");}

$resource=getval("resource","");

if ($api_markasused['signed']){

  // test signature? get query string minus leading ? and skey parameter
  $test_query="";
  parse_str($_SERVER["QUERY_STRING"],$parsed);
  foreach ($parsed as $parsed_parameter=>$value){
    if ($parsed_parameter!="skey"){
      $test_query.=$parsed_parameter.'='.$value."&";
    }
  }
  $test_query=rtrim($test_query,"&");

  // get hashkey that should have been used to create a signature.
  $hashkey=md5($api_scramble_key.getval("key",""));

  // generate the signature required to match against given skey to continue
  $keytotest = md5($hashkey.$test_query);

  if ($keytotest <> getval('skey','')){
    header("HTTP/1.0 403 Forbidden.");
    echo "HTTP/1.0 403 Forbidden. Invalid Signature";
    exit;
  }
}

// theres no nice api we can use to save so i stole the fundementals from save_resource_data();
sql_query("DELETE FROM resource_data WHERE resource = $resource AND resource_type_field = 128");

sql_query("insert into resource_data(resource,resource_type_field,value) values($resource, 128 ,'" . escape_check(getval("url", "")) ."')");

update_xml_metadump($resource);		
