var map;
var l_user;
var l_list;
var markers;
var users;
var users2;
var users_aux = '';
var ready;
var infowindows;




function initialize(user) {
    
    document.onkeypress=function(){
        users.forEach(function(ev){alert(ev);})
    };
    users_aux = '';
    markers = new Array();
    users = new Array();
    users2 = new Array();
    infowindows = new Array();
  l_user = user;
  var mapOptions = {
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
      
      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
  set_users();
  update_pos();
  var intevalo = setInterval('update_pos()',30000); //5 min = 300000
  //clearInterval(intervalo);
}

function update_pos(){
var pos;
if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
  
      pos_update('pos_update.php',user,pos.lat(),pos.lng());
      set_users();
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}


function user_mark(nick,pos){
    var isCreated = false;
    var markk;
    users2.forEach(function(mark){
        if(mark === nick){
            isCreated = true;
            markers.forEach(function(e){
                if(e.getTitle() === nick)
                    markk = e;
            });
        }
    });
    if(!isCreated){
        marker = new google.maps.Marker({
        map:map,
        title:nick,
        draggable:false,
        clickable:true,
        animation: google.maps.Animation.DROP,
        position: pos,
        icon: 'images/icon.png'
      });
      marker.addListener("click",function(){user_list(nick,pos);});
      markers.push(marker);
      users2.push(nick);
    }else if(isCreated){
        markk.setPosition(pos);
    }
}

function user_list(user,pos){
  var isLocalUser = false;
  if(user === l_user)
      isLocalUser = true;
    var title_before = "<div align='center'><b>";
    var title_after = "</b></div><br>";
    get_user_list(user);
    var interval2 = setTimeout(goo,1000);
    function goo(){
        if(isLocalUser){
            user_list_fromDB();
        }
        var inf = new google.maps.InfoWindow({
            map: map,
            position: pos,
            content: title_before + user + title_after + l_list
        });
        infowindows.push(inf);
        clearTimeout(interval2);
    }
}



function change_user_list(){
    
    var posicion = document.getElementById('select').options.selectedIndex; //posicion
    var sel = document.getElementById('select').options[posicion].text; //valor
    if(sel !== null){
        list_update('set_list.php',l_user,sel);
        infowindows.forEach(function(e){e.close();});
    }
}



function get_user_list(user){
    return carga_lista('list.php',user);   
}

function set_users(){       //must be recoded for ask only about the near users of the local user
    //php server request of users list using AJAX
    ready = false;
    carga_lista_usuarios('users.php');
    var interval = setTimeout(go,1000);
    function go(){
        if(ready){
            users = users_aux.split('%');
            for(var i=0;i<users.length;i+=3){
                var pos = new google.maps.LatLng(users[i+1],users[i+2]);
                new user_mark(users[i],pos);
            }
            clearTimeout(interval);
        }
    }
}





function user_list_fromDB(){        //guitarra: medio; especialidad: blablabla; 
    var list = l_list.split(" ");
    list2 = list.unique();
    var before_list = "<select id='select' name='list'>";
    var options = '';
    for(var i=0;i<list2.length;i++){
        options = options + ("<option value='"+i+"' SELECTED>"+list2[i]+"</option>");
    }
    l_list = before_list+options+ "</select><br><button onclick='change_user_list()'><b>Change<b></button><button onclick='add_new_option()'><b>Add<b></button>Only Admins can add new options.";
    return 0;
}



function add_new_option(){
    var input = prompt('Enter new option', '');
    list_update('new_option.php',l_user,input);
    infowindows.forEach(function(e){e.close();});
}




Array.prototype.unique=function(a){
  return function(){return this.filter(a);};}(function(a,b,c){return c.indexOf(a,b+1)<0;
});







