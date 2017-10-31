<?php
     /**
         * Purpose: generates a unique id for each user in terms of microseconds 
         * @param void
         * @return integer
     */
	function generateUID(){
	    $my_time=gettimeofday();
		$micro = $my_time['usec'];
		while(strlen($micro) < 6){	
			$micro = '0'.$micro;
		}
	    //OK	$micro=substr($micro,0,5);
		$micro = $micro.rand(10,99);
		$timeInMicroSecs = $my_time['sec'].$micro;
        return $timeInMicroSecs;
	}
	//echo generateUID();
?>