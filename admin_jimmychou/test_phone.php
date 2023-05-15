<?php 
		//Visist http://http://esms.vn/SMSApi/ApiSendSMSNormal for more information about API
		//� 2013 esms.vn
		//Website: http://esms.vn/
		//Hotline: 0902.435.340   
		//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
		//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API 
		
		$APIKey="ACE5AF01D6030F60F9C4738D358D02";
		$SecretKey="0B16DC42085790FBDCB2797C2B0DB3";
		$YourPhone="0359893447";
        $Content="Welcome to esms.vn";

        $SendContent=urlencode($Content);
        $data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=8";
        //De dang ky brandname rieng vui long lien he hotline 0901.888.484 hoac nhan vien kinh Doanh cua ban
        $curl = curl_init($data); 
        curl_setopt($curl, CURLOPT_FAILONERROR, true); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($curl); 
            
        $obj = json_decode($result,true);
        if($obj['CodeResult']==100)
        {
            print "<br>";
            print "CodeResult:".$obj['CodeResult'];
            print "<br>";
            print "CountRegenerate:".$obj['CountRegenerate'];
            print "<br>";     
            print "SMSID:".$obj['SMSID'];
            print "<br>";
        }
        else
        {
            print "ErrorMessage:".$obj['ErrorMessage'];
        }
		
?>