#include <WiFi.h>
#include <FirebaseESP32.h>

#define FIREBASE_HOST "https://hydrotoring.firebaseio.com"
#define FIREBASE_AUTH "FoTQj37Pvsf5xLE3FbVM1cRxmWsFymK46VHxWokM"
//Masukkan wifi credential
#define WIFI_SSID "Enlightment"
#define WIFI_PASSWORD "ra5pb3rry1@3"

//Define FirebaseESP32 data object
FirebaseData firebaseData;
String root = "/sensor/data/";

String sensor[] = {"PH", "PPM", "EC"};
float datasensor[3];

#define INPUT_SIZE 100

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  initWifi();
  initFirebase();
}

void loop() {
  // put your main code here, to run repeatedly:
  getAndSendData();
  delay(1000);
}

void initWifi(){
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    delay(300);
  }
  Serial.println();
  Serial.print("Connected with IP: ");
  Serial.println(WiFi.localIP());
  Serial.println();
}

void initFirebase(){
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
  Firebase.reconnectWiFi(true);

  //Set database read timeout to 1 minute (max 15 minutes)
  Firebase.setReadTimeout(firebaseData, 1000 * 60);
  //tiny, small, medium, large and unlimited.
  //Size and its write timeout e.g. tiny (1s), small (10s), medium (30s) and large (60s).
  Firebase.setwriteSizeLimit(firebaseData, "tiny");
}

void getAndSendData(){
  // Get next command from Serial dari arduino
  char input[INPUT_SIZE + 1];
  byte size = Serial.readBytes(input, INPUT_SIZE);
  // Add the final 0 to end the C string
  input[size] = 0;
  
  // Read each command pair 
  char* command = strtok(input, "&");
  
  while (command != 0)
  {
      // Split the command in two values
      char* separator = strchr(command, ':');
      if (separator != 0)
      {
          // Actually split the string in 2: replace ':' with 0
          *separator = 0;
          int sensorId = atoi(command);
          ++separator;
          float sensorData = atof(separator);
  
          // Do something with sensorId and sensorData
          //dengan asumsi kalian ngirim data dari arduino dengan bentuk command sbb:
          //1:variabelsensor&2:variabelsensor&3:variabelsensor&4:variabelsensor&5:variabelsensor&6:variabelsensor
          //saya pakai sensor 1 -> temperatur air, 2 -> kelembapan, 3 -> temperatur udara
          //4 -> ph, 5 -> tds, 6 -> ec
          if(sensorId == 1){
            datasensor[0] = sensorData;
            Serial.print("PH = ");
            Serial.println(sensorData);
          }else if(sensorId == 2){
            datasensor[1] = sensorData;
            Serial.print("PPM = ");
            Serial.println(sensorData);
          }else if(sensorId == 3){
            datasensor[2] = sensorData;
            Serial.print("EC = ");
            Serial.println(sensorData);
          }
          
          //ini untuk ngirim data dari esp ke firebase
          Firebase.setDouble(firebaseData, root + sensor[0], datasensor[0]);
          Firebase.setDouble(firebaseData, root + sensor[1], datasensor[1]);
          Firebase.setDouble(firebaseData, root + sensor[2], datasensor[2]);
          Serial.println("Beres");
                      
      }
      // Find the next command in input string
      command = strtok(0, "&");
  }
   
  
}
