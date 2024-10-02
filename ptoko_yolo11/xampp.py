import subprocess
import webbrowser
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
import pyautogui

def start_xampp():
    xampp_path = 'C:/xampp' 
    subprocess.run([xampp_path + '/xampp_start'])

def check_xampp_status():
    xampp_path = 'C:/xampp'  
    apache_status = subprocess.run([xampp_path + '/apache/bin/httpd', '-t'], capture_output=True, text=True)
    if apache_status.returncode == 0:
        print("Server Apache: Berjalan")
        x=1
    else:
        print("Server Apache: Error")
        x=0
   
    mysql_status = subprocess.run([xampp_path + '/mysql/bin/mysql', '-h', 'localhost', '-u', 'root', '-e', 'exit'], capture_output=True, text=True)
    if mysql_status.returncode == 0:
        print("Server MySQL: Berjalan")
        y=1
    else:
        print("Server MySQL: Error")
        y=0

    if x==1 and y==1:
        return 1
    else :
        return 0


if __name__ == "__main__":
    start_xampp()
    # Menggunakan webbrowser untuk membuka situs web secara otomatis
    webbrowser.open('http://localhost/ptoko6/')
    time.sleep(1)

# Tekan kombinasi tombol Fn + F11
    pyautogui.hotkey('fn', 'f11')
    # Menambahkan penundaan untuk memastikan situs web sepenuhnya dimuat sebelum diubah ke mode fullscreen
    
    # Memanggil fungsi untuk membuka situs web dalam mode fullscreen
    
