// Validating Empty Field
// function check_empty() {
//     if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
//         alert("Fill All Fields !");
//     } else {
//         document.getElementById('form').submit();
//         alert("Form Submitted Successfully...");
//     }
// }


//Function To Display upload and login Popup
function div_show() {
    document.getElementById('opacity-background').style.display = "block";
}
//Function to Hide upload and login Popup
function div_hide(){
    document.getElementById('opacity-background').style.display = "none";
}


//Function To Display Register Popup
function div2_show() {
    document.getElementById('opacity-background2').style.display = "block";
}
//Function to Hide Register Popup
function div2_hide(){
    document.getElementById('opacity-background2').style.display = "none";
}


//Function To show Post
function div_img_show(id) {
    document.getElementById(id).style.display = "block";
}
//Function to hide Post
function div_img_hide(id){
    document.getElementById(id).style.display = "none";
}

//Function To show Edit Post
function div_edit_show(id) {
    document.getElementById(id).style.display = "block";
}
//Function to hide Edit Post
function div_edit_hide(id){
    document.getElementById(id).style.display = "none";
}
