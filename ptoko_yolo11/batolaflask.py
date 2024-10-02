
from ultralytics import YOLO
import cv2
import math
import torch
import time
import numpy as np
from collections import defaultdict
from flask_mysqldb import MySQL
from flask import Flask, Response, jsonify, send_file

#ptoko6

#ganti ke CCTV
app = Flask(__name__)
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'ptoko'
mysql = MySQL(app)

MINIMUM_FRAME_PROCESSING_TIME = 0.1

@app.route('/video')
def video():
    camera_data = get_camera_source()
    cd=camera_data[1]
    if cd== "0":
        cd=int(cd)
        #rtsp://admin:DQTXWN@192.168.0.187:554/Streaming/Channels/101/554
    return Response(generate_frames(path_x="batola11.mp4"), mimetype='multipart/x-mixed-replace; boundary=frame')

@app.route('/image')
def image():
    image_path = 'nosignal.gif'
    return send_file(image_path, mimetype='image/gif')


def get_rax():
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM tb_rax")
      # Ubah kondisi sesuai kebutuhan Anda
    data = cur.fetchall()  # Menggunakan fetchone() karena hanya ingin satu baris saja
    cur.close()
    return data if data else None  

def get_camera_source():
    cur = mysql.connection.cursor()
    cur.execute("SELECT id_custom, sumber_camera, jumlahRaxBox, polylines FROM tb_custom WHERE id_custom = 1")  # Ubah kondisi sesuai kebutuhan Anda
    data = cur.fetchone()  # Menggunakan fetchone() karena hanya ingin satu baris saja
    cur.close()
    return data if data else None

def reset_all():
    print("reset_all")
    cur = mysql.connection.cursor()
    cur.execute("DELETE FROM tb_realtime WHERE id != 0")
    mysql.connection.commit()
    cur.close()

def generate_frames(path_x=''):
    with app.app_context():
        yolo_output = CCTV_detection(path_x)
        for detection_ in yolo_output:
            ref, buffer = cv2.imencode('.jpg', detection_)
            frame = buffer.tobytes()
            yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')
        

def orientation(p1, p2, p3):
    # Fungsi ini mengembalikan orientasi dari tiga titik (p1, p2, p3)
    # Menggunakan aturan produk vektor
    val = (p2[1] - p1[1]) * (p3[0] - p2[0]) - (p2[0] - p1[0]) * (p3[1] - p2[1])
    if val == 0:
        return 0  # Linear (berada di jalur)
    elif val > 0:
        return 1  # Berlawanan arah jarum jam
    else:
        return 2  # Searah jarum jam

def is_inside_rectangle(rectangle, point):
    # Fungsi ini memeriksa apakah titik berada di dalam segi empat yang dibentuk oleh empat titik
    p1, p2, p3, p4 = rectangle
    o1 = orientation(p1, p2, point)
    o2 = orientation(p2, p3, point)
    o3 = orientation(p3, p4, point)
    o4 = orientation(p4, p1, point)
    if o1 == o2 == o3 == o4 == 0:
        return True  # Titik berada di jalur
    elif o1 == o2 and o2 == o3 and o3 == o4:
        return True  # Titik berada di dalam segi empat
    else:
        return False
    
