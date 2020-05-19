const scriptName = "봇";
var preChat = null;
var room_list=[];
/**
 * (string) room
 * (string) sender
 * (boolean) isGroupChat
 * (void) replier.reply(message)
 * (boolean) replier.reply(room, message, hideErrorToast = false) // 전송 성공시 true, 실패시 false 반환
 * (string) imageDB.getProfileBase64()
 * (string) packageName
 */

function response(room, msg, sender, isGroupChat, replier, imageDB, packageName) {

    // 도배 방지 시스템 //
    if(preChat == msg) return;
    preChat = msg;

    msg = msg.trim();
    var cmd = msg.split(" ")[0];

    if(msg && room_list.indexOf(room) == -1 && isGroupChat == true) room_list.push(room);
    

    // 메인 챗봇 파트 //
    if(cmd == ".도움말"){
        replier.reply("봇 명령어 (단체채팅)");
        replier.reply("▶ .콘 [검색어] - 콘 자동검색\n▶ .콘 - 콘 관리용 홈페이지\n▶ .콘 업로드 - 업로드 홈페이지\n▶ .콘 목록 - 콘 목록 보기");
    }
    if(cmd == ".콘"){
        var message = msg.replace(".콘 ","");
        if(msg == ".콘") replier.reply("http://koder.iptime.org/");
        else if(message == "목록") replier.reply("http://koder.iptime.org/list.php");
        else if(message == "업로드") replier.reply("http://koder.iptime.org/");
        else replier.reply("http://koder.iptime.org/list.php?search="+message.replace(' ','+'));
    }
    
    if(isGroupChat == false){
        if(cmd == ".공지" && sender == "박성훈"){
            var message = msg.replace(".공지 ","");
            for(var i=0; i<room_list.length; i++){
                replier.reply(room_list[i], message);
            }
        }
    }
}

//아래 4개의 메소드는 액티비티 화면을 수정할때 사용됩니다.
function onCreate(savedInstanceState, activity) {
  var textView = new android.widget.TextView(activity);
  textView.setText("Hello, World!");
  textView.setTextColor(android.graphics.Color.DKGRAY);
  activity.setContentView(textView);
}

function onStart(activity) {}

function onResume(activity) {}

function onPause(activity) {}

function onStop(activity) {}