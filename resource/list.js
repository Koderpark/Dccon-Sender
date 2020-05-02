function control(){
    var div = document.getElementsByClassName("folder");
    
    for(var i=0; i<=div.length; i++){
        if(div[i].innerHTML.indexOf(event.target.text) !== -1){
            if(document.getElementsByClassName("folder")[i].style.display == 'block'){
                document.getElementsByClassName("folder")[i].style.display = 'none';

                document.getElementsByClassName("extend")[i].style.backgroundColor = 'rgb(240,240,240)';
                document.getElementsByClassName("extend")[i].style.color = 'black';

            }
            else if(document.getElementsByClassName("folder")[i].style.display !== 'block'){
                document.getElementsByClassName("folder")[i].style.display = "block";

                document.getElementsByClassName("extend")[i].style.backgroundColor = 'rgb(40,40,40)';
                document.getElementsByClassName("extend")[i].style.color = 'white';

            }
        }
    }
}