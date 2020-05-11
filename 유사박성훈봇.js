const scriptName = "봇";

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
    msg = msg.trim();
    var cmd = msg.split(" ")[0];
    if(cmd == "봇"){
        var message = msg.replace("봇 ", "");
        if(message == "도움말"){  replier.reply("디씨콘-출력기\n디씨콘 일일이 찾아서 출력하기 귀찮아서\n할짓없는 박성훈이 설계했습니다.");  }
        if(message == "명령어"){  replier.reply("💬봇의 전체 명령어\n봇 도움말 - 봇 만든이, 만든이유 등\n봇 명령어 - 봇의 전체 명령어 목록\n봇 [검색어] 콘 - 이모티콘 자동검색\n봇 주사위 - 주사위가챠를 해볼수 있음\n");  }

        if(message.indexOf("콘") != -1){
            message=message.replace(" 콘","");
            if(message == " 목록"){
                replier.reply("전체의 목록은\n");
            }else{
                replier.reply("http://116.127.164.173/list.php?search="+message.replace(' ','+'));
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