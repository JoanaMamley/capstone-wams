#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>

//#define OLED_RESET 4
//Adafruit_SSD1306 display(OLED_RESET);

// Replace with your network credentials
const char* ssid     = "Saskia";
const char* password = "12592022";


SoftwareSerial mySerial(14, 12);

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
int fingerprintID = 0;
//String IDname;
String dataType = "Numbers";

void setup(){
  //Fingerprint sensor module setup
  Serial.begin(9600);
  _initWifi();
  // set the data rate for the sensor serial port
  finger.begin(57600);
  Serial.println("Found");
  
//  if (finger.verifyPassword()) {
//    Serial.println("Found fingerprint sensor!");
//  } 
//  else {
//    Serial.println("Did not find fingerprint sensor :(");
//    while (1) { 
//      delay(1);
//      Serial.println("Found");
//      }
//  }

  //OLED display setup
  Wire.begin();
//  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);
  //displays main screen
//  displayMainScreen();
  Serial.println("Found");
}

void loop(){
  displayMainScreen();
  fingerprintID = getFingerprintIDez();
  if (fingerprintID != -1){
      String val = String(fingerprintID);
      delay(50);
     _sendDataToDatabase(val);
    }
}

// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;
  
  // found a match!
  Serial.print("Found ID #"); 
  Serial.print(finger.fingerID); 
  Serial.print(" with confidence of "); 
  Serial.println(finger.confidence);
  return finger.fingerID; 
}

void displayMainScreen(){
//  display.clearDisplay();
//  display.setTextSize(1);
//  display.setTextColor(WHITE);
//  display.setCursor(7,5);
//  display.println("Waiting fingerprint");
  Serial.println("Waiting fingerprint");
//  display.setTextSize(1);
//  display.setTextColor(WHITE);
//  display.setCursor(52,20);
//  display.println("...");  
//  display.display();
  Serial.println("...");
  delay(2000);
}

 void _initWifi() {
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid,password);
  Serial.print("Connecting...");
  while(WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(700);
  }
  Serial.print("\n");
  Serial.println("Connected :)");
 }


  void _sendDataToDatabase(String x) {
  HTTPClient https;
  WiFiClient _client;
  String url = "http://192.168.152.4/capstone/capstone-wams/getData.php?insert=1&data="+dataType+"&value="+ x;
  Serial.println(url);
  https.begin(_client,url);
  int httpsCode = https.GET();
  if(httpsCode > 0) {
    Serial.println("done");
  }
//  else{
//    Serial.println("error");
//    }
  String result = https.getString();
  Serial.println(result);
}
