//Hier komt de websocket connection code

const ws = new WebSocket("ws://wings5.dixiehosting.nl:9020/server");


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
    console.log(obj.msg)
    if(obj.info == "recieved_test"){
      console.log("Test command was ran!")
      alert("Connection test successvol!");
    }
    if(obj.info == "movie-data"){
        console.log(obj.cdn);
        setInformation(obj.title, obj.cdn, "testing");
      }
  };

  ws.onclose = () => console.log("WebSocket closed!");

  function WebSocketTest() {
    ws.send(JSON.stringify({
         id: "Test",
         msg: "I want to test the connection!"
       }));
  }