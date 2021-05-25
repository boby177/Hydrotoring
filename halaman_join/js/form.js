  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD9qA3uhStK9IeTPY2CcRKs-xhqjwGWJhE",
    authDomain: "hydrotoring.firebaseapp.com",
    databaseURL: "https://hydrotoring.firebaseio.com",
    projectId: "hydrotoring",
    storageBucket: "hydrotoring.appspot.com",
    messagingSenderId: "365288709509",
    appId: "1:365288709509:web:f0bf7c63ec52d8e457f8ec",
    measurementId: "G-S8F6HX322S"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

    const auth = firebase.auth();

    function register() {

        var email = document.getElementById("txt_email");
        var password = document.getElementById("txt_password");

        const promise = auth.createUserWithEmailAndPassword(email.value, password.value);
        promise.catch(e => alert(e.message));

        alert("Berhasil membuat akun, silahkan untuk login");
    }

    function login() {

        var email = document.getElementById("txt_email");
        var password = document.getElementById("txt_password");

        const promise = auth.signInWithEmailAndPassword(email.value, password.value);
        promise.catch(e => alert(e.message));

        alert("Login sebagai : " + email.value);

        //take user to different homepage
        firebase.auth().onAuthStateChanged(function(user){
            if(user){
              window.location.replace="../../halaman_utama/index.php";
            }
          });
            
        }

    // function logout() {
    //     auth.signOut();
    //     alert("Signed Out");

    //     firebase.auth().onAuthStateChanged(function(user){
    //       if(user){
    //         window.location.href="../../halaman_join/login.html";
    //       }
    //     });
    // }

    // mainApp.logout = logout;

    
