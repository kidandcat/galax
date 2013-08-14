//	Vamos a presuponer que el usuario es una persona inteligente...
var isIE = false;

//	Creamos una variable para el objeto XMLHttpRequest
var req,req2,req3,req4,req5,req6,req7;
var user;
var l_icon = '';

function checkSubmit(e)
{
   if(e && e.keyCode == 13)
   {
      cargaXML('action.php',false);
   }
}

//	Creamos una funcion para cargar los datos en nuestro objeto.
//	Logicamente, antes tenemos que crear el objeto.
//	Vease que la sintaxis varia dependiendo de si usamos un navegador decente
//	o Internet Explorer
function cargaXML(url,register) {
    if(!register){
	//	Primero vamos a ver si la URL es una URL :)
	if(url===''){
		return;
	}
        user = $('#user').val();
        var password = $('#pass').val();
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", url+"?user="+user+"&password="+password, true);
		req.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", url+"?user="+user+"&password="+password, true);
                        req.send();
		}
	}
    }else{
        //	Primero vamos a ver si la URL es una URL :)
	if(url===''){
		return;
	}
        user = $('#user').val();
        var password = $('#pass').val();
        var icon = $('#pass2').val();
        if(icon === ''){
            icon = 'images/icon.png';
        }else{
            l_icon = icon;
        }
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", url+"?user="+user+"&password="+password+"&icon="+icon, true);
		req.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", url+"?user="+user+"&password="+password+"&icon="+icon, true);
                        req.send();
		}
	}
    }
}

//	Funcion que se llama cada vez que se dispara el evento onreadystatechange
//	del objeto XMLHttpRequest
function processReqChange(){
	if(req.readyState === 4){
                procesaRespuesta(req.responseText);
	} else {
		detalles.innerHTML = 'Loading...';
	}
}

function procesaRespuesta(res){
    if(res === 'allow'){
        carga_icono('icon_load.php');
        carga_lista('list.php',user);
        setInterval(check(),"120000");
        initialize(user);
    }else if(res === 'notAllow'){
        detalles.innerHTML = 'Wrong user/password.';
    }else if(res === 'registered1'){
        alert('Registered succesfully');
        document.location.href = document.location.href;
    }else if(res === 'registered'){
        alert('Error: please, if the error persists contact the administrator.');
        document.location.href = document.location.href;
    }else{
    }
}


function register(){
    document.write("<?php session_start(); ?>");
    document.write("<link href='default.css' rel='stylesheet'>");
    document.write("<input name='user' class='input' id='user' type='text'>");
    document.write("<input name='pass' class='input2' id='pass' type='password'>");
    document.write("<div class='user'><b>Nickname:</b></div>");
    document.write("<div class='pass'><b>Password:</b></div>");
    document.write("<input name='passRepeat' class='input3' id='pass2' type='text'>");
    document.write("<div class='pass2'><b>Icon:</b></div>");
    document.write("<input type='submit' class='sub2' onclick='cargaXML(\"register.php\",true)'>");
    document.write("<div class='detalles2' id='detalles'></div>");
    document.getElementById('user').focus();
}


function carga_lista(url,user){
    if(url===''){
		return;
	}
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req2 = new XMLHttpRequest();
		req2.onreadystatechange = processList;
		req2.open("GET", url+"?user="+user, true);
		req2.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req2 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req2) {
			req2.onreadystatechange = processList;
			req2.open("GET", url+"?user="+user, true);
                        req2.send();
		}
	}
}

function processList(){
	if(req2.readyState === 4){
                processList2(req2.responseText);
	} else {
	}
}

function processList2(res){
    l_list = res;
}


function carga_lista_usuarios(url){
    if(url===''){
		return;
	}
        
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req3 = new XMLHttpRequest();
		req3.onreadystatechange = processUsers;
		req3.open("GET", url, true);
		req3.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req3 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req3) {
			req3.onreadystatechange = processUsers;
			req3.open("GET", url, true);
                        req3.send();
		}
	}
        
        function processUsers(){
	if(req3.readyState === 4){
               users_aux = req3.responseText;
               ready = true;
	} else {
	}
}
}



function pos_update(url,user,posX,posY){
    if(url===''){
		return;
	}
        
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req4 = new XMLHttpRequest();
		req4.onreadystatechange = processPos;
		req4.open("GET", url+"?user="+user+"&posX="+posX+"&posY="+posY, true);
		req4.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req4 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req4) {
			req4.onreadystatechange = processPos;
			req4.open("GET", url+"?user="+user+"&posX="+posX+"&posY="+posY, true);
                        req4.send();
		}
	}
}


function processPos(){
	if(req4.readyState === 4){
	} else {
	}
}



function check(){
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req7 = new XMLHttpRequest();
		req7.onreadystatechange = checkRes;
		req7.open("GET", 'checksession.php', true);
		req7.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req7 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req7) {
			req7.onreadystatechange = checkRes;
			req7.open("GET", 'checksession.php', true);
                        req7.send();
		}
	}
}


function checkRes(){
	if(req7.readyState === 4){  //must do all same methods alert about the correct or incorrect done of the action-------------------------------------------
            alert(req7.responseText);
    } else {
	}
}



function list_update(url,data){
    if(url===''){
		return;
	}
        
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req5 = new XMLHttpRequest();
		req5.onreadystatechange = processListUpdate;
		req5.open("GET", url+"?user="+user+"&data="+data, true);
		req5.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req5 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req5) {
			req5.onreadystatechange = processListUpdate;
			req5.open("GET", url+"?user="+user+"&data="+data, true);
                        req5.send();
		}
	}
}


function processListUpdate(){
	if(req5.readyState === 4){  //must do all same methods alert about the correct or incorrect done of the action-------------------------------------------
    } else {
	}
}



function carga_icono(url){

    if(url===''){
		return;
	}
	//	Usuario inteligente...
	if (window.XMLHttpRequest) {
		req6 = new XMLHttpRequest();
		req6.onreadystatechange = processIcon;
		req6.open("GET", url, true);
		req6.send();
	//	...y usuario de Internet Explorer Windows
	} else if (window.ActiveXObject) {
		isIE = true;
		req6 = new ActiveXObject("Microsoft.XMLHTTP");
		if (req6) {
			req6.onreadystatechange = processIcon;
			req6.open("GET", url, true);
                        req6.send();
		}
	}
}

function processIcon(){
	if(req6.readyState === 4){
            icons = req6.responseText.split(";");
	} else {
	}
}


