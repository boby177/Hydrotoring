

    const auth = firebase.auth();

    function register() {

        var email = document.getElementById("txt_email");
        var password = document.getElementById("txt_password");

        const promise = auth.createUserWithEmailAndPassword(email.value, password.value);
        promise.catch(e => alert(e.message));

        alert("Registered");
    }

    function login() {

        var email = document.getElementById("txt_email");
        var password = document.getElementById("txt_password");

        const promise = auth.signInWithEmailAndPassword(email.value, password.value);
        promise.catch(e => alert(e.message));

        alert("Login " + email.value);

        //take user to different homepage
        firebase.auth().onAuthStateChanged(function(user){
            if(user){
              window.location.href="index.php";
            }
          });
            
        }

    function logout() {
        auth.signOut();
        alert("Signed Out");

        firebase.auth().onAuthStateChanged(function(user){
          if(user){
            window.location.href="login.html";
          }
        });
    }

    mainApp.logout = logout;

    
