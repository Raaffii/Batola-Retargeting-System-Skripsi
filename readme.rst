###################
What is Retargeting
###################

Retargeting sendiri merupakan sebuah pola yang banyak digunakan dalam dunia e-commerce, yang bertujuan untuk memasarkan barang atau produk kepada pelanggan yang telah menunjukkan indikasi ketertarikan namun belum melakukan proses pembelian. Strategi ini memanfaatkan data dan perilaku pengunjung yang sebelumnya telah berinteraksi dengan situs atau aplikasi, seperti mengunjungi halaman produk tertentu, menambahkan barang ke keranjang belanja, atau bahkan menghabiskan waktu di situs tanpa menyelesaikan transaksi. Dengan pendekatan ini, e-commerce dapat secara efektif mengingatkan dan menarik kembali perhatian pelanggan, mendorong mereka untuk melanjutkan proses pembelian yang sebelumnya terhenti, dan pada akhirnya meningkatkan konversi serta penjualan secara keseluruhan.

*******************
The Goal
*******************

Menerapkan Sistem Retargeting Untuk toko OFFLINE

**************************
Prequisite
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Instalation
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

1. **Clone repository:**

Gunakan perintah berikut untuk meng-clone proyek:

```bash


```bash
git clone https://github.com/username/Batola-Retargeting-System-Skripsi.git
```
## 🔧 Installation and Setup

### Prerequisites

Before setting up this project, ensure that you have the following installed:

- Python 3.8+
- Pip package manager
- Git

### Clone the Repository

```bash
git clone https://github.com/your-username/KTP-Data-Extractor.git
cd KTP-Data-Extractor
```

### Install Dependencies

You can install the required dependencies using the following command:

```bash
pip install -r requirements.txt
```

### Install PyTorch (GPU support, optional)

If you have a GPU and want to speed up inference, install PyTorch with CUDA support:

```bash
pip install torch torchvision torchaudio --index-url https://download.pytorch.org/whl/cu118
```

### Download Pre-trained Models

The application requires several pre-trained models. Download or place the following models in the project directory:

1. **YOLO Segmentation Model** (`segment_model.pt`)
2. **YOLO OBB Model** (`obb_model.pt`)
3. **Donut🍩 Processor and Model** (`donut_ktp_processor` and `donut_ktp_model`)

Place these models in the correct paths as indicated in the `app.py` file or the `models.py` module.

---

## 🚀 Running the Application

Once everything is set up, you can run the Streamlit app using the following command:

```bash
streamlit run app.py
```

This will start a local server. Open your browser and navigate to:

```
http://localhost:8501
```

### Usage

1. **Upload Image**: Upload an image containing a KTP.
2. **Retrieve Data**: Click on the `Retrieve` button to extract and display data from the KTP.
3. **View Results**: The KTP image will be processed, displayed, and extracted information will be shown below the image.

---

## 🎯 How It Works

### 1. **KTP Detection**:
   - The uploaded image is processed by a **YOLOv8 segmentation model** that detects the KTP card within the image.
   - An **Oriented Bounding Box (OBB)** is calculated to determine the correct perspective.

### 2. **Perspective Transformation**:
   - Using OpenCV, the detected KTP card is wrapped and aligned into a fixed-size rectangular image for easier text extraction.

### 3. **Document Parsing**:
   - The aligned KTP image is passed to the **Donut VisionEncoderDecoderModel**, which extracts key text fields such as the NIK, Gender, and Religion.
   
### 4. **Display Results**:
   - The processed KTP image and its extracted text data are displayed in a user-friendly format on the Streamlit interface.

---

## 🎉 Live Demo
Experience the KTP Data Extractor without any setup! Check out the live demo:

👉 [KTP Data Extractor Live Demo](https://ktp-data-extractor.streamlit.app) 👈

Simply visit the link, upload your KTP image, and see the extraction process in action.

---

## 📂 Project Structure

```bash
project/
│
├── models.py         # Contains functions to load models
├── detection.py      # Detection and segmentation utilities
├── prediction.py     # Functions to handle image wrapping and prediction
├── app.py            # Streamlit web app
├── requirements.txt  # Python dependencies
└── README.md         # Project README file
```

---

## 💡 Future Improvements

Some ideas for enhancing this project in the future:

1. **Batch Processing**: Enable batch processing for multiple KTP images at once.
2. **Enhanced Detection**: Optimize KTP detection for more precise wrapping and alignment, ensuring better accuracy and presentation.
3. **Model Improvements**: Fine-tune models for more accurate detection and text extraction.
4. **Mobile Deployment**: Create a mobile version for easier KTP extraction on-the-go.
5. **Expanded Data Extraction**: Enhance the project to extract additional key information from the KTP, such as name, address, date of birth, and other important details, providing a more comprehensive data extraction solution.

---
## 🤝 Contributing

We welcome contributions! If you want to contribute to the project:

1. Fork this repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Submit a pull request.

---

## 📜 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## 📞 Contact

For any questions or issues, feel free to reach out:

- **Name**: Fahrul Firmansyah
- **Email**: ffirmansyah3576@gmail.com
- **LinkedIn**: [Fahrul Firmansyah](https://www.linkedin.com/in/fahrul-firmansyah-5a1b34237)
*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Contributing Guide <https://github.com/bcit-ci/CodeIgniter/blob/develop/contributing.md>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
