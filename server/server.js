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

function sendAlertAll(titel, text){
  aWss.clients.forEach(function (client) {
    client.send(JSON.stringify({
      info: 'admin-alert',
      title: titel,
      text: text
    }));
  });
}

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
          if(obj2.id == 'online-users'){
            sendOne("total-online", aWss.clients.size);
            console.log(aWss.clients.size);
            return;
          }
          if(obj2.id == 'send-admin-alert'){
            
            con.query("INSERT INTO `admin_global_alerts` (`mes_title`, `mes_text`) VALUES ('" + obj2.titel + "', '" + obj2.text + "')" , function (err, result) {
              sendAlertAll(obj2.titel, obj2.text);
             });
            return;
          }
          if(obj2.id == 'hearbeat'){
            sendOne("hearbeat_recieved", "I`m happy that ur alive :)");
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
          if(obj2.id == 'movie-card'){
            con.query("SELECT * FROM `movies` WHERE `movie_id` = '" + obj2.movie + "'" , function (err, result, fields) {
                if (result.length > 0) {
                    ws.send(JSON.stringify({
                      info: "movie-carddata",
                      msg: "Here you go, this is all the information from the database!",
                      desc: result[0].info,
                      title: result[0].title,
                      image: result[0].image,
                      id: result[0].movie_id
                    }));
                }
                if (result.length < 1){
                  ws.send(JSON.stringify({
                    info: "movie-carddata",
                    msg: "Here you go, this is all the information from the database!",
                    desc: "Oei, er ging iets fout aan onze kant. We hebben geen film kunnen vinden in onze database. Probeer het later nog is of neem contact op met de helpdesk!",
                    title: "Er ging even iets mis :(",
                    image: "https://www.elegantthemes.com/blog/wp-content/uploads/2020/08/000-http-error-codes.png"
                  }));
                    
                }
                
                });
            return;
          }
          if(obj2.id == 'admin-message-read'){
            con.query("UPDATE `admin_messages` SET `readed`=1 WHERE `id` = '" + obj2.message_id + "'" , function (err, result, fields) { });
            return;
          }
      });
  });


  app.listen(9020, () => {
    console.log('Server has been started'); 
    console.log('Startup Done.')
  });