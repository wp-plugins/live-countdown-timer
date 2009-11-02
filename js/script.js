function xGenerateDHMS(xNrOfDHMS){
    var xDateArr = xNrOfDHMS.split(":");
    var xDays = xDateArr[0];
    var xHours = xDateArr[1];
    var xMinutes = xDateArr[2];
    var xSeconds = xDateArr[3];

    if(xSeconds=="0"){
        if(xMinutes=="0"){
            if(xHours=="0"){
                if(xDays=="0"){
                    return "000:00:00:00";
                }else{
                    xDays = String(parseInt(xDays) - 1);
                    xHours="23";
                    xMinutes="59";
                    xSeconds="59";
                }
            }else{
                xHours = String(parseInt(xHours) - 1);
                xMinutes="59";
                xSeconds="59";
            }
        }else{
            xMinutes = String(parseInt(xMinutes) - 1);
            xSeconds="59";
        }
    }else{
        xSeconds = String(parseInt(xSeconds) - 1);
    }
    return xDays+":"+xHours+":"+xMinutes+":"+xSeconds;
}
function LCTimer_Count_Timer(xElement,xTextColor,xBackgroundColor,postFont,xType,xSize,xDD,xHH,xMM,xSS,xNrOfDHMS,xIsTransparent){
    
    var xFinal = '';
    var xDateArr = xNrOfDHMS.split(":");
    var xDays = xDateArr[0];
    var xHours = xDateArr[1];
    var xMinutes = xDateArr[2];
    var xSeconds = xDateArr[3];
    var xFontSize="";
    var xWrapSize="";
    //size interpretation
    switch(xSize){
        case "1":
            xFontSize="10";
            xWrapSize = "A";
            break;
        case "2":
            xFontSize="14";
            xWrapSize = "B";
            break;
        case "3":
            xFontSize="21";
            xWrapSize = "C";
            break;

    }
    //days,hours,minutes,seconds defaults
    if(xDD==""){
        xDD="Days";
    }
    if(xHH==""){
        xHH="Hours";
    }
    if(xMM==""){
        xMM="Minutes";
    }
    if(xSS==""){
        xSS="Seconds";
    }

    //background color interpretation:
    xBackgroundColorB = "#"+xBackgroundColor;
    if(xIsTransparent=="on"){
        xBackgroundColorB="none";
    }

    switch(xType){
        case "1":
            xFinal = '<div style="color:#'+xTextColor+';background:#'+xBackgroundColorB+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopBottom">'+xDD+'</div>'+
            '<div class="xLCTTTTopTime">'+xDays+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopBottom">'+xHH+'</div>'+
            '<div class="xLCTTTTopTime">'+xHours+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopBottom">'+xMM+'</div>'+
            '<div class="xLCTTTTopTime">'+xMinutes+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopBottom">'+xSS+'</div>'+
            '<div class="xLCTTTTopTime">'+xSeconds+'</div>'+
            '</div>'+
            '</div>';
            break;
        case "2":
            xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColorB+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopTime">'+xDays+'</div>'+
            '<div class="xLCTTTTopBottom">'+xDD+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopTime">'+xHours+'</div>'+
            '<div class="xLCTTTTopBottom">'+xHH+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopTime">'+xMinutes+'</div>'+
            '<div class="xLCTTTTopBottom">'+xMM+'</div>'+
            '</div>'+
            '<div class="xLCTTWrap'+xWrapSize+'">'+
            '<div class="xLCTTTTopTime">'+xSeconds+'</div>'+
            '<div class="xLCTTTTopBottom">'+xSS+'</div>'+
            '</div>'+
            '</div>';
            break;
        case "3":
            xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColorB+';padding:5px;font-size:'+xFontSize+'px;">'+xDD+':<b>'+xDays+'</b> '+xHH+':<b>'+xHours+'</b> '+xMM+':<b>'+xMinutes+'</b> '+xSS+':<b>'+xSeconds+'</b></div>';
            break;
        case "4": case "5": case "6": case "7": case "8": case "9":
            if(xType=="4"){
                xBubbleColor = "Red";
            }
            if(xType=="5"){
                xBubbleColor = "Black";
            }
            if(xType=="6"){
                xBubbleColor = "White";
            }
            if(xType=="7"){
                xBubbleColor = "Green";
            }
            if(xType=="8"){
                xBubbleColor = "DarkGreen";
            }
            if(xType=="9"){
                xBubbleColor = "Yellow";
            }
            if(xDays=="0"){
                if(xHours=="0"){
                    if(xMinutes=="0"){
                        xLCTBubbleTopTime = xSeconds;
                        xLCTBubbleTopBottom = xSS;
                    }else{
                        xLCTBubbleTopTime = xMinutes;
                        xLCTBubbleTopBottom = xMM;
                    }
                }else{
                    xLCTBubbleTopTime = xHours;
                    xLCTBubbleTopBottom = xHH;
                }
            }else{
                xLCTBubbleTopTime = xDays;
                xLCTBubbleTopBottom = xDD;
            }
            xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColorB+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
            '<div class="xLCTBubble'+xBubbleColor+'Wrap'+xWrapSize+'">'+
            '<div class="xLCTBubbleTopTime">'+xLCTBubbleTopTime+'</div>'+
            '<div class="xLCTBubbleTopBottom">'+xLCTBubbleTopBottom+'</div>'+
            '</div>'+
            '</div>';
            break;

    }
    jQuery(xElement).css('background',xBackgroundColorB);
    jQuery(xElement).html(xFinal);
    xNrOfDHMS = xGenerateDHMS(xNrOfDHMS);
    if(xNrOfDHMS!="000:00:00:00"){
        setTimeout('LCTimer_Count_Timer(\''+xElement+'\',\''+xTextColor+'\',\''+xBackgroundColor+'\',\''+postFont+'\',\''+xType+'\',\''+xSize+'\',\''+xDD+'\',\''+xHH+'\',\''+xMM+'\',\''+xSS+'\',\''+xNrOfDHMS+'\',\''+xIsTransparent+'\');',1000);
    }
}