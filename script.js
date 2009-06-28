var xCurrentTime = new Array();

function live_countdown_timer_Start(xTime){
	document.getElementById('live_countdown_timer_dots').style.backgroundPosition = "12px";
	document.getElementById('live_countdown_timer_dotsB').style.backgroundPosition = "12px";
	document.getElementById('live_countdown_timer_dotsC').style.backgroundPosition = "12px";
	var xArr = new Array();
	xArr = xTime.split(":");
	var xDaysA = xArr[0].substring(0,1);
	var xDaysB = xArr[0].substring(1,2);
	var xDaysC = xArr[0].substring(2,3);
	
	var xHoursA = xArr[1].substring(0,1);
	var xHoursB = xArr[1].substring(1,2);
	
	var xMinutesA = xArr[2].substring(0,1);
	var xMinutesB = xArr[2].substring(1,2);

	var xSecondsA = xArr[3].substring(0,1);
	var xSecondsB = xArr[3].substring(1,2);
	
	xCurrentTime[0] = xDaysA;
	xCurrentTime[1] = xDaysB;
	xCurrentTime[2] = xDaysC;
	xCurrentTime[3] = xHoursA;
	xCurrentTime[4] = xHoursB;
	xCurrentTime[5] = xMinutesA;
	xCurrentTime[6] = xMinutesB;
	xCurrentTime[7] = xSecondsA;
	xCurrentTime[8] = xSecondsB;
	
	live_countdown_timer_SwitchLetter(xCurrentTime[0],'live_countdown_timer_dd');
	live_countdown_timer_SwitchLetter(xCurrentTime[1],'live_countdown_timer_ddB');
	live_countdown_timer_SwitchLetter(xCurrentTime[2],'live_countdown_timer_ddC');
	
	live_countdown_timer_SwitchLetter(xCurrentTime[3],'live_countdown_timer_hh');
	live_countdown_timer_SwitchLetter(xCurrentTime[4],'live_countdown_timer_hhB');
	
	live_countdown_timer_SwitchLetter(xCurrentTime[5],'live_countdown_timer_mm');
	live_countdown_timer_SwitchLetter(xCurrentTime[6],'live_countdown_timer_mmB');
	
	live_countdown_timer_SwitchLetter(xCurrentTime[7],'live_countdown_timer_ss');
	live_countdown_timer_SwitchLetter(xCurrentTime[8],'live_countdown_timer_ssB');
	setTimeout ( "xTimer_Tick()", 1000);
}
function xTimer_Tick(){
var xStop = false
	if(xCurrentTime[8]=="0"){
		if(xCurrentTime[7]=="0"){
			if(xCurrentTime[6]=="0"){
				if(xCurrentTime[5]=="0"){
					if(xCurrentTime[4]=="0"){
						if(xCurrentTime[3]=="0"){
							if(xCurrentTime[2]=="0"){
								if(xCurrentTime[1]=="0"){
									if(xCurrentTime[0]=="0"){
										xStop = true;
									}
									xCurrentTime[0] = String(parseInt(xCurrentTime[0]) - 1);
									xCurrentTime[1] = "10";
								}
								xCurrentTime[1] = String(parseInt(xCurrentTime[1]) - 1);
								xCurrentTime[2] = "10";
							}
							xCurrentTime[2] = String(parseInt(xCurrentTime[2]) - 1);
							xCurrentTime[3] = "3";
							xCurrentTime[4] = "4";
						}
						xCurrentTime[3] = String(parseInt(xCurrentTime[3]) - 1);
						if(xCurrentTime[4]!="4"){xCurrentTime[4] = "10";}
					}
					xCurrentTime[4] = String(parseInt(xCurrentTime[4]) - 1);
					xCurrentTime[5] = "6";
				}
				xCurrentTime[5] = String(parseInt(xCurrentTime[5]) - 1);
				xCurrentTime[6] = "10";
			}
			xCurrentTime[6] = String(parseInt(xCurrentTime[6]) - 1);
			xCurrentTime[7] = "6";
		}
			xCurrentTime[7] = String(parseInt(xCurrentTime[7]) - 1);
			xCurrentTime[8] = "10";
	}
	if(xStop==false){
		xCurrentTime[8] = String(parseInt(xCurrentTime[8]) - 1);
		live_countdown_timer_SwitchLetter(xCurrentTime[0],'live_countdown_timer_dd');
		live_countdown_timer_SwitchLetter(xCurrentTime[1],'live_countdown_timer_ddB');
		live_countdown_timer_SwitchLetter(xCurrentTime[2],'live_countdown_timer_ddC');
		
		live_countdown_timer_SwitchLetter(xCurrentTime[3],'live_countdown_timer_hh');
		live_countdown_timer_SwitchLetter(xCurrentTime[4],'live_countdown_timer_hhB');
		
		live_countdown_timer_SwitchLetter(xCurrentTime[5],'live_countdown_timer_mm');
		live_countdown_timer_SwitchLetter(xCurrentTime[6],'live_countdown_timer_mmB');
		
		live_countdown_timer_SwitchLetter(xCurrentTime[7],'live_countdown_timer_ss');
		live_countdown_timer_SwitchLetter(xCurrentTime[8],'live_countdown_timer_ssB');
		
		setTimeout ("xTimer_Tick()", 1000);
	}
}
function live_countdown_timer_SwitchLetter(xVal,xID){
	switch(xVal){
		case "0":
		document.getElementById(xID).style.backgroundPosition = "24px";
		break;
		case "9":
		document.getElementById(xID).style.backgroundPosition = "36px";
		break;
		case "8":
		document.getElementById(xID).style.backgroundPosition = "48px";
		break;
		case "7":
		document.getElementById(xID).style.backgroundPosition = "60px";
		break;
		case "6":
		document.getElementById(xID).style.backgroundPosition = "72px";
		break;
		case "5":
		document.getElementById(xID).style.backgroundPosition = "84px";
		break;
		case "4":
		document.getElementById(xID).style.backgroundPosition = "96px";
		break;
		case "3":
		document.getElementById(xID).style.backgroundPosition = "108px";
		break;
		case "2":
		document.getElementById(xID).style.backgroundPosition = "120px";
		break;
		case "1":
		document.getElementById(xID).style.backgroundPosition = "132px";
		break;
		
	}
}
