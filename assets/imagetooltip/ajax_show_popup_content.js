function ajax_showContent(a,b,c){document.getElementById(a).innerHTML=dynamicContent_ajaxObjects[b].response,enableCache&&(jsCache[c]=dynamicContent_ajaxObjects[b].response),dynamicContent_ajaxObjects[b]=!1}function ajax_loadContent(a,b){if(document.getElementById(a)){if(enableCache&&jsCache[b])return void(document.getElementById(a).innerHTML=jsCache[b]);document.getElementById(a).innerHTML="<table><tr><td><img src='assets/imagetooltip/wait.gif' /></td><td>Đang tải...</td></tr></table>";var c=dynamicContent_ajaxObjects.length;if(dynamicContent_ajaxObjects[c]=new sack,b.indexOf("?")>=0){dynamicContent_ajaxObjects[c].method="GET";var d=b.substring(b.indexOf("?"));b=b.replace(d,""),d=d.replace("?","");for(var e=d.split(/&/g),f=0;f<e.length;f++){var g=e[f].split("=");2==g.length&&dynamicContent_ajaxObjects[c].setVar(g[0],g[1])}b=b.replace(d,"")}dynamicContent_ajaxObjects[c].requestFile=b,dynamicContent_ajaxObjects[c].onCompletion=function(){ajax_showContent(a,c,b)},dynamicContent_ajaxObjects[c].runAJAX()}}var enableCache=!0,jsCache=new Array,dynamicContent_ajaxObjects=new Array;