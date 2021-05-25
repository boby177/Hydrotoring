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
  firebase.auth.Auth.Persistence.LOCAL;

  $("#btn_login").click(function()
  {
        var email = $("#txt_email").val();
        var password = $("#txt_password").val();

        if(email != "" && password != "") {
            var result = firebase.auth().signInWithEmailAndPassword(emai, password);

            result.catch(function(error)
            {
                  var errorCode = error.code;
                  var errorMessage = error.message;
               
                  console.log(errorCode);
                  onsole.log(errorCode);

                  windows.alert("Pesan : " + errorMessage);
            });
        }
        else {
              window.alert("Mohon isikan semua data terlebih dahulu");
        };
  });