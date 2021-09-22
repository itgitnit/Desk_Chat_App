<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desk Chat</title>
  </head>
  <style type="text/css">
    @font-face {
      font-family: headFont;
      src: url(ui/fonts/Raleway-Medium.ttf);
    }
    @font-face {
      font-family: myFont;
      src: url(ui/fonts/Raleway-Regular.ttf);
    }

    #wrapper {
      max-width: 900px;
      min-height: 500px;
      /* display: flex; */
      margin: auto;
      color: grey;
      font-family: myFont;
      font-size: 13px;
    }

    form {
      margin: auto;
      padding: 10px;
      /* background-color: black; */
      width: 100%;
      max-width: 400px;
    }

    input[type="text"],
    input[type="password"],
    input[type="button"] {
      padding: 10px;
      margin: 10px;
      width: 98%;
      border-radius: 5px;
      border: solid 1px grey;
    }
    input[type="button"] {
      width: 103%;
      cursor: pointer;
      background-color: #2b5488;
      color: white;
    }
    input[type="radio"] {
      transform: scale(1.2); /*It scales from 1 se 1.2*/
      cursor: pointer;
    }
    #header {
      background-color: #485b6c;
      /* height: 70px; */
      font-size: 40px;
      text-align: center;
      font-family: headFont;
      width: 100%;
      color: white;
    }
    #error {
      text-align: center;
      padding: 0.5em;
      background-color: #ecaf91;
      color: #000;
      display: none;
      max-width: 500px;
      margin: auto;
      font-weight: bolder;
    }
  </style>
  <body>
    <div id="wrapper">
      <div id="header">
        My Chat
        <div style="font-size: 20px; font-family: myFont">Sign_Up</div>
      </div>

      <div id="error">Error TExt</div>

      <form id="myform" action="">
        <input type="text" name="username" placeholder="Username" /><br />
        <input type="text" name="email" placeholder="Email" /><br />
        <div style="padding: 10px">
          <br />Gender: <br />
          <input type="radio" value="Male" name="gender" />Male<br />
          <input type="radio" value="Female" name="gender" />Female<br />
        </div>
        <input type="password" name="password" placeholder="Password" /><br />
        <input
          type="password"
          name="password2"
          placeholder="Retype Password"
        /><br />
        <input type="button" value="Sign_Up" id="signup_button" /><br />
      </form>
    </div>
  </body>
</html>
<script type="text/javascript">
  function _(element) {
    return document.getElementById(element);
  }

  var signup_button = _("signup_button");
  signup_button.addEventListener("click", collect_data);

  function collect_data() {
    signup_button.disabled = true;
    signup_button.value = "Loading...Please wait...";

    var myform = _("myform");
    var inputs = myform.getElementsByTagName("INPUT");

    var data = {};
    for (var i = inputs.length - 1; i >= 0; i--) {
      var key = inputs[i].name;

      switch (key) {
        case "username":
          data.username = inputs[i].value;
          break;
        case "email":
          data.email = inputs[i].value;
          break;
        case "gender":
          if (inputs[i].checked) {
            data.gender = inputs[i].value;
          }
          break;
        case "password":
          data.password = inputs[i].value;
          break;
        case "password2":
          data.password2 = inputs[i].value;
          break;
      }
    }
    send_data(data, "signup");
  }
  function send_data(data, type) {
    var xml = new XMLHttpRequest();
    xml.onload = function () {
      if (xml.readyState == 4 || xml.status == 200) {
        handle_result(xml.responseText);

        signup_button.disabled = false;
        signup_button.value = "Signup";
      }
    };

    data.data_type = type;
    var data_string = JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data_string);
  }

  function handle_result(result) {
    var data = JSON.parse(result);
    if (data.data_type == "info") {
      window.location = "index.php";
    } else {
      var error = _("error");
      error.innerHTML = data.message;
      error.style.display = "block";
    }
  }
</script>
