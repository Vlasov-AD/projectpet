//Управление глазом

      const eyeAccount = document.getElementById('eye_icon_reset');
      
      //изменение цветов
      eyeAccount.addEventListener("mouseover", (event) =>{
        if (document.getElementById('new_password_reset_form').type == 'password'){
          eyeAccount.style.border = '2px solid #79b260';
          eyeAccount.querySelector('span').style.border = '2px solid #79b260';
        } else{
          eyeAccount.style.border = '2px solid black';
          eyeAccount.querySelector('span').style.border = '2px solid black';
        }
      })

      eyeAccount.addEventListener("mouseout", (event) =>{
        if (document.getElementById('new_password_reset_form').type == 'password'){
          eyeAccount.style.border = '2px solid black';
          eyeAccount.querySelector('span').style.border = '2px solid black';
        } else{
          eyeAccount.style.border = '2px solid #79b260';
          eyeAccount.querySelector('span').style.border = '2px solid #79b260';
        }
      })
      //изменение строки
      eyeAccount.addEventListener("click", (event) =>{
        if (document.getElementById('new_password_reset_form').type == 'password'){
          document.getElementById('new_password_reset_form').type = 'text';
          document.getElementById('new_password_confirmation_reset_form').type = 'text';
          eyeAccount.style.border = '2px solid #79b260';
          eyeAccount.querySelector('span').style.border = '2px solid #79b260';
        } else{
          document.getElementById('new_password_reset_form').type = 'password';
          document.getElementById('new_password_confirmation_reset_form').type = 'password';
          eyeAccount.style.border = '2px solid black';
          eyeAccount.querySelector('span').style.border = '2px solid black';
        }
      })