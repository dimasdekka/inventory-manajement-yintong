# DOKUMENTASI LENGKAP DIAGRAM UML SISTEM INFORMASI INVENTORI PT YINTONG
(Standard Skripsi & Tugas Akhir - Format Terpisah per Card / Sub-Swimlane Tanpa Ikon)

---

# 1. USE CASE DIAGRAM (DIBAGI PER CARD / GROUP)

## A. Kode XML Draw.io (Bisa langsung di-import di draw.io / diagrams.net)
*(Buka draw.io ➔ Menu **Arrange** ➔ **Insert** ➔ **Advanced** ➔ **XML** ➔ Paste kode berikut)*:

```xml
<mxGraphModel dx="1600" dy="1000" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1654" pageHeight="2336" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- 1. BOUNDARY UTAMA SISTEM -->
    <mxCell id="boundary_sistem" value="" style="swimlane;startSize=0;swimlaneFillColor=default;fillColor=#FFFFFF;strokeColor=#1E293B;strokeWidth=2;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="380" y="100" width="860" height="1980" as="geometry" />
    </mxCell>
    <mxCell id="title_sistem" value="Sistem Informasi Inventori PT Yintong" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;rounded=0;fontStyle=1;fontFamily=Helvetica;fontSize=16;fontColor=#0F2942;" vertex="1" parent="boundary_sistem">
      <mxGeometry x="250" y="20" width="360" height="30" as="geometry" />
    </mxCell>

    <!-- CARD 1: OTENTIKASI AKUN -->
    <mxCell id="card_auth" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#94A3B8;strokeWidth=1.5;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="460" y="180" width="700" height="180" as="geometry" />
    </mxCell>
    <mxCell id="title_auth" value="Otentikasi Akun" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;fontColor=#0F2942;" vertex="1" parent="1">
      <mxGeometry x="720" y="190" width="180" height="25" as="geometry" />
    </mxCell>
    <mxCell id="uc_login" value="Login" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="540" y="240" width="150" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_logout" value="Logout" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="930" y="240" width="150" height="65" as="geometry" />
    </mxCell>

    <!-- CARD 2: DATA MASTER & KONFIGURASI -->
    <mxCell id="card_master" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#94A3B8;strokeWidth=1.5;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="460" y="400" width="700" height="360" as="geometry" />
    </mxCell>
    <mxCell id="title_master" value="Data Master &amp; Konfigurasi" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;fontColor=#0F2942;" vertex="1" parent="1">
      <mxGeometry x="700" y="410" width="220" height="25" as="geometry" />
    </mxCell>
    <mxCell id="uc_barang" value="Kelola Data Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="460" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_kategori" value="Kelola Kategori Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="730" y="460" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_golongan" value="Kelola Golongan Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="950" y="460" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_supplier" value="Kelola Data Supplier" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="610" y="560" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_stok_min" value="Setting Stok Minimum" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="850" y="560" width="160" height="65" as="geometry" />
    </mxCell>

    <!-- CARD 3: TRANSAKSI & OPERASIONAL -->
    <mxCell id="card_trx" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#94A3B8;strokeWidth=1.5;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="460" y="800" width="700" height="490" as="geometry" />
    </mxCell>
    <mxCell id="title_trx" value="Transaksi &amp; Operasional" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;fontColor=#0F2942;" vertex="1" parent="1">
      <mxGeometry x="705" y="810" width="210" height="25" as="geometry" />
    </mxCell>
    <mxCell id="uc_in" value="Input Barang Masuk" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="860" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_out" value="Input Barang Keluar" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="945" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_mutasi" value="Mutasi Lokasi &amp; PIC" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="1030" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_scan" value="Scan QR Code / Barcode" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="940" y="945" width="170" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_pinjam" value="Catat Peminjaman" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="1120" width="160" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_kembali" value="Catat Pengembalian" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="720" y="1120" width="160" height="65" as="geometry" />
    </mxCell>

    <!-- Include Edges for Scan QR -->
    <mxCell id="inc_1" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="uc_in" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="inc_2" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="uc_out" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="inc_3" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="uc_mutasi" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- CARD 4: LAPORAN & MONITORING -->
    <mxCell id="card_report" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#94A3B8;strokeWidth=1.5;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="460" y="1330" width="700" height="280" as="geometry" />
    </mxCell>
    <mxCell id="title_report" value="Laporan &amp; Monitoring" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;fontColor=#0F2942;" vertex="1" parent="1">
      <mxGeometry x="715" y="1340" width="190" height="25" as="geometry" />
    </mxCell>
    <mxCell id="uc_dashboard" value="Lihat Dashboard &amp; Grafik" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="500" y="1400" width="170" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_notif" value="Monitoring Alert Stok" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="730" y="1400" width="170" height="65" as="geometry" />
    </mxCell>
    <mxCell id="uc_laporan" value="Cetak Laporan (PDF/Excel)" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="950" y="1400" width="170" height="65" as="geometry" />
    </mxCell>

    <!-- CARD 5: MANAJEMEN PENGGUNA -->
    <mxCell id="card_user" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#94A3B8;strokeWidth=1.5;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="460" y="1650" width="700" height="180" as="geometry" />
    </mxCell>
    <mxCell id="title_user" value="Manajemen Pengguna" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;fontColor=#0F2942;" vertex="1" parent="1">
      <mxGeometry x="715" y="1660" width="190" height="25" as="geometry" />
    </mxCell>
    <mxCell id="uc_users" value="Kelola Data User &amp; Role" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;fontStyle=1;fontSize=12;" vertex="1" parent="1">
      <mxGeometry x="720" y="1710" width="180" height="65" as="geometry" />
    </mxCell>

    <!-- ACTORS -->
    <mxCell id="act_staff" value="Staff Gudang&#xa;(Rani)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="150" y="480" width="80" height="150" as="geometry" />
    </mxCell>
    <mxCell id="act_admin" value="Administrator&#xa;(Nurul Faoziah)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="150" y="1150" width="80" height="150" as="geometry" />
    </mxCell>
    <mxCell id="act_pimpinan" value="Pimpinan&#xa;(Pak Hermawan)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="1390" y="900" width="80" height="150" as="geometry" />
    </mxCell>

    <!-- ASOSIASI STAFF GUDANG -->
    <mxCell id="e_s1" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s2" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s3" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_barang"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s4" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_in"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s5" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_out"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s6" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_mutasi"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s7" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_pinjam"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s8" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_kembali"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- ASOSIASI ADMINISTRATOR -->
    <mxCell id="e_a1" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a2" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a3" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_barang"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a4" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_kategori"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a5" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_golongan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a6" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_supplier"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a7" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_stok_min"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a8" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_in"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a9" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_out"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a10" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_mutasi"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a11" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_pinjam"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a12" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_kembali"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a13" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_dashboard"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a14" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_notif"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a15" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_laporan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a16" style="endArrow=none;html=1;strokeWidth=2;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_users"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- ASOSIASI PIMPINAN -->
    <mxCell id="e_p1" style="endArrow=none;html=1;strokeWidth=2;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p2" style="endArrow=none;html=1;strokeWidth=2;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p3" style="endArrow=none;html=1;strokeWidth=2;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_dashboard"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p4" style="endArrow=none;html=1;strokeWidth=2;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_notif"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p5" style="endArrow=none;html=1;strokeWidth=2;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_laporan"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```

