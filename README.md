# TP8DPBO2025C1

# Janji
Saya Muhammad Ichsan Khairullah dengan NIM 2306924 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
Program ini menggunakan arsitektur MVC (Model-View-Controller) dengan struktur:
```mermaid
classDiagram
    class Database {
        -conn
        +getConnection()
    }
    
    class Model {
        <<abstract>>
        #conn
        #table
        +__construct(db)
        +getAll()
        +getById()
        +create()
        +update()
        +delete()
    }

    class View {
        <<interface>>
        +render()
    }

    class Controller {
        <<abstract>>
        #model
        +__construct(db)
        +index()
        +create()
        +edit()
        +delete()
    }

    %% Models
    class ProdiModel {
        +id
        +kode
        +nama
        +deskripsi
    }

    class MatkulModel {
        +id
        +kode
        +nama
        +sks
        +id_prodi
    }

    class MahasiswaModel {
        +id
        +nim
        +nama
        +telepon
        +tanggal_masuk
        +id_prodi
    }

    %% Controllers
    class ProdiController {
        -prodiModel
        -matkulModel
        +index()
        +create()
        +edit()
        +delete()
    }

    class MatkulController {
        -matkulModel
        -prodiModel
        -matkulMahasiswaModel
        +index()
        +create()
        +edit()
        +delete()
    }

    class MahasiswaController {
        -mahasiswaModel
        -prodiModel
        -matkulModel
        -matkulMahasiswaModel
        +index()
        +create()
        +edit()
        +delete()
        +viewMatkul()
        +enrollMatkul()
        +unenrollMatkul()
    }

    %% Relationships
    Database <-- Model
    Model <|-- ProdiModel
    Model <|-- MatkulModel
    Model <|-- MahasiswaModel
    
    Controller <|-- ProdiController
    Controller <|-- MatkulController
    Controller <|-- MahasiswaController
    
    Controller --> Model : uses
    Controller --> View : renders

    ProdiController --> ProdiModel : manages
    MatkulController --> MatkulModel : manages
    MahasiswaController --> MahasiswaModel : manages
```

# Struktur Database
```mermaid
erDiagram
    prodi {
        int id PK
        string kode
        string nama
        string deskripsi
    }
    
    matkul {
        int id PK
        string kode
        string nama
        int sks
        int id_prodi FK
    }
    
    mahasiswa {
        int id PK
        string nim
        string nama
        string telepon
        date tanggal_masuk
        int id_prodi FK
    }
    
    matkul_mahasiswa {
        int id_mahasiswa FK
        int id_matkul FK
        int nilai
    }

    prodi ||--o{ matkul : memiliki
    prodi ||--o{ mahasiswa : memiliki
    mahasiswa ||--o{ matkul_mahasiswa : mengambil
    matkul ||--o{ matkul_mahasiswa : diambil_oleh
```

# Alur Program
```mermaid
flowchart TD
    A[Client Request] --> B[index.php]
    B --> C[Load Config & Models]
    C --> D[Load Controllers]
    D --> E[Initialize Database]
    
    E --> F{Get Controller}
    F -->|mahasiswa| G[MahasiswaController]
    F -->|prodi| H[ProdiController]
    F -->|matkul| I[MatkulController]
    
    G & H & I --> J{Get Action}
    J -->|index| K[Load Data from Model]
    J -->|create| L[Show Create Form]
    J -->|edit| M[Show Edit Form]
    J -->|delete| N[Delete Data]
    J -->|viewMatkul| O[Show Enrolled Courses]
    J -->|enrollMatkul| P[Enroll in Course]
    J -->|unenrollMatkul| Q[Unenroll from Course]
    
    K --> R[Load View]
    L --> S[Process Form Data]
    M --> T[Update Data]
    N --> U[Check Dependencies]
    O & P & Q --> V[Redirect]
    
    S & T & U --> W{Success?}
    W -->|Yes| V
    W -->|No| X[Show Error]
    
    V --> Y[Display Result]
    X --> Y
```

# Fitur Utama & Relasi
1. Program Studi (Prodi)
- Entitas dasar yang dibutuhkan entitas lain
- Memiliki banyak Matkul dan Mahasiswa
- Tidak bisa dihapus jika masih ada Matkul terkait

2. Mata Kuliah (Matkul)
- Terhubung ke satu Prodi
- Bisa diambil oleh banyak Mahasiswa
- Tidak bisa dihapus jika masih ada mahasiswa yang mengambil

3. Mahasiswa
- Terdaftar di satu Prodi
- Bisa mengambil banyak Matkul
- Nilai disimpan di tabel matkul_mahasiswa

# Contoh Alur Request
Untuk request "lihat semua mahasiswa":
1. Browser akses index.php?controller=mahasiswa&action=index
2. index.php memuat file yang diperlukan dan membuat MahasiswaController
3. Memanggil method index() pada controller
4. Controller menggunakan MahasiswaModel untuk mengambil data
5. Data diteruskan ke view (views/mahasiswa/index.php)
6. View menampilkan HTML dengan data tersebut

# Fitur Keamanan
1. Database menggunakan PDO dengan prepared statements
2. Validasi input pada form
3. Constraint foreign key mencegah data yang tidak valid
4. Pengelolaan session untuk sistem autentikasi (jika diperlukan)

# Dokumentasi
![2025-05-05 08-35-03 (1)](https://github.com/user-attachments/assets/a272556e-df61-4460-97d2-e59f61802aa0)
