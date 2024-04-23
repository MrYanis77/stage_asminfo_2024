window.onload=(event) =>{
    const header = document.querySelector('.index-bar');
    const mobileButton = document.querySelector('.mobile-button');
    const mobileBarMenu = document.querySelector('.mobile-bar');
    const eye = document.querySelector(".feather-eye");
    const eyeoff = document.querySelector(".feather-eye-off");
    const passwordField = document.querySelector("input[type=password]");

    mobileButton.addEventListener('click',(() =>{
        mobileBarMenu.classList.toggle('show');
    }))
    

    window.addEventListener('scroll', (scroll) =>{
        y = scrollY;
        if(y > 130){
            header.classList.add('black');
        }
        else{
            if(header.classList.contains('index-bar')){
                header.classList.remove('black')
            }
        }
    })

    eye.addEventListener("click", () => {
        eye.style.display = "none";
        eyeoff.style.display = "block";
        passwordField.type = "text";
      });
      
      eyeoff.addEventListener("click", () => {
        eyeoff.style.display = "none";
        eye.style.display = "block";
        passwordField.type = "password";
      });





}