---

## B. Use Case Diagram (Format Mermaid dengan Subgraph Card)

```mermaid
flowchart LR
    Admin[Administrator]
    Staff[Staff Gudang]
    Pimpinan[Pimpinan]

    subgraph Boundary ["SISTEM INFORMASI INVENTORI PT YINTONG"]
        
        subgraph Card_Auth ["Card: Otentikasi Akun"]
            UC_Login(Login)
            UC_Logout(Logout)
        end

        subgraph Card_Master ["Card: Data Master dan Konfigurasi"]
            UC_Barang(Kelola Data Barang)
            UC_Kategori(Kelola Kategori Barang)
            UC_Golongan(Kelola Golongan Barang)
            UC_Supplier(Kelola Data Supplier)
            UC_StokMin(Setting Stok Minimum)
        end

        subgraph Card_Trx ["Card: Transaksi dan Operasional"]
            UC_Masuk(Input Barang Masuk)
            UC_Keluar(Input Barang Keluar)
            UC_Mutasi(Mutasi Lokasi dan PIC)
            UC_Pinjam(Catat Peminjaman)
            UC_Kembali(Catat Pengembalian)
            UC_Scan(Scan QR Code / Barcode)
        end

        subgraph Card_Report ["Card: Laporan dan Monitoring"]
            UC_Dashboard(Lihat Dashboard dan Grafik)
            UC_Notif(Monitoring Alert Stok Kritis)
            UC_Laporan(Cetak Laporan PDF / Excel)
        end

        subgraph Card_User ["Card: Manajemen Pengguna"]
            UC_User(Kelola Data User dan Role)
        end

    end

    %% Include Relations
    UC_Masuk -.->|<<include>>| UC_Scan
    UC_Keluar -.->|<<include>>| UC_Scan
    UC_Mutasi -.->|<<include>>| UC_Scan

    %% Staff Relations
    Staff --- UC_Login
    Staff --- UC_Logout
    Staff --- UC_Barang
    Staff --- UC_Masuk
    Staff --- UC_Keluar
    Staff --- UC_Mutasi
    Staff --- UC_Pinjam
    Staff --- UC_Kembali

    %% Admin Relations
    Admin --- UC_Login
    Admin --- UC_Logout
    Admin --- UC_Barang
    Admin --- UC_Kategori
    Admin --- UC_Golongan
    Admin --- UC_Supplier
    Admin --- UC_StokMin
    Admin --- UC_Masuk
    Admin --- UC_Keluar
    Admin --- UC_Mutasi
    Admin --- UC_Pinjam
    Admin --- UC_Kembali
    Admin --- UC_Dashboard
    Admin --- UC_Notif
    Admin --- UC_Laporan
    Admin --- UC_User

    %% Pimpinan Relations
    Pimpinan --- UC_Login
    Pimpinan --- UC_Logout
    Pimpinan --- UC_Dashboard
    Pimpinan --- UC_Notif
    Pimpinan --- UC_Laporan
```

---

# 2. 5 ACTIVITY DIAGRAM (SWIMLANE USER VS SYSTEM)

### 1. Activity Diagram: Login & Autentikasi Pengguna
```mermaid
flowchart TD
    subgraph User [User / Pengguna]
        Start1([Mulai]) --> U1[Buka Halaman Login]
        U1 --> U2[Input Email dan Password lalu Klik Masuk]
        U3[Terima Pesan Peringatan dan Ulangi Input] --> U2
        U4[Masuk ke Dashboard Sesuai Role] --> End1([Selesai])
    end

    subgraph System [System / Sistem]
        U2 --> S1{Verifikasi Kredensial dan Status Aktif?}
        S1 -- Tidak Valid --> S2[Kirim Pesan Error Email atau Password Salah]
        S2 --> U3
        S1 -- Valid --> S3[Buat Sesi Login dan Siapkan Hak Akses Menu]
        S3 --> U4
    end
```

---

### 2. Activity Diagram: Pendaftaran Barang Baru & Pemetaan Golongan
```mermaid
flowchart TD
    subgraph User [User / Admin & Staff]
        Start2([Mulai]) --> U2_1[Buka Menu Data Barang dan Klik Tambah Barang]
        U2_1 --> U2_2[Pilih Kategori Barang]
        U2_3[Pilih Golongan Barang dan Lengkapi Form Input] --> U2_4[Klik Tombol Simpan]
        U2_5[Lihat Barang Baru dan QR Code pada Katalog] --> End2([Selesai])
    end

    subgraph System [System / Sistem]
        U2_2 --> S2_1[Filter dan Muat Daftar Golongan Sesuai Kategori]
        S2_1 --> S2_2[Tampilkan Live Preview Kode Barang Hierarkis]
        S2_2 --> U2_3
        U2_4 --> S2_3{Validasi Kelengkapan Data?}
        S2_3 -- Tidak Valid --> U2_3
        S2_3 -- Valid --> S2_4[Generate Kode Hierarkis, Cetak QR Code SVG, dan Simpan ke DB]
        S2_4 --> U2_5
    end
```

---

### 3. Activity Diagram: Mutasi Lokasi & PIC Barang (Scan QR / Auto-fill)
```mermaid
flowchart TD
    subgraph User [User / Staff & Admin]
        Start3([Mulai]) --> U3_1[Buka Menu Mutasi dan Klik Mutasikan Barang]
        U3_1 --> U3_2[Pilih Barang Manual / Scan QR Kamera]
        U3_3[Isi Jumlah Mutasi dan Lokasi Baru] --> U3_4[Klik Simpan Transaksi Mutasi]
        U3_5[Melihat Riwayat Mutasi Terbaru] --> End3([Selesai])
    end

    subgraph System [System / Sistem]
        U3_2 --> S3_1[Auto-fill Lokasi Asal, PIC Asal, Stok, dan Catatan]
        S3_1 --> U3_3
        U3_4 --> S3_2{Validasi Jumlah <= Stok Tersedia?}
        S3_2 -- Melebihi Stok --> S3_3[Tampilkan Pesan Peringatan Stok Kurang]
        S3_3 --> U3_3
        S3_2 -- Cukup --> S3_4[Catat Mutasi dan Perbarui Lokasi/PIC Master Barang]
        S3_4 --> U3_5
    end
```

---

### 4. Activity Diagram: Peminjaman & Pengembalian Barang Inventaris
```mermaid
flowchart TD
    subgraph User [User / Staff & Admin]
        Start4([Mulai]) --> U4_Dec{Pilihan Transaksi?}
        U4_Dec -- Peminjaman --> U4_P1[Input Barang, Peminjam, dan Tgl Kembali]
        U4_P1 --> U4_P2[Klik Simpan Pinjam]
        U4_Dec -- Pengembalian --> U4_K1[Pilih Transaksi Aktif dan Klik Kembalikan]
        U4_K1 --> U4_K2[Input Tgl Kembali, Kondisi, dan Simpan]
        End4([Selesai])
    end

    subgraph System [System / Sistem]
        U4_P2 --> S4_Dec{Cek Ketersediaan Stok?}
        S4_Dec -- Stok Kurang --> U4_P1
        S4_Dec -- Stok Cukup --> S4_P1[Catat Peminjaman, Status Dipinjam, dan Kurangi Stok]
        S4_P1 --> End4
        U4_K2 --> S4_K1[Catat Pengembalian, Update Status Dikembalikan, dan Tambah Stok]
        S4_K1 --> End4
    end
```

---

### 5. Activity Diagram: Monitoring Stok & Cetak Laporan (PDF / Excel)
```mermaid
flowchart TD
    subgraph User [User / Pimpinan & Admin]
        Start5([Mulai]) --> U5_1[Buka Menu Laporan Inventori]
        U5_1 --> U5_2[Pilih Jenis Laporan dan Tentukan Filter]
        U5_2 --> U5_3[Klik Tombol Tampilkan / Filter]
        U5_4[Melihat Pratinjau Tabel dan Klik Cetak PDF / Excel]
        U5_5[Menerima Unduhan File Laporan Resmi] --> End5([Selesai])
    end

    subgraph System [System / Sistem]
        U5_3 --> S5_1[Query Database Sesuai Filter dan Sajikan Tabel Pratinjau]
        S5_1 --> U5_4
        U5_4 --> S5_2[Render Dokumen Ber-Kop Surat dan Kirim File Stream Download]
        S5_2 --> U5_5
    end
```

---

# 3. 5 SEQUENCE DIAGRAM (SISI TEKNIS & ARSITEKTUR)

### 1. Sequence Diagram: Autentikasi Pengguna (Login Sequence)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengguna
    participant View as View: auth/login.blade.php
    participant Ctrl as AuthController
    participant Limiter as RateLimiter
    participant AuthFacade as Auth Facade
    participant UserModel as Model: User
    participant DB as Database

    User->>View: 1. Masukkan Email dan Password, klik Submit
    View->>Ctrl: 2. POST /login (email, password)
    
    Ctrl->>Limiter: 3. tooManyAttempts(throttleKey, 5)
    alt Rate Limit Terlampaui (>= 5x gagal)
        Limiter-->>Ctrl: true
        Ctrl-->>View: 4a. Throw ValidationException (Throttle Error)
        View-->>User: 5a. Tampilkan error: Terlalu banyak percobaan login
    else Rate Limit Aman
        Limiter-->>Ctrl: false
        Ctrl->>AuthFacade: 6. attempt(credentials, remember)
        AuthFacade->>UserModel: 7. where(email)->first()
        UserModel->>DB: 8. SELECT * FROM users WHERE email = ?
        DB-->>UserModel: 9. Record User Data dan Password Hash
        UserModel-->>AuthFacade: 10. User Object
        
        alt Kredensial Salah
            AuthFacade-->>Ctrl: false
            Ctrl->>Limiter: 11a. hit(throttleKey, 60s)
            Ctrl-->>View: 12a. Redirect back with Error: Email atau password salah
            View-->>User: 13a. Tampilkan pesan kesalahan login
        else Kredensial Benar
            AuthFacade-->>Ctrl: true (Authenticated User)
            
            alt Status Non-Aktif
                Ctrl->>AuthFacade: 14a. logout()
                Ctrl-->>View: 15a. Error: Akun tidak aktif
            else Status Aktif
                Ctrl->>Limiter: 14b. clear(throttleKey)
                Ctrl->>Ctrl: 15b. session()->regenerate()
                Ctrl-->>View: 16b. Redirect to /dashboard
                View-->>User: 17b. Render Dashboard Layout sesuai Role
            end
        end
    end
```

---

### 2. Sequence Diagram: Pendaftaran Barang Baru (Store Barang Sequence)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator / Staff
    participant View as View: barang/create.blade.php
    participant Req as StoreBarangRequest
    participant Ctrl as BarangController
    participant SvcBarang as BarangService
    participant SvcBarcode as BarcodeService
    participant ModelBarang as Model: Barang
    participant DB as Database

    Admin->>View: 1. Input Data Barang (Kategori_id, Golongan_id, Nama, Harga, dll)
    View->>Req: 2. POST /barang (Form Data)
    Req->>Req: 3. Validasi Rules dan Authorization
    Req-->>Ctrl: 4. validated() Form Data

    Ctrl->>SvcBarang: 5. generateKodeBarang(kategoriId, golonganId)
    SvcBarang->>DB: 6. SELECT kode_barang FROM barang WHERE kode LIKE 'ATK-BKU-%' ORDER BY kode DESC LIMIT 1
    DB-->>SvcBarang: 7. Last Kode (contoh: ATK-BKU-202609-0001)
    SvcBarang-->>Ctrl: 8. Generated New Kode (contoh: ATK-BKU-202609-0002)

    Ctrl->>SvcBarcode: 9. generateQRCode(kodeBarang)
    SvcBarcode->>SvcBarcode: 10. Render SVG QR Code dan simpan ke storage/app/public/barcodes/
    SvcBarcode-->>Ctrl: 11. barcode_path ('barcodes/qrcode_ATK-BKU-202609-0002.svg')

    Ctrl->>ModelBarang: 12. create(data + kode_barang + barcode_path + initial_stok=0)
    ModelBarang->>DB: 13. INSERT INTO barang (...) VALUES (...)
    DB-->>ModelBarang: 14. Inserted Record ID
    ModelBarang-->>Ctrl: 15. Barang Instance
    
    Ctrl-->>View: 16. Redirect to route('barang.index') with Success Flash Message
    View-->>Admin: 17. Tampilkan Katalog Barang dengan Badge Golongan dan QR Code
```

---

### 3. Sequence Diagram: Mutasi Lokasi dan PIC Barang (Store Mutasi Sequence)
```mermaid
sequenceDiagram
    autonumber
    actor User as Staff Gudang / Admin
    participant View as View: mutasi/create.blade.php
    participant Req as StoreMutasiRequest
    participant Ctrl as MutasiController
    participant Svc as BarangService
    participant ModelBarang as Model: Barang
    participant ModelMutasi as Model: MutasiBarang
    participant DB as Database

    User->>View: 1. Scan QR / Pilih Barang, Isi Lokasi Tujuan dan PIC Baru
    View->>Req: 2. POST /mutasi (barang_id, jumlah, lokasi_tujuan, pic_tujuan, tanggal, keterangan)
    Req->>Req: 3. Validasi Form Input
    Req-->>Ctrl: 4. validated() Data

    Ctrl->>Svc: 5. tambahMutasi(data, auth_user_id)
    
    activate Svc
    Svc->>DB: 6. DB::beginTransaction()
    Svc->>ModelBarang: 7. findOrFail(barang_id)
    ModelBarang->>DB: 8. SELECT * FROM barang WHERE id = ?
    DB-->>ModelBarang: 9. Data Barang (lokasi_penyimpanan, pic, jumlah)
    ModelBarang-->>Svc: 10. Barang Object

    alt Jumlah Mutasi > Stok Tersedia
        Svc-->>Ctrl: 11a. Throw ValidationException: Stok tidak mencukupi
        Svc->>DB: 12a. DB::rollBack()
        Ctrl-->>View: 13a. Redirect back with Errors
        View-->>User: 14a. Munculkan pesan peringatan di form
    else Stok Cukup
        Svc->>Svc: 11b. generateNoTransaksi('MUT', 'mutasi_barang')
        Svc->>ModelMutasi: 12b. create(no_transaksi, lokasi_asal, lokasi_tujuan, pic_asal, pic_tujuan, ...)
        ModelMutasi->>DB: 13b. INSERT INTO mutasi_barang (...) VALUES (...)
        
        Svc->>ModelBarang: 14b. Update Lokasi dan PIC baru (barang->lokasi = lokasi_tujuan, barang->pic = pic_tujuan)
        ModelBarang->>DB: 15b. UPDATE barang SET lokasi_penyimpanan = ?, pic = ? WHERE id = ?
        
        Svc->>DB: 16b. DB::commit()
        deactivate Svc
        Svc-->>Ctrl: 17b. MutasiBarang Instance
        Ctrl-->>View: 18b. Redirect to route('mutasi.index') with Success Message
        View-->>User: 19b. Tampilkan tabel riwayat mutasi terbaru
    end
```

---

