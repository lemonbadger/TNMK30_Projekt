function DarkMode(){
    document.body.classList.toggle("darkmode");

    var h1s = document.getElementsByTagName("h1");
    for (var i = 0; i < h1s.length; i++)
        h1s[i].classList.toggle("darkmode"); 

    var h3s = document.getElementsByTagName("h3");
    for (var i = 0; i < h3s.length; i++)
        h3s[i].classList.toggle("darkmode"); 
    
    var ps = document.getElementsByTagName("p");
    for (var i = 0; i < ps.length; i++)
        ps[i].classList.toggle("darkmode"); 

        //Funktion tagen från W3School
}
