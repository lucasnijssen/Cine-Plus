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
      openModal(obj.title, obj.image, obj.desc);
      console.log(obj);
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

  ws.onclose = () => console.log("[WSS] Disconnected");

  function WebSocketTest() {
    ws.send(JSON.stringify({
         id: "Test",
         msg: "I want to test the connection!"
       }));
  }