def CCTV_detection(path_x):
    video_capture = path_x
    #Create a Webcam Object
    cap=cv2.VideoCapture(video_capture)
    device = 'cuda' if torch.cuda.is_available() else 'cpu'
    print(f'Using device: {device}')
    track_history = defaultdict(lambda: [])
    model=YOLO("r11.pt").to(device)

    #penghapusan data sebelumnya
    reset_all()

    #pengambilan jumlah ---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
    camera_data = get_camera_source()
    cd=camera_data[2]
    cd=int(cd)
    lokasi=[[] for _ in range(cd)]
    warna=[[] for _ in range(cd)]
    
    #---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
    
    #pegaturan pengambilan LOKASI RAX ---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
    
    fl=1
    index=0
    rax=get_rax()
    
    if rax:
        for row in rax:
            print(row)
            y_values=[]
            y_tuple=[]
            while (fl<=4):
                print(row[fl])
                      
                y_values_split = row[fl].split(',')
                y_values.append([int(value.strip()) for value in y_values_split])
                y_tuple.append(tuple(y_values[fl-1]))
                
                fl+=1
            fl=1
            warna[index]=row[5] 
            lokasi[index] = [y_tuple[0], y_tuple[1], y_tuple[2], y_tuple[3]]
            print(y_tuple[0]) 
            print(warna[0])
            index+=1
    
    
    #lokasi[0] = [(171,145), (385,145), (749,346), (328,370)]  
    #lokasi[1] = [(490, 103), (850, 243), (1100, 165), (700, 82)]
    pl=get_camera_source()
    #---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
    current_time = int(time.strftime('%S'))
    while True:
        success, img = cap.read()
        img = cv2.resize(img, (1000, 600))
        results=model.track(img,persist=True,tracker="bytetrack.yaml")
        
        batas=[[] for _ in range(2)]
        annotated_frame = results[0].plot()
        
        print(warna[0])
        

        if pl[3] != 0:
            for i in range(index):
                cv2.polylines(annotated_frame, [np.array(lokasi[i])], True, eval(warna[i]),3)
        #cv2.polylines(annotated_frame, [np.array(lokasi[1])], True, (0, 255, 0),3)

        
        print("panjang"+str(annotated_frame.shape[0]))

        boxes= 0
        track_ids=0

        boxes = results[0].boxes.xywh.cpu()
        
        try: 
            track_ids = results[0].boxes.id.int().cpu().tolist()

            for box, track_id in zip(boxes, track_ids):
                x, y, w, h = box
                x1 = x - (w / 2)
                y1 = y - (h / 2)
                x2 = x + (w / 2)
                y2 = y + (h / 2)

                x1=int(x1)
                y1=int(y1)
                x2=int(x2)
                y2=int(y2)

                track = track_history[track_id]
                for z in range(len(lokasi)):
                    dlb = is_inside_rectangle(lokasi[z], (x, y))
                    cur = mysql.connection.cursor() 
                    cur.execute("SELECT * FROM tb_realtime WHERE track_id = %s", (track_id,))
                    existing_row = cur.fetchone()
                    if existing_row:
                        print("Track ID sudah ada dalam database.")
                    else:
                        cur = mysql.connection.cursor()
                        cur.execute("INSERT INTO tb_realtime (track_id) VALUES (%s)", (track_id,))
                    
                        print("Track ID berhasil dimasukkan.")

                    print(str(dlb) + str(track_id)+ str(z))
                    if dlb == True:
                        cv2.rectangle(annotated_frame, (x1,y1), (x2,y2), eval(warna[z]),3)
                        
                        print(str(track_id)+"ditambah di" +str(z+1))
        
                        next_time = int(time.strftime('%S'))
                        if  next_time != current_time:  # Jika detik baru tidak sama dengan detik sebelumnya
                            print("sudah 1 detik")
                            current_time = next_time 
                            cur.execute("UPDATE tb_realtime SET location_%s = location_%s+1 WHERE track_id = %s", (z+1,z+1,track_id,))
                            mysql.connection.commit()
                      
                   
                    track.append((float(x), float(y)))  # x, y center point
                    if len(track) > 30:  # retain 90 tracks for 90 frames
                        track.pop(0)

                # Draw the tracking lines
                    points = np.hstack(track).astype(np.int32).reshape((-1, 1, 2))
                    cv2.polylines(annotated_frame, [points], isClosed=False, color=(230, 230, 230), thickness=10)
        
        except Exception as e:

            print("Terjadi kesalahan saat mengonversi track_ids:", e)

               
        yield annotated_frame
   

if __name__ == "__main__":
    app.run(debug=True)