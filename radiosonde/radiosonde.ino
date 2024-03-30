#include <WiFi.h>
#include <HTTPClient.h>
#include <TinyGPS++.h>
#include <DHT.h>
#include <Wire.h>
#include <Adafruit_BMP085.h>

const char* ssid = "Yasir"; // Ganti dengan SSID WiFi Anda
const char* password = "matek123"; // Ganti dengan kata sandi WiFi Anda
const char* serverAddress = "http://192.168.232.22/radiosonde/connection/get-data.php"; // Ganti dengan alamat server Anda

#define DHTPIN 4
#define DHTTYPE DHT11

#define SERIAL_INTERVAL 2000 // Interval waktu untuk menampilkan data di Serial

// The TinyGPSPlus object
TinyGPSPlus gps;

// DHT sensor object
DHT dht(DHTPIN, DHTTYPE);

// BMP180 sensor object
Adafruit_BMP085 bmp;

unsigned long lastSerialTime = 0; // Waktu terakhir data ditampilkan di Serial

void setup() {
  Serial.begin(115200);
  connectWiFi();
  Serial2.begin(9600);
  Wire.begin();
  dht.begin();
  bmp.begin();
}

void loop() {
  if(WiFi.status() != WL_CONNECTED) { 
    connectWiFi();
  }

  unsigned long currentTime = millis();

  if (currentTime - lastSerialTime >= SERIAL_INTERVAL) {
    sendData(); // Mengirim data ke server
    lastSerialTime = currentTime;
  }

  while (Serial2.available() > 0) {
    if (gps.encode(Serial2.read())) {
      // Tidak melakukan apa pun dengan data GPS pada saat ini
    }
  }
  
  delay(100); // Menunggu sebentar sebelum mengulangi loop
}

void sendData() {
  // Menyimpan data dalam format dengan dua angka di belakang koma
  String latitude = String(gps.location.lat(), 8);
  String longitude = String(gps.location.lng(), 9);
  String altitude = String(gps.altitude.meters(), 2);
  String temperature = String(readTemperature(), 2);
  String humidity = String(readHumidity(), 2);
  String pressure = String(readPressure(), 2);

  String postData = "latitude=" + latitude + "&longitude=" + longitude + "&altitude=" + altitude + "&temperature=" + temperature + "&humidity=" + humidity + "&pressure=" + pressure;

  HTTPClient http;
  http.begin(serverAddress);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  int httpCode = http.POST(postData); 
  String payload = http.getString(); 
  
  Serial.print("URL : "); Serial.println(serverAddress); 
  Serial.print("Data: "); Serial.println(postData); 
  Serial.print("httpCode: "); Serial.println(httpCode); 
  Serial.print("payload : "); Serial.println(payload); 
  Serial.println("--------------------------------------------------");
  
  http.end(); // Menutup koneksi setelah selesai
  delay(5000); // Jeda 5 detik sebelum mengirim data berikutnya
  
  // Memanggil fungsi untuk memperbarui tampilan HTML dengan data terbaru
  updateHTML(payload);
}

void connectWiFi() {
  Serial.println("Connecting to WiFi");
  WiFi.begin(ssid, password);

  int attempt = 0;
  while (WiFi.status() != WL_CONNECTED && attempt < 10) {
    delay(500);
    Serial.print(".");
    attempt++;
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\nConnected to WiFi");
    Serial.print("IP address: "); Serial.println(WiFi.localIP());
  } else {
    Serial.println("\nFailed to connect to WiFi. Please check your network credentials.");
    while (true) {}
  }
}

float readTemperature() {
  return dht.readTemperature();
}

float readHumidity() {
  return dht.readHumidity();
}

float readPressure() {
  return bmp.readPressure() / 100.0; // Convert pressure to hPa
}

void updateHTML(String data) {
  // Memperbarui tampilan HTML dengan data terbaru yang diterima dari server
  // Anda dapat menambahkan kode JavaScript di sini untuk memanipulasi elemen HTML sesuai kebutuhan
  // Misalnya, Anda dapat menggunakan fungsi document.getElementById() untuk mengakses elemen dan mengubah isinya
}
