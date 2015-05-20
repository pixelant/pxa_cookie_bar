function create(htmlStr) {
    var frag = document.createDocumentFragment(),
        temp = document.createElement('div');
    temp.innerHTML = htmlStr;
    while (temp.firstChild) {
        frag.appendChild(temp.firstChild);
    }
    return frag;
}

function hide_cookie_warning(accept){
  if(accept == 'accept') {
    xmlhttp_fwb.open("GET",close_cookie_url,true);
    xmlhttp_fwb.send();
  }
  var e = document.getElementById("pxa-cookie-mess");
  e.style.cssText = "display:none";
}

function sendReq(){
  var xmlhttp;
  if (window.XMLHttpRequest) {
     xmlhttp=new XMLHttpRequest();
     xmlhttp_fwb= new XMLHttpRequest();
  }
  else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_fwb= new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        response = create(xmlhttp.responseText);
        document.body.insertBefore(response, document.body.childNodes[0]);
  	}
  }
  var timestamp = new Date().getTime();
  xmlhttp.open("GET",cookie_bar_url+'&ts='+timestamp,true);
  xmlhttp.send();

}


document.addEventListener('DOMContentLoaded',sendReq,false);
