function DarkMode(){
    var element = document.body;
    element.classList.toggle("darkmode"); //Funktion tagen från W3School
    
    if (body.classList.contains('dark')){ //lösnning till att behålla darkmode 
        body.classList.remove('dark');    //vid updatering av sida (hittat i ett forum)
        localStorage.setItem("theme","light");
        button.innerHTML="Turn on dark mode";
  } else{
        body.classList.add('dark');
        localStorage.setItem("theme","dark");
        button.innerHTML="Turn off dark mode";
    }

    if(localStorage.getItem("theme")=== "dark"){
        body.classList.add('dark');
        button.innerHTML= "tTurn off dark mode";
    }
}
