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
    firebase.analytics();

    var database = firebase.database();