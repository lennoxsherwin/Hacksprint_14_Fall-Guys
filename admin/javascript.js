//REMOVE A ELEMENT WHEN ID IS PASSED
function remove_element(id){
  var obj = document.getElementById(id);
  console.log("Removing "+id);
  obj.remove();
  temp_screen_count--;
  //screen_count--;
  if(temp_screen_count == 1){
    console.log("div is empty");
    document.getElementById('new_screen_div').style.display="none";
    document.getElementById('add_screen_heading').style.display="none";
    document.getElementById('make_changes_button').style.display="none";
  }
}
function CheckPasswordNew(inputtxt)
{
  var decimal=  /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;

  clear_input('a_psw');
  if(inputtxt.value.match(decimal))
    {
      return true;
    }
  else
    {
      clear_input('psw');
      alert('Please match the requested format: Must contain atleast one number,one uppercase and lowercase letter,one special character,minimum 8 and a maximum of 16 characters.')
      return false;
    }
}
function CheckPasswordOld(inputtxt)
{
  var decimal=  /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;

  clear_input('old_a_psw');
  if(inputtxt.match(decimal))
    {
      return true;
    }
  else
    {
      clear_input('old_psw');
      alert('Please match the requested format: Must contain atleast one number,one uppercase and lowercase letter,one special character,minimum 8 and a maximum of 16 characters.')
      return false;
    }
}
function check_same_or_not(v1,v2){
  if(v1 == v2)
  {
    return true;
  }
  else
  {
    alert('Enter the same password again');
    clear_input('a_psw');
    document.getElementById('a_psw').focus();
    document.getElementById('a_psw').select();
    document.getElementById('a_psw').click();
  }
}
function check_same_or_not_old(v1,v2){
  if(v1 == v2)
  {
    return true;
  }
  else
  {
    alert('Enter the same password again');
    clear_input('old_a_psw');
    document.getElementById('old_a_psw').focus();
    document.getElementById('old_a_psw').select();
    document.getElementById('old_a_psw').click();
  }
}
function check_username_availability(user_name) {
  var check_user_name = user_name_array.includes(user_name);
  if(check_user_name == true){
    alert("User Name Is Taken. Enter a different User Name.");
    document.getElementById('new_user_name').focus();
    document.getElementById('new_user_name').value="";
    document.getElementById('new_user_name').select();
    document.getElementById('new_user_name').click();
  }
  //else {
    //alert("Valid User Name");
  //}
}
function clear_input(id) {
  document.getElementById(id).value="";
}
function assign_to(value,id) {
  document.getElementById(id).value = value;
}
function assign_values_to(value1,value2,id1,id2) {
  document.getElementById(id1).value = value1;
  document.getElementById(id2).value = value2;
}
//CHECK A CHECKBOX
function check(id) {
  document.getElementById(id).checked = true;
}
//UNCHECK A CHECKBOX
function uncheck(id) {
  document.getElementById(id).checked = false;
}
function flash_messages(message) {
  alert(message);
}
function check_role(role_name,id){
  var check_role = role_array.includes(role_name);
  if(check_role == false){
    alert("Choose a role from the given list");
    document.getElementById(id).focus();
    document.getElementById(id).value="";
    document.getElementById(id).select();
    document.getElementById(id).click();
  }
}
function showUser(str) {
  event.preventDefault();
  //hide_div("new_screen_div");
  document.getElementById('fields_from_ajax').style.display = "block";
   if (str == "") {
       document.getElementById("txtHint").innerHTML = "";
       return;
   } else {
       if (window.XMLHttpRequest) {
           // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp = new XMLHttpRequest();
       } else {
           // code for IE6, IE5
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       }
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("field_append_div").innerHTML = this.responseText;
           }
       };
       xmlhttp.open("GET","get_fields_ajax.php?q="+str,true);
       xmlhttp.send();
   }
}
function check_company(company_name,id){
  var check_company = company_array.includes(company_name);
  if(check_company == false){
    alert("Choose a company from the given list");
    document.getElementById(id).focus();
    document.getElementById(id).value="";
    document.getElementById(id).select();
    document.getElementById(id).click();
  }
}
/*function validateForm() {
  var x = document.forms["customer_details"]["customer_name"].value;
  var y = document.forms["customer_details"]["mobile_no"].value;
  if (x == "" && y == "") {
    alert("Customer Name and Mobile Number 1 must be filled out");
    return false;
  }

  else if (x == "") {
    alert("Customer Name must be filled out");
    return false;
  }

  else if (y == "") {
    alert("Mobile Number 1 must be filled out");
    return false;
  }
}
function check_state(state_id,id){
  var check_state = state_array.includes(state_id);
  if(check_state == false){
    alert("Choose a state from the given list");
    document.getElementById(id).focus();
    document.getElementById(id).value="";
    document.getElementById(id).select();
    document.getElementById(id).click();
  }
}
function check_country(country_id,id){
  var check_country = country_array.includes(country_id);
  if(check_country == false){
    alert("Choose a country from the given list");
    document.getElementById(id).value='';
  }
}
function load_nav() {
     document.getElementById("navbar").innerHTML='<object type="text/html" data="nav.html" ></object>';
}

  function confirmDelete() {
      var result = confirm("Are you sure you want to delete this record?");
      if(result)
        return true;
      else
        return false;
  }*/
  function hide_div(id){
    document.getElementById(id).style.display="none";
  }
  function doValidate() {
        console.log('Validating...');
        try {
            addr = document.getElementById('user_name').value;
            pw = document.getElementById('password').value;
            console.log("Validating addr="+addr+" pw="+pw);
            if (addr == null || addr == "" || pw == null || pw == "") {
                alert("Both fields must be filled out");
                return false;
            }
            return true;
        } catch(e) {
            return false;
        }
        return false;
  }
  window.onload = function() {
     document.getElementById("logout").onclick = function() {
       var result = confirm("Are you sure you want to logout?");
       if(result)
        return true;
       else
        return false;
     }
   }
   function checkPermission(permission,id) {
     if(permission==0) {
       document.getElementById(id).style.display="none";
     } else if(permission==1) {
       document.getElementById(id).style.display="block";
     }
   }

   function change_password(id,name) {
     document.getElementById("new_screen_div").style.display = "block";
     document.getElementById("add_screen_heading").style.display = "block";
     document.getElementById("make_changes_button").style.display = "block";
     document.getElementById("new_user_form").style.display = "none";
     //document.getElementById("fields_from_ajax").style.display = "block";
     assign_values_to(id,name,'user_id_input','user_name_input');
   }
