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

        ws.send(JSON.stringify({
            id: "movie-info",
            msg: "Please give me the movie info",
            movie: getUrlVars2()["iv"]
          }));
        console.log("requestion movie info");
  };
  ws.onmessage = (message) => {
    var obj = JSON.parse(message.data);
    if(getUrlVars2()["debug"] == true){
      console.log(obj.msg);
    }
    
    if(obj.info == "recieved_test"){
      console.log("Test command was ran!")
      alert("Connection test successvol!");
    }
    if(obj.info == "movie-data"){
        setInformation(obj.title, obj.cdn, "testing");
      }
  };

  const heartbeat = setInterval(function(){
    ws.send(JSON.stringify({
      id: "hearbeat",
      msg: "Im still alive!"
    }));
  },5000);

  ws.onclose = () => console.log("Well, you don`t need me anymore, im out! Goodbye client!");

  function WebSocketTest() {
    ws.send(JSON.stringify({
         id: "Test",
         msg: "I want to test the connection!"
       }));
  }