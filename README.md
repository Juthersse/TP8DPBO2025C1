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
