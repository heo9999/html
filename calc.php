<?php
	//검색기간
	$term = date("Ym");
	$memId = 'aaaaa';

	$sql = "select distinct date_format(sendDate, '%Y%m') term, date_format(sendDate, '%Y년 %c월') dt from health_test_tb ";
	$sql.= "where jobStatus = '6' and isDel = 'N' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	if(!empty($user['apiKey'])) $sql.= " and apikey = '{$user['apiKey']}' ";
	$sql.= "order by term desc ";
	print($sql);

	$sql = "select (select sn from hospital_tb where hospitalNo = list.hospitalNo) sn, hospitalNo, hospitalName, sum(cnt1) cnt1, sum(price1) price1, sum(cnt2) cnt2, sum(price2) price2, sum(cnt3) cnt3, sum(price3) price3, sum(cnt4) cnt4, sum(price4) price4, sum(cnt5) cnt5, sum(price5) price5 from (";
	$sql.= "	select hospitalNo, hospitalName, count(*) cnt1, sum(costPrice+deliPrice) price1, 0 cnt2, 0 price2, 0 cnt3, 0 price3, 0 cnt4, 0 price4, 0 cnt5, 0 price5 from calc_price_tb ";
	$sql.= "	where jobStatus = 'Y' and sendType <> 'T' and gubun in ('1','3') and price > 0 and date_format(registDate, '%Y%m') = '{$term}' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	if(!empty($user['apiKey'])) $sql.= " and hospitalNo in (select hospitalNo from hospital_tb where apikey = '{$user['apiKey']}') ";
	$sql.= "	group by hospitalNo, hospitalName ";
	$sql.= "	union all ";
	$sql.= "	select hospitalNo, hospitalName, 0 cnt1, 0 price1, count(*) cnt2, sum(costPrice+deliPrice) price2, 0 cnt3, 0 price3, 0 cnt4, 0 price4, 0 cnt5, 0 price5 from calc_price_tb ";
	$sql.= "	where jobStatus = 'Y' and sendType <> 'T' and gubun in ('2','4','7','8','A','B') and price > 0 and date_format(registDate, '%Y%m') = '{$term}' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	if(!empty($user['apiKey'])) $sql.= " and hospitalNo in (select hospitalNo from hospital_tb where apikey = '{$user['apiKey']}') ";
	$sql.= "	group by hospitalNo, hospitalName ";
	$sql.= "	union all ";
	$sql.= "	select hospitalNo, hospitalName, 0 cnt1, 0 price1, 0 cnt2, 0 price2, count(*) cnt3, sum(costPrice+deliPrice) price3, 0 cnt4, 0 price4, 0 cnt5, 0 price5 from calc_price_tb ";
	$sql.= "	where jobStatus = 'Y' and sendType <> 'T' and gubun in ('5','6','9') and price > 0 and date_format(registDate, '%Y%m') = '{$term}' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	if(!empty($user['apiKey'])) $sql.= " and hospitalNo in (select hospitalNo from hospital_tb where apikey = '{$user['apiKey']}') ";
	$sql.= "	group by hospitalNo, hospitalName ";
	$sql.= "	union all ";
	$sql.= "	select hospitalNo, hospitalName, 0 cnt1, 0 price1, 0 cnt2, 0 price2, 0 cnt3, 0 price3, count(*) cnt4, sum(talkPrice) price4, 0 cnt5, 0 price5 from calc_price_tb ";
	$sql.= "	where jobStatus = 'Y' and sendType = 'T' and date_format(registDate, '%Y%m') = '{$term}' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	$sql.= "	group by hospitalNo, hospitalName ";
	$sql.= "	union all ";
	$sql.= "	select hospitalNo, hospitalName, 0 cnt1, 0 price1, 0 cnt2, 0 price2, 0 cnt3, 0 price3, 0 cnt4, 0 price4, count(*) cnt5, sum(filePrice2) price5 from calc_price_tb ";
	$sql.= "	where jobStatus = 'Y' and sendType = 'P' and date_format(registDate, '%Y%m') = '{$term}' ";
	//이투웹 관리자가 아닌 경우 메디인병원을 정산내역에서 제외
	if(!in_array($memId, array('bonjin','e2web'))){
		$sql.= " and hospitalNo not in ('31203914','31101453') ";
	}
	$sql.= "	group by hospitalNo, hospitalName ";
	$sql.= ") as list ";
	$sql.= "group by hospitalNo, hospitalName ";
	$sql.= "order by hospitalName, hospitalNo, sn ";
	print($sql);

?>
