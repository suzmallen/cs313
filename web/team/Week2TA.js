function makeKnown()
{
    alert("This button has been clicked yo!");
}

function changeColor()
{
    var input = $("#myColorStuffz").val();
    $("#div1").css("background-color", input);
}

function hideSomething()
{
   if (($("#hideStuffz").text()).trim()=== "Hide"){
       $("#div3").fadeOut();
        $("#hideStuffz").text("Show");
       
   }
   else{
       $("#div3").fadeIn();
       $("#hideStuffz").text("Hide");
   }
}