
function SelectSec() {
    var checkSec1 = document.getElementById("Section1");
    var ShowSec1 = document.getElementById("ShowSec1");
    var checkSec2 = document.getElementById("Section2");
    var ShowSec2 = document.getElementById("ShowSec2");
    var checkSec3 = document.getElementById("Section3");
    var ShowSec3 = document.getElementById("ShowSec3");

    if (checkSec1.checked == true){
        ShowSec1.style.display = "block";
        ShowSec2.style.display = "none";
        ShowSec3.style.display = "none";
        sub.style.display = "none";
    }

    if (checkSec2.checked == true){
        ShowSec1.style.display = "none";
        ShowSec2.style.display = "block";
        ShowSec3.style.display = "none";
        sub.style.display = "none";
    }

    if (checkSec3.checked == true){
        ShowSec1.style.display = "none";
        ShowSec2.style.display = "none";
        ShowSec3.style.display = "block";
        sub.style.display = "none";
    }
}

function formSubmit()
{
    document.getElementById("form1").submit();
}



function handleRadioChange(event) {
const radioButtons = document.getElementsByName(event.target.name);

// Deselect the radio button if it is already selected
if (event.target.checked) {
for (let i = 0; i < radioButtons.length; i++) {
  if (radioButtons[i].value === event.target.value && radioButtons[i] !== event.target) {
    radioButtons[i].checked = false;
  }
}
}
}





        
