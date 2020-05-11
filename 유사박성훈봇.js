const scriptName = "봇";

var preChat = null;
var preDate = null;
var pyeong=0;
var bestpyeong=0;
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

    // 띠꺼움지수 측정기 리프레쉬 //
    var date = new Date().getDay();
    if(preDate != date){
        if(bestpyeong < pyeong) bestpyeong = pyeong;
        pyeong = 0;
        preDate = date;
    }

    // 띠꺼움지수 측정기 (요청받은 기능) //
    if(sender == "평예찬"){
        if(msg == "ㅋ") pyeong++;
        if(msg == "야발") pyeong++;
        if(msg.indexOf("퉷") !== -1) pyeong++;
        if(msg.indexOf("퉤") !== -1) pyeong++;
    }



    // 메인 챗봇 파트 //
    msg = msg.trim();
    var cmd = msg.split(" ")[0];
    if(cmd == ".콘"){
        var message=msg.replace(".콘 ","");
        if(message == "목록") replier.reply("http://koder.iptime.org:52000/list.php");
        else if(message == "등록") replier.reply("http://koder.iptime.org:52000/");
        else replier.reply("http://koder.iptime.org:52000/list.php?search="+message.replace(' ','+'));
    }



    if(msg == ".명령어"){
        replier.reply("봇의 전체 명령어");
        replier.reply("▶ .콘 [검색어] - 콘 자동검색\n▶ .콘 목록 - 콘의 전체 목록\n▶ .콘 등록 - 콘 등록 페이지");
        replier.reply("▶ .주사위 - 주사위가챠\n▶ .소라고동님 [문장] - 소라고동");
        replier.reply("▶ .평 - 평예찬 띠꺼움지수\n▶ .평 최고기록 - 띠꺼움지수 최고기록\n▶ .평 추 - 띠꺼움지수 올리기");
    }
    if(msg == ".주사위"){
        var dice = Math.floor(Math.random()*6+1);
        replier.reply("주사위가챠의 결과는 "+dice);
        switch(dice){
            case 6: replier.reply("●    ●\n●    ●\n●    ●"); break;
            case 5: replier.reply("●    ●\n    ●    \n●    ●"); break;
            case 4: replier.reply("●    ●\n            \n●    ●"); break;
            case 3: replier.reply("    ●    \n    ●    \n    ●    "); break;
            case 2: replier.reply("            \n●    ●\n            "); break;
            case 1: replier.reply("            \n    ●    \n            "); break;
        }
    }
    if(cmd == ".소라고동님" || cmd == ".소라고둥님"){
        var yesorno = Math.round(Math.random());
        if(yesorno == 0) replier.reply("아니.");
        if(yesorno == 1) replier.reply("그래.");
    }
    if(msg == ".평 추"){ pyeong++; replier.reply("추가했습니다.\n현재 띠꺼움은 "+pyeong+"점 입니다."); }
    if(msg == ".평")replier.reply("오늘의 띠꺼움은 "+pyeong+"점 입니다.");
    if(msg == ".평 최고기록") replier.reply("최고기록은 "+bestpyeong+"입니다.");

    if(sender == "박성훈" & msg == ".살아있니") replier.reply("정상가동중");
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