const app = require('express')();
const appWs = require('express-ws')(app);
var http = require('http');
var mysql = require('mysql');
require('dotenv').config();

var con = mysql.createConnection({
    host: "db2.dixiehosting.nl",
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: "lucasnijssen_cineplus"
  });

var aWss = appWs.getWss('/server');

app.ws('/server', ws => {

    function sendOne(info, text){
        ws.send(JSON.stringify({
          info: info,
          msg: text
        }));
      }
      function sendMovie(info, text, cdn, title){
        ws.send(JSON.stringify({
          info: info,
          msg: text,
          cdn: cdn,
          title: title
        }));
      }


      ws.on('message', msg => {
          console.log('Received: ', msg);
          var obj2 = JSON.parse(msg);
          if(obj2.id == "hello"){
            ws.send(JSON.stringify({
              info: "welcome",
              msg: "Hello new client, your handshake is accepted!"
            }));
            return;
          }
          if(obj2.id == 'Test'){
            sendOne("recieved_test", "The test was well recieved!");
            return;
          }
          if(obj2.id == 'movie-info'){
            con.query("SELECT * FROM `movies` WHERE `movie_id` = '" + obj2.movie + "'" , function (err, result, fields) {
                if (result.length > 0) {
                    sendMovie("movie-data", "Here you go, this is all you need!", result[0].cdn, result[0].title);
                }
                if (result.length < 1){
                    sendMovie("movie-data", "There was a error", "https://cdn.gewoonboyke.nl/movies/error.mp4", "Er was een probleem met het laden!");
                    
                }
                
                });
            return;
          }
      });
  });


  app.listen(4009, () => {
    console.log('Server has been started'); 
    console.log('Startup Done.')
  });