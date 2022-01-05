var video = document.getElementById("myVideo");
var btn = document.getElementById("play");
// loadjson();
// async function loadjson(movie, cdn, title){
//     let object;
//     let httpRequest = new XMLHttpRequest(); // asynchronous request
//     httpRequest.open("GET", "movies.json", true);
//     httpRequest.send();
//     httpRequest.addEventListener("readystatechange", function() {
//         if (this.readyState === this.DONE) {
//             // when the request has completed
//             object = JSON.parse(this.response);
//             for(var i = 0; i < object.length; i++){
//                 if(object[i].name == getUrlVars()["iv"]){
//                     setInformation(object[i].title, object[i].cdn, object[i].name)
//                 }
//             }
//         }
//     });
// }
async function setInformation(title, cdn, movie){
    video.src = cdn; 
    document.getElementById("vidtitle").innerHTML = title;
    document.getElementById("vidtitle2").innerHTML = title;
    document.title = "CinePlus - " + title; 
    settime();
}

function play() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "pause";
  } else {
    video.pause();
    btn.innerHTML = "play_arrow";
  }
}
var ele_full = document.getElementById("full");
is_full = false;
function full(){
    if (is_full) {
        closeFullscreen();
        ele_full.innerHTML = "fullscreen";
        is_full = false;
      } else {
        openFullscreen();
       ele_full.innerHTML = "fullscreen_exit";
        is_full = true;
      }
    }   
    var time;
        function hover(){
            clearTimeout(time);
           
            document.getElementById("content").style.opacity = "1";
            document.body.style.cursor = "default";
            document.getElementById("overlay").style.display = "none";
           time = setTimeout(function(){
                                     document.getElementById("content").style.opacity = "0";
                                     document.body.style.cursor = "none";
                                    if (video.paused) document.getElementById("overlay").style.display = "block";
                             }, 5000);
            
        }

var elem = document.documentElement;
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

video.volume = 1;
function load_video(){
    if(video.src == window.location.href){
      setInformation("Er ging iets fout!", "https://cdn.gewoonboyke.nl/movies/error.mp4", "testing");
      video.loop = true;
    }
    
    if (getUrlVars()["v"] != undefined) video.src = getUrlVars()["v"]; video.play();
    if (getUrlVars()["muted"] != undefined) video.volume = 0;
      
}
function settime(){
    var video= document.getElementById("myVideo");
       
    setInterval(function(){
        countdown = video.duration - video.currentTime
      var date = new Date(0);
      var date2 = new Date(0);
      date.setSeconds(countdown);
      date2.setSeconds(video.currentTime);
      var timeString = date.toISOString().substr(11, 8);
      var timeString2 = date2.toISOString().substr(11, 8);
      document.getElementById("time").innerHTML= timeString + " / " + timeString2;
      },1000);
  }

function volume(){
    if (video.volume == 0) {
        video.volume = 1;
        document.getElementById("volume").innerHTML = "volume_up";
      } else {
        video.volume = 0;
        document.getElementById("volume").innerHTML = "volume_off";
      }  
}
function replay(n){
    video.currentTime -= n;
}
function forward(n){
    video.currentTime += n;
}
function key()
	{
		if (event.keyCode == '32')
		{
      play();
      hover();
		}
  }
  // .firefox
var isFF = true;
var addRule = (function (style) {
  var sheet = document.head.appendChild(style).sheet;
  return function (selector, css) {
    if ( isFF ) {
      if ( sheet.cssRules.length > 0 ) {
        sheet.deleteRule( 0 );
      }
    
      try {
        sheet.insertRule(selector + "{" + css + "}", 0);
      } catch ( ex ) {
        isFF = false;
      }
    }    
  };
})(document.createElement("style"));

var video_slider = document.getElementById("video_slider");
function video_time_update(){
  slider_css();
  video.currentTime = video_slider.value;
}

function slider_css() {
  
    x = (video_slider.value * 100) / video_slider.max;
    video_slider.style = 'background: linear-gradient(to right, red 0% ' + x + '%, #fff ' + x + '%, white 100%) '
  };


video.ontimeupdate = function(){
  video_slider.max = Math.round(video.duration);
  video_slider.value = Math.round(video.currentTime);
  slider_css(); 
}

video.addEventListener('ended', function () {
  if(video.src == "https://cdn.gewoonboyke.nl/movies/error.mp4"){
    const url = window.location.origin
    window.location.replace(url);
  }
}, false);