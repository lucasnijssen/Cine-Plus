const ws = new WebSocket("wss://ws.dixiehosting.nl");


function getUrlVars2() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

ws.onopen = () => {
    console.log("WebSocket ready!");
    ws.send(JSON.stringify({
          id: "hello",
          msg: "Hi, im the new client"
        }));
        console.log("[WSS] Connected");
  };
  ws.onmessage = (message) => {
    var obj = JSON.parse(message.data);
    if(getUrlVars2()["debug"] == "true"){
      console.log(obj.msg);
    }

    if(obj.info == "movie-carddata"){
      openModal(obj.title, obj.image, obj.desc, obj.id);
    }
    if(obj.info == "admin-alert"){
      Swal.fire({
        icon: 'info',
        title: obj.title,
        text: obj.text,
        showConfirmButton: true,
        allowOutsideClick: false,
        timer: 5000
      })
    }
    
    if(obj.info == "recieved_test"){
      console.log("Test command was ran!")
      alert("Connection test successvol!");
    }
  };

  const heartbeat = setInterval(function(){
    ws.send(JSON.stringify({
      id: "hearbeat",
      msg: "Im still alive!"
    }));
  },5000);

  ws.onclose = () => {
    console.log("[WSS] Disconnected");
    location.href = "/disconnected.html";
  }

  function WebSocketTest() {
    ws.send(JSON.stringify({
         id: "Test",
         msg: "I want to test the connection!"
       }));
  }

  function getCookie(name) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [k,v] = el.split('=');
      cookie[k.trim()] = v;
    })
    return cookie[name];
  }

  function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

  document.addEventListener('keypress', logKey);
  
  function logKey(e) {
    if(e.which==123){
        console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
        console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
    }
    if(e.ctrlKey && e.shiftKey && e.which == 73){
        console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
        console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
    }
    if(e.ctrlKey && e.shiftKey && e.which == 75){
        console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
        console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
    }
    if(e.ctrlKey && e.shiftKey && e.which == 67){
        console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
        console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
    }
    if(e.ctrlKey && e.shiftKey && e.which == 74){
        console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
        console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
        console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
    }
};

console.log('%c' + 'Hey daar!', 'font-family:Comic Sans MS; font-size:50px; font-weight:bold; color: red; -webkit-text-stroke: 2px;-webkit-text-stroke-color: black; padding: 15px')
console.log('%c' + 'Als iemand je heeft gezegd om hier iets te copy/paste is er een 11/10 kans dat je wordt gescammed', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
console.log('%c' + 'Hier iets plakken kan hackers toegang geven tot je account, of een account blokkering veroorzaken', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: red;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')
console.log('%c' + 'Als je weet wat je hier doet, solliciteer dan voor ons development team!', 'font-family:Comic Sans MS; font-size:20px; font-weight:bold; color: white;-webkit-text-stroke: 1px;-webkit-text-stroke-color: black;')