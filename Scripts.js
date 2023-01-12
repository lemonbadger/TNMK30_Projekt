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
    
    var lis = document.getElementsByTagName("li");
    for (var i = 0; i < lis.length; i++)
        lis[i].classList.toggle("darkmode");

    var Load = document.getElementsByClassName("LoadMoreButton");
    for (var i = 0; i < Load.length; i++)
        Load[i].classList.toggle("darkmode");
    
    var Txt = document.getElementsByClassName('TextOverflow');
    for (var i = 0; i < Txt.length; i++)
        Txt[i].classList.toggle("darkmode");

    var Piece_dark = document.getElementsByClassName('a PieceButton');
    for (var i = 0; i < Piece_dark.length; i++)
        Piece_dark[i].classList.toggle("darkmode");
        //Funktion tagen från W3School

    var ResButton = document.getElementsByClassName('a ResultSet');
    for (var i = 0; i < ResButton.length; i++)
        ResButton[i].classList.toggle("darkmode");
    
        var PieceTXT = document.getElementsByClassName('TXT');
    for (var i = o; i < PieceTXT.length; i++)
        PieceTXT[i].classList.toggle("darkmode");
}