### 4. Sequence Diagram: Siklus Peminjaman dan Pengembalian Barang
```mermaid
sequenceDiagram
    autonumber
    actor User as Staff Gudang / Admin
    participant ViewPinjam as View: peminjaman/index.blade.php
    participant CtrlPinjam as PeminjamanController
    participant CtrlKembali as PengembalianController
    participant Svc as BarangService
    participant ModelPinjam as Model: Peminjaman
    participant ModelKembali as Model: Pengembalian
    participant ModelBarang as Model: Barang
    participant DB as Database

    %% Tahap Peminjaman
    Note over User, DB: SIKLUS 1: PROSES PEMINJAMAN BARANG
    User->>CtrlPinjam: 1. POST /peminjaman (barang_id, peminjam_id, jumlah, tanggal_rencana_kembali)
    CtrlPinjam->>Svc: 2. tambahPeminjaman(data, auth_user_id)
    Svc->>DB: 3. DB::transaction()
    Svc->>ModelBarang: 4. findOrFail(barang_id) dan Cek Stok
    Svc->>ModelPinjam: 5. create(no_peminjaman, status='dipinjam', ...)
    ModelPinjam->>DB: 6. INSERT INTO peminjaman
    Svc->>ModelBarang: 7. Kurangi Stok (barang->jumlah -= jumlah)
    ModelBarang->>DB: 8. UPDATE barang SET jumlah = ?
    Svc-->>CtrlPinjam: 9. Peminjaman Object
    CtrlPinjam-->>ViewPinjam: 10. Refresh Daftar Status 'Dipinjam'

    %% Tahap Pengembalian
    Note over User, DB: SIKLUS 2: PROSES PENGEMBALIAN BARANG
    User->>CtrlKembali: 11. POST /pengembalian (peminjaman_id, tanggal_kembali, kondisi_kembali)
    CtrlKembali->>Svc: 12. tambahPengembalian(data, auth_user_id)
    Svc->>DB: 13. DB::transaction()
    Svc->>ModelKembali: 14. create(no_pengembalian, tanggal_kembali, kondisi_kembali, ...)
    ModelKembali->>DB: 15. INSERT INTO pengembalian
    Svc->>ModelPinjam: 16. Update Status (peminjaman->status = 'dikembalikan')
    ModelPinjam->>DB: 17. UPDATE peminjaman SET status = 'dikembalikan'
    Svc->>ModelBarang: 18. Tambah Stok Kembali (barang->jumlah += jumlah)
    ModelBarang->>DB: 19. UPDATE barang SET jumlah = ?
    Svc-->>CtrlKembali: 20. Pengembalian Object
    CtrlKembali-->>ViewPinjam: 21. Refresh View: Status Peminjaman menjadi 'Dikembalikan'
    ViewPinjam-->>User: 22. Tampilkan status Dikembalikan dan stok bertambah kembali
```

---

### 5. Sequence Diagram: Ekspor Laporan Inventori (PDF dan Excel)
```mermaid
sequenceDiagram
    autonumber
    actor Pimpinan as Pimpinan / Admin
    participant View as View: laporan/index.blade.php
    participant Ctrl as LaporanController
    participant Svc as LaporanService
    participant DomPDF as Barryvdh\DomPDF\PDF
    participant DB as Database

    Pimpinan->>View: 1. Pilih Jenis Laporan ('stok' / 'mutasi' / 'barang_masuk') dan Filter Tanggal
    Pimpinan->>View: 2. Klik tombol Cetak PDF
    View->>Ctrl: 3. GET /laporan/export-pdf (jenis_laporan, filters...)

    Ctrl->>Svc: 4. getData(filters)
    activate Svc
    Svc->>DB: 5. Query Builder: SELECT barang.*, kategori.nama_kategori, golongan.nama_golongan FROM barang ...
    DB-->>Svc: 6. Collection Data Aset dan Riwayat
    Svc-->>Ctrl: 7. Filtered Collection Data
    deactivate Svc

    Ctrl->>Svc: 8. generatePdf(jenisLaporan, data, filters)
    activate Svc
    Svc->>DomPDF: 9. Pdf::loadView('laporan.pdf', compact('data', 'filters', 'summary'))
    DomPDF->>DomPDF: 10. Render Blade HTML dengan CSS Tema Navy, Format Kop Surat dan Tanda Tangan
    DomPDF->>DomPDF: 11. Convert HTML DOM to PDF Stream Paper A4 / Landscape
    DomPDF-->>Svc: 12. PDF Binary Object
    Svc-->>Ctrl: 13. PDF Instance
    deactivate Svc

    Ctrl-->>View: 14. return $pdf->download('laporan_stok_20260910.pdf')
    View-->>Pimpinan: 15. Browser mengunduh file PDF resmi Laporan Inventori
```
