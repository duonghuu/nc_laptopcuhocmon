<?php
//$config['arrayDomainSSL']=array("yourdomainssl.com.vn"); // copy dong nay vao file config.php và cấu hình cho những domain cài ssl
$Protocol=getProtocol();///  biến nhận về giao thức truy cập để cấu hình các đường dẩn base url ,css,js...

function redirectphp($url){
		$url=str_replace('https//','',$url);
		$arrayurl=explode('://',$url);
		if(count($arrayurl)==3){
			$url=$arrayurl[0].'://'.$arrayurl[2];
		} 
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $url");
}
function getCurrentPageURLSSL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    return $pageURL;
}

function getProtocol() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    return $pageURL;
}
function checkTimeSSL($domainName){
	$url = $domainName;
	$orignal_parse = parse_url($url, PHP_URL_HOST);
	$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	$cert = stream_context_get_params($read);
	$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
	 
	$arrayInfossl=array('songay'=>$certinfo['validTo_time_t'],'version'=>$certinfo['version']);
 
	return $arrayInfossl;
}
function changeDomainssl($domainName){
  	$arrayDomain=explode("://",$domainName);	
		if($arrayDomain[0]=='http') {
				$stringDomainName=str_replace('http:','https:',$domainName);
				redirectphp($stringDomainName);
		}
}
function CheckChangSLL($runDomainName,$arrayConfig){
	$flagdomain=1;
	$DomainRun=$_SERVER["SERVER_NAME"];
	if(in_array($DomainRun,$arrayConfig)){	  
	  	$flagdomain=1;
	}else{
	    $flagdomain=0;
	  	$runDomainName='http://'.$arrayConfig['0'].$_SERVER["REQUEST_URI"];
	}
	$arrayinfossl=checkTimeSSL($runDomainName);
	$timeSLL=$arrayinfossl['songay'];
	$version=$arrayinfossl['version'];
 	$NgayHienTai=date('d-m-Y',time());
	$soNgayConLaitInt=$timeSLL- strtotime($NgayHienTai);
	$soNgayConLai=(int)($soNgayConLaitInt/24/60/60);
	$arrayDomain=explode("://",$runDomainName);
	if($soNgayConLai >=1 && $version>0){
		changeDomainssl($runDomainName);
	}else{
		if($flagdomain==0){
				$geturl=getCurrentPageURLSSL();
				$DomainRuning=$_SERVER["SERVER_NAME"];
				$urlRun=str_replace($DomainRuning,$runDomainName,$geturl);					
				$urlRun=str_replace('http://','',$urlRun);
				$arrayinfossl=checkTimeSSL($runDomainName);
				$timeSLL=$arrayinfossl['songay'];
				$version=$arrayinfossl['version'];
			 	$NgayHienTai=date('d-m-Y',time());
				$soNgayConLaitInt=$timeSLL- strtotime($NgayHienTai);
				$soNgayConLai=(int)($soNgayConLaitInt/24/60/60);
				if($soNgayConLai >=1 && $version>0){
				 	$urlRun="https://".$urlRun;
				}else{
					$urlRun="http://".$urlRun;
				}
				redirectphp($urlRun);
			}else{					
				if($arrayDomain[0]=='https') {
					$stringDomainName=str_replace('https:','http:',$runDomainName);				
				    redirectphp($stringDomainName);
				} 

			}
	}
}
$runDomainName=getCurrentPageURLSSL();  
CheckChangSLL($runDomainName,$config['arrayDomainSSL']);
?>