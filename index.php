<!DOCTYPE html>
<html lang='pl'>
  <head>
    <meta charset="utf-8">
    <title>T0_D0</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <section id="menu">
      <h1>To-Do</h1>
    </section>
    <section id="logIn">
        <h2 id="text">Sign in</h2>
        <form id="form">
            <label id="ch1">Login</label><input type="text">
            <br>
            <label>Password</label><input type="password">
            <br>
            <input type="button" id="ch2" value="Sign in">
            <p id="textR">Don't have an account yet? <span onclick="ChangeForm(1)">Sign up</span></p>
        </form>
    </section>
    <section id="footer">
      <p>Created by Kamil Kula</p>
    </section>
  </body>
  <script>

    let form = document.getElementById('form');
    
    //switches forms between Sign Up [1] and Sign In [2]//
    function ChangeForm(formType){
        switch(formType){
            case 1:
                document.getElementById('text').innerHTML='Sign Up';
                document.getElementById('textR').innerHTML="Don't have an account yet? <span onclick='ChangeForm(2)'>Sign up</span>";

                CreateLabelInput('text','E-mail','ch1');
                CreateLabelInput('password','Repeat Password','ch2');
                //add e-mail r_pass + change Sign In -> Up (btn, h1), span text
                break;
            case 2:
                document.getElementById('text').innerHTML='Sign In';
                document.getElementById('textR').innerHTML="Already have an account yet? <span onclick='ChangeForm(1)'>Sign in</span>";

                form.removeChild(document.getElementById('E-mail'));
                form.removeChild(document.getElementById('E-mail'));

                form.removeChild(document.getElementById('Repeat Password'));
                form.removeChild(document.getElementById('Repeat Password'));
                //remove e-mail r_pass + change Sign Up -> In (btn, h1), span text
                break;
        }
    }

    //creates label with input and args. repsondes for a type name and place where to put these objects//
    function CreateLabelInput(type,name,before){
        const label = document.createElement('label');
        label.setAttribute('for', name);
        label.setAttribute('id', name);
        label.textContent = name;

        const input = document.createElement('input');
        input.setAttribute('type', type);
        input.setAttribute('id',name);

        form.insertBefore(label,document.getElementById(before));
        form.insertBefore(input,document.getElementById(before));
    }
  </script>
</html>
