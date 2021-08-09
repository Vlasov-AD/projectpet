      const enterForm = document.getElementById('pop_window_enter');
      const registrationForm = document.getElementById('pop_window_registration');
      const recoveryForm = document.getElementById('pop_window_recovery');

      const enterToRecovery = document.getElementById('form_enter_to_recovery');
      const enterToRegistration = document.getElementById('form_enter_to_registration');

      const recoveryToEnter = document.getElementById('from_recovery_to_enter');
      const recoveryToRegistration = document.getElementById('from_recovery_to_registration');
      
      const registrationToEnter = document.getElementById('form_registration_to_enter');
      //Из формы входа
      enterToRecovery.onclick = () =>{
        enterForm.style.display = 'none';
        recoveryForm.style.display = 'block';
      }

      enterToRegistration.onclick = () =>{
        enterForm.style.display = 'none';
        registrationForm.style.display = 'block';
      }

      //Из формы восстановления

      recoveryToEnter.onclick = () =>{
        recoveryForm.style.display = 'none';
        enterForm.style.display = 'block';
      }

      recoveryToRegistration.onclick = () =>{
        recoveryForm.style.display = 'none';
        registrationForm.style.display = 'block';
      }
      //Из формы регистрации 
      registrationToEnter.onclick = () =>{
        registrationForm.style.display = 'none';
        enterForm.style.display = 'block';
      }

      //Закрытие окна только при нажатии на крестик или в сторону
      document.addEventListener("mousedown", (event) =>{
        if (event.target == enterForm || 
            event.target == registrationForm || 
            event.target == recoveryForm || 
            event.target == enterForm.querySelector('p') ||
            event.target == registrationForm.querySelector('p') ||
            event.target == recoveryForm.querySelector('p'))
        {
          enterForm.style.display = 'none';
          registrationForm.style.display = 'none';
          recoveryForm.style.display = 'none';
        }
      })


      //Управление глазом

      const pop_eye = document.getElementsByClassName('eye_icon');
      //0 - окно регистрации, 1 - входа

      pop_eye[0].addEventListener("mouseover", (event) =>{
        if (document.getElementById('password_register_form').type == 'password'){
          pop_eye[0].style.border = '2px solid #79b260';
          pop_eye[0].querySelector('span').style.border = '2px solid #79b260';
        } else{
          pop_eye[0].style.border = '2px solid black';
          pop_eye[0].querySelector('span').style.border = '2px solid black';
        }
      })

      pop_eye[0].addEventListener("mouseout", (event) =>{
        if (document.getElementById('password_register_form').type == 'password'){
          pop_eye[0].style.border = '2px solid black';
          pop_eye[0].querySelector('span').style.border = '2px solid black';
        } else{
          pop_eye[0].style.border = '2px solid #79b260';
          pop_eye[0].querySelector('span').style.border = '2px solid #79b260';
        }
      })

      pop_eye[0].addEventListener("click", (event) =>{
        if (document.getElementById('password_register_form').type == 'password'){
          document.getElementById('password_register_form').type = 'text';
          document.getElementById('password_register_form_confirm').type = 'text';
          pop_eye[0].style.border = '2px solid #79b260';
          pop_eye[0].querySelector('span').style.border = '2px solid #79b260';
        } else{
          document.getElementById('password_register_form').type = 'password';
          document.getElementById('password_register_form_confirm').type = 'password';
          pop_eye[0].style.border = '2px solid black';
          pop_eye[0].querySelector('span').style.border = '2px solid black';
        }
      })

      pop_eye[1].addEventListener("mouseover", (event) =>{
        if (document.getElementById('password_enter_form').type == 'password'){
          pop_eye[1].style.border = '2px solid #79b260';
          pop_eye[1].querySelector('span').style.border = '2px solid #79b260';
        } else{
          pop_eye[1].style.border = '2px solid black';
          pop_eye[1].querySelector('span').style.border = '2px solid black';
        }
      })

      pop_eye[1].addEventListener("mouseout", (event) =>{
        if (document.getElementById('password_enter_form').type == 'password'){
          pop_eye[1].style.border = '2px solid black';
          pop_eye[1].querySelector('span').style.border = '2px solid black';
        } else{
          pop_eye[1].style.border = '2px solid #79b260';
          pop_eye[1].querySelector('span').style.border = '2px solid #79b260';
        }
      })

      pop_eye[1].addEventListener("click", (event) =>{
        if (document.getElementById('password_enter_form').type == 'password'){
          document.getElementById('password_enter_form').type = 'text';

          pop_eye[1].style.border = '2px solid #79b260';
          pop_eye[1].querySelector('span').style.border = '2px solid #79b260';
        } else{
          document.getElementById('password_enter_form').type = 'password';
          pop_eye[1].style.border = '2px solid black';
          pop_eye[1].querySelector('span').style.border = '2px solid black';
        }
      })
      

