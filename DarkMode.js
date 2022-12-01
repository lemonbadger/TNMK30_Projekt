function DarkMode(){
    document.getElementById("darkmode").style.color = "darkblue";
    document.getElementById("darkmode").style.fontFamily = "Helvetica,sans-serif";
    document.body.style.backgroundColor = "#6891BE";

    let list = document.getElementsByClassName("darkmode");
    for(let i = 0; i < list.length; ++i){
        list[i].style.color = "darkblue";
        list[i].style.fontFamily = "Helvetica,sans-serif";
    }

}