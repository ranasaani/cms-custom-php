function getElements(j,c,f,h){var d=null;var e=null;var k=new Array();var a=j.getElementsByTagName(c);var b=a.length;for(var g=0;g<b;g++){d=a.item(g);if(undefined!=f){e=d.getAttribute("class");if(null!=e&&e.indexOf(f)>-1){if(undefined!=h&&h===true){return d}k.push(d)}}else{if(undefined!=h&&h===true){return d}k.push(d)}}return(undefined!=h&&h===true)?false:(k.length>0?k:false)}function setDisplay(a,b){for(index in a){a[index].style.display=b}}function close_all(c){if(!(c.indexOf("zdc-records")>-1||c.indexOf("zdc-explain")>-1||c.indexOf("zdc-backtrace")>-1)){var b=null;var a=new Array();a=["zdc-errors","zdc-successful-queries","zdc-unsuccessful-queries"];for(index in a){b=a[index];if(b!=c){el=document.getElementById(b);if(null!=el){children=getElements(el,"table","zdc-entry");setDisplay(children,"none");el.style.display="none"}}}if(null==c.match(/^zdc\-globals/)){document.getElementById("zdc-globals-submenu").style.display="none";parent_element=document.getElementById("zdc-globals");parent_element.style.display="none";a=["post","get","cookie","files","server"];for(index in a){el="zdc-globals-"+a[index];document.getElementById(el).style.display="none"}}else{a=["post","get","cookie","files","server"];for(index in a){el="zdc-globals-"+a[index];if(el!=c){document.getElementById(el).style.display="none"}}}}}function zdc_toggle(f){close_all(f);var g=null;if(f=="console"){g=document.getElementById("zdc");g.style.display=(g.style.display!="block"?"block":"none")}else{var e=null;var c=null;switch(f){case"zdc-errors":case"zdc-successful-queries":case"zdc-unsuccessful-queries":g=document.getElementById(f);if(null!=g){e=getElements(g,"table","zdc-entry");c=(g.style.display!="block"?"block":"none");setDisplay(e,c);g.style.display=c}break;case"zdc-globals-submenu":g=document.getElementById(f);g.style.display=(g.style.display!="block"?"block":"none");parent_element=document.getElementById("zdc-globals");parent_element.style.display=(parent_element.style.display!="block"?"block":"none");break;case"zdc-globals-post":case"zdc-globals-get":case"zdc-globals-cookie":case"zdc-globals-files":case"zdc-globals-server":g=document.getElementById(f);g.style.display=(g.style.display!="block"?"block":"none");break;default:g=document.getElementById(f);var h=f.match(/\-([a-z]+)([0-9]+)$/);var d=null,b=null,a=null;if(null!=h){d=document.getElementById("zdc-records-"+h[1]+h[2]);b=document.getElementById("zdc-explain-"+h[1]+h[2]);a=document.getElementById("zdc-backtrace-"+h[1]+h[2]);if(null!=d&&d!=g){d.style.display="none"}if(null!=b&&b!=g){b.style.display="none"}if(null!=a&&a!=g){a.style.display="none"}}if(null!=g){g.style.display=(g.style.display!="block"?"block":"none")}}}}startStack=function(){};registerOnLoad=function(a){var b=startStack;startStack=function(){b();a();return}};var ranOnload=false;if(document.addEventListener){document.addEventListener("DOMContentLoaded",function(){if(!ranOnload){ranOnload=true;startStack()}},false)}else{if(document.all&&!window.opera){document.write("<script id='DOMReady' defer=true src=//:><\/script>");document.getElementById("DOMReady").onreadystatechange=function(){if(this.readyState=="complete"&&(!ranOnload)){ranOnload=true;startStack()}}}}var orgOnLoad=window.onload;window.onload=function(){if(typeof(orgOnLoad)=="function"){orgOnLoad()}if(!ranOnload){ranOnload=true;startStack()}};registerOnLoad(function(){var d=document.getElementById("zdc-errors");var a=document.getElementById("zdc-unsuccessful-queries");if(null!=d){children=getElements(d,"table","zdc-entry");setDisplay(children,"block");d.style.display="block"}else{if(null!=a){children=getElements(a,"table","zdc-entry");setDisplay(children,"block");a.style.display="block"}else{var c=document.getElementById("zdc-successful-queries");var b=getElements(c,"table","zdc-highlight");setDisplay(b,"block");c.style.display="block"}}});