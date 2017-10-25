<?php
class site{
	public function getData(){
		$data = getdate();
		$day = date('d');
		$array_months = array(  1=>"January",2=>"Febraury",3=>"March",4=>"April",
								5=>"May",6=>"June",7=>"July",8=>"August",9=>"September",
								10=>"October",11=>"November",12=>"December");
		$getmonth = $data['mon'];
		$hour = date('H:i');
		$year = date ('Y');
		return $day.' of '.$array_months[$getmonth].' of '.$year.', '.$hour.'';
		// save the date
	}
}

?>