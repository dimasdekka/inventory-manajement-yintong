# DOKUMENTASI DIAGRAM UML SISTEM INFORMASI INVENTORI PT YINTONG
(Standard Skripsi & Tugas Akhir - Format Bersih Tanpa Ikon)

Dokumen ini berisi:
1. XML Draw.io Use Case Diagram (Siap di-copy-paste langsung ke draw.io / diagrams.net)
2. Use Case Diagram (Mermaid Standar)
3. 5 Activity Diagram (Sisi User / Alur Bisnis Non-Teknis)
4. 5 Sequence Diagram (Sisi Teknis & Arsitektur Sistem)

---

# 1. USE CASE DIAGRAM

## A. Kode XML Draw.io (Bisa langsung di-import di Draw.io)
```xml
<mxGraphModel dx="1422" dy="794" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1654" pageHeight="2336" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- Boundary Sistem Utama -->
    <mxCell id="system_box" value="" style="swimlane;startSize=0;fillColor=#FFFFFF;strokeColor=#333333;strokeWidth=2;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="380" y="100" width="880" height="1520" as="geometry" />
    </mxCell>
    <mxCell id="system_title" value="Sistem Informasi Inventori PT Yintong" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=16;fontFamily=Helvetica;" vertex="1" parent="system_box">
      <mxGeometry x="240" y="20" width="400" height="30" as="geometry" />
    </mxCell>

    <!-- Group 1: Otentikasi Akun -->
    <mxCell id="grp_auth" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="80" width="800" height="180" as="geometry" />
    </mxCell>
    <mxCell id="title_auth" value="Otentikasi Akun" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_auth">
      <mxGeometry x="20" y="10" width="150" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_login" value="Login" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_auth">
      <mxGeometry x="220" y="50" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_logout" value="Logout" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_auth">
      <mxGeometry x="440" y="50" width="140" height="70" as="geometry" />
    </mxCell>

    <!-- Group 2: Data Master & Konfigurasi -->
    <mxCell id="grp_master" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="290" width="800" height="280" as="geometry" />
    </mxCell>
    <mxCell id="title_master" value="Data Master &amp; Konfigurasi" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_master">
      <mxGeometry x="20" y="10" width="200" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_barang" value="Kelola Data Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_master">
      <mxGeometry x="120" y="50" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_kategori" value="Kelola Kategori Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_master">
      <mxGeometry x="330" y="50" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_golongan" value="Kelola Golongan Barang" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_master">
      <mxGeometry x="540" y="50" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_supplier" value="Kelola Data Supplier" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_master">
      <mxGeometry x="220" y="160" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_stok_min" value="Setting Stok Minimum" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_master">
      <mxGeometry x="440" y="160" width="140" height="70" as="geometry" />
    </mxCell>

    <!-- Group 3: Transaksi & Operasional -->
    <mxCell id="grp_trx" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="600" width="800" height="420" as="geometry" />
    </mxCell>
    <mxCell id="title_trx" value="Transaksi &amp; Operasional" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_trx">
      <mxGeometry x="20" y="10" width="200" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_in" value="Input Barang Masuk" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="100" y="50" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_out" value="Input Barang Keluar" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="100" y="140" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_mutasi" value="Mutasi Lokasi &amp; PIC" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="100" y="230" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_scan" value="Scan QR Code / Barcode" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="540" y="140" width="150" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_pinjam" value="Catat Peminjaman" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="100" y="320" width="140" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_kembali" value="Catat Pengembalian" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_trx">
      <mxGeometry x="340" y="320" width="140" height="70" as="geometry" />
    </mxCell>

    <!-- Include Edges for Scan QR -->
    <mxCell id="inc_1" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_in" target="uc_scan">
      <mxGeometry relative="1" as="geometry" />
    </mxCell>
    <mxCell id="inc_2" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_out" target="uc_scan">
      <mxGeometry relative="1" as="geometry" />
    </mxCell>
    <mxCell id="inc_3" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_mutasi" target="uc_scan">
      <mxGeometry relative="1" as="geometry" />
    </mxCell>

    <!-- Group 4: Laporan & Monitoring -->
    <mxCell id="grp_report" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="1050" width="800" height="230" as="geometry" />
    </mxCell>
    <mxCell id="title_report" value="Laporan &amp; Monitoring" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_report">
      <mxGeometry x="20" y="10" width="180" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_dashboard" value="Lihat Dashboard &amp; Grafik" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_report">
      <mxGeometry x="120" y="50" width="150" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_notif" value="Monitoring Alert Stok" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_report">
      <mxGeometry x="330" y="50" width="150" height="70" as="geometry" />
    </mxCell>
    <mxCell id="uc_laporan" value="Cetak Laporan (PDF/Excel)" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_report">
      <mxGeometry x="540" y="50" width="150" height="70" as="geometry" />
    </mxCell>

    <!-- Group 5: Manajemen Pengguna -->
    <mxCell id="grp_user" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="1310" width="800" height="170" as="geometry" />
    </mxCell>
    <mxCell id="title_user" value="Manajemen Pengguna" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_user">
      <mxGeometry x="20" y="10" width="180" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_users" value="Kelola Data User &amp; Role" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_user">
      <mxGeometry x="320" y="50" width="160" height="70" as="geometry" />
    </mxCell>

    <!-- Aktor 1: Administrator (Kiri Bawah) -->
    <mxCell id="act_admin" value="Administrator&#xa;(Nurul Faoziah)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="160" y="800" width="80" height="150" as="geometry" />
    </mxCell>

    <!-- Aktor 2: Staff Gudang (Kiri Atas) -->
    <mxCell id="act_staff" value="Staff Gudang&#xa;(Rani)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="160" y="320" width="80" height="150" as="geometry" />
    </mxCell>

    <!-- Aktor 3: Pimpinan (Kanan Tengah) -->
    <mxCell id="act_pimpinan" value="Pimpinan&#xa;(Pak Hermawan)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="1400" y="700" width="80" height="150" as="geometry" />
    </mxCell>

    <!-- Relasi Asosiasi Actor -> Use Case -->
    <!-- Staff Links -->
    <mxCell id="e_s1" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s2" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s3" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_barang"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s4" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_in"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s5" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_out"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s6" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_mutasi"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s7" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_pinjam"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s8" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_kembali"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- Admin Links (All Master, Trx, Report, User) -->
    <mxCell id="e_a1" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a2" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a3" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_barang"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a4" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_kategori"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a5" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_golongan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a6" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_supplier"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a7" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_stok_min"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a8" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_in"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a9" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_out"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a10" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_mutasi"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a11" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_pinjam"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a12" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_kembali"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a13" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_dashboard"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a14" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_notif"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a15" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_laporan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_a16" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_admin" target="uc_users"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- Pimpinan Links -->
    <mxCell id="e_p1" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p2" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p3" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_dashboard"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p4" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_notif"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p5" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_laporan"><mxGeometry relative="1" as="geometry" /></mxCell>

  </root>
</mxGraphModel>
```

## B. Use Case Diagram (Format Mermaid)
```mermaid
flowchart LR
    Admin[Administrator]
    Staff[Staff Gudang]
    Pimpinan[Pimpinan]

    subgraph Sistem_Inventori ["Sistem Informasi Inventori PT Yintong"]
        subgraph Otentikasi ["Otentikasi Akun"]
            UC_Login(Login)
            UC_Logout(Logout)
        end

        subgraph MasterData ["Data Master dan Konfigurasi"]
            UC_Barang(Kelola Data Barang)
            UC_Kategori(Kelola Kategori Barang)
            UC_Golongan(Kelola Golongan Barang)
            UC_Supplier(Kelola Data Supplier)
            UC_StokMin(Setting Stok Minimum)
        end

        subgraph Transaksi ["Transaksi dan Operasional"]
            UC_Masuk(Input Barang Masuk)
            UC_Keluar(Input Barang Keluar)
            UC_Mutasi(Mutasi Lokasi dan PIC)
            UC_Pinjam(Catat Peminjaman)
            UC_Kembali(Catat Pengembalian)
            UC_Scan(Scan QR Code / Barcode)
        end

        subgraph Laporan ["Laporan dan Monitoring"]
            UC_Dashboard(Lihat Dashboard dan Grafik)
            UC_Notif(Monitoring Alert Stok Kritis)
            UC_Laporan(Cetak Laporan PDF / Excel)
        end

        subgraph ManajemenUser ["Manajemen Pengguna"]
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

# 2. 5 ACTIVITY DIAGRAM (SISI USER / NON-TEKNIS)

### 1. Activity Diagram: Alur Login Pengguna
```mermaid
flowchart TD
    Start([Mulai]) --> A1[Pengguna membuka halaman Login]
    A1 --> A2[Pengguna memasukkan Email dan Password]
    A2 --> A3[Pengguna menekan tombol Masuk]
    A3 --> A4{Apakah Data Akun Valid?}
    
    A4 -- Tidak Valid / Nonaktif --> A5[Sistem menampilkan pesan error: Email atau password salah]
    A5 --> A2

    A4 -- Valid --> A6{Pemeriksaan Role Pengguna}
    
    A6 -- Administrator --> A7[Buka Dashboard Admin: Hak Akses Penuh Master, Transaksi, Laporan, User]
    A6 -- Staff Gudang --> A8[Buka Dashboard Staff: Hak Akses Operasional Barang dan Transaksi]
    A6 -- Pimpinan --> A9[Buka Dashboard Pimpinan: Hak Akses Grafik Eksekutif dan Unduh Laporan]
    
    A7 --> End([Selesai])
    A8 --> End
    A9 --> End
```

---

### 2. Activity Diagram: Pendaftaran Barang Baru dan Pemetaan Golongan
```mermaid
flowchart TD
    Start([Mulai]) --> B1[Pengguna membuka menu Data Barang dan klik Tambah Barang]
    B1 --> B2[Pengguna mengisi Nama Barang, Satuan, Lokasi Penyimpanan, dan Harga]
    B2 --> B3[Pengguna memilih Kategori Barang]
    B3 --> B4[Sistem memfilter daftar Golongan Barang yang sesuai]
    B4 --> B5[Pengguna memilih Golongan Barang]
    B5 --> B6[Sistem menampilkan Live Preview Kode Barang]
    B6 --> B7[Pengguna menekan tombol Simpan Data Barang]
    B7 --> B8{Apakah Data Lengkap dan Valid?}
    
    B8 -- Tidak Lengkap --> B9[Sistem menampilkan tanda peringatan merah pada kolom input]
    B9 --> B2

    B8 -- Valid --> B10[Sistem menyimpan barang, membuat file QR Code otomatis, dan menampilkan pesan sukses]
    B10 --> B11[Barang baru muncul di daftar katalog siap ditransaksikan]
    B11 --> End([Selesai])
```

---

### 3. Activity Diagram: Mutasi Lokasi dan PIC Barang
```mermaid
flowchart TD
    Start([Mulai]) --> C1[Pengguna membuka menu Mutasi Barang dan klik Mutasikan Barang]
    C1 --> C2{Metode Pemilihan Barang}
    
    C2 -- Pilih Manual --> C3[Pengguna memilih barang dari daftar pilihan]
    C2 -- Scan Kamera --> C4[Pengguna klik Scan QR Code dan mengarahkan kamera ke barcode]
    C4 --> C5[Sistem mendeteksi QR Code dan memilih barang otomatis]
    
    C3 --> C6[Sistem otomatis mengisi Lokasi Asal, PIC Asal, Stok Tersedia, dan Catatan Mutasi]
    C5 --> C6
    
    C6 --> C7[Pengguna mengisi Jumlah Unit yang dimutasi dan Lokasi Tujuan Baru]
    C7 --> C8[Pengguna menekan tombol Simpan Transaksi Mutasi]
    C8 --> C9{Apakah Jumlah Mutasi <= Stok?}
    
    C9 -- Melebihi Stok --> C10[Sistem menolak dan menampilkan pesan peringatan stok tidak mencukupi]
    C10 --> C7

    C9 -- Stok Mencukupi --> C11[Sistem mencatat mutasi dan memperbarui Lokasi serta PIC pada data master barang]
    C11 --> C12[Sistem menampilkan riwayat mutasi terbaru]
    C12 --> End([Selesai])
```

---

### 4. Activity Diagram: Peminjaman dan Pengembalian Barang Inventaris
```mermaid
flowchart TD
    Start([Mulai]) --> D1[Pengguna membuka menu Peminjaman Barang]
    D1 --> D2{Pilihan Aktivitas}
    
    %% Alur Pinjam
    D2 -- Peminjaman Baru --> D3[Pengguna klik Catat Peminjaman]
    D3 --> D4[Pengguna memilih Barang, Nama Peminjam, Jumlah, dan Tanggal Rencana Kembali]
    D4 --> D5[Pengguna klik Simpan Peminjaman]
    D5 --> D6{Apakah Stok Tersedia?}
    D6 -- Stok Habis / Kurang --> D7[Sistem menampilkan pesan stok tidak mencukupi]
    D7 --> D4
    D6 -- Stok Cukup --> D8[Sistem memotong stok barang, membuat no transaksi PIN, dan mencatat status Dipinjam]
    D8 --> D9[Barang diserahkan ke peminjam]

    %% Alur Kembali
    D2 -- Pengembalian Barang --> D10[Pengguna mencari data pada daftar peminjaman aktif]
    D10 --> D11[Pengguna klik tombol Kembalikan Barang]
    D11 --> D12[Pengguna mengisi Tanggal Kembali Aktual dan Kondisi Barang saat diterima]
    D12 --> D13[Pengguna klik Simpan Pengembalian]
    D13 --> D14[Sistem mengembalikan stok ke master barang dan mengubah status transaksi menjadi Dikembalikan]
    
    D9 --> End([Selesai])
    D14 --> End
```

---

### 5. Activity Diagram: Monitoring Stok dan Cetak Laporan
```mermaid
flowchart TD
    Start([Mulai]) --> E1[Pengguna membuka menu Laporan Inventori]
    E1 --> E2[Pengguna memilih Jenis Laporan: Stok / Masuk / Keluar / Mutasi / Pinjam]
    E2 --> E3[Pengguna mengatur Filter: Periode Tanggal, Kategori, atau Lokasi]
    E3 --> E4[Pengguna klik tombol Tampilkan / Filter]
    E4 --> E5[Sistem memproses dan menyajikan tabel pratinjau data laporan di layar]
    E5 --> E6{Pilihan Format Unduh}
    
    E6 -- Unduh PDF --> E7[Pengguna klik tombol Cetak PDF]
    E7 --> E8[Sistem menyusun dokumen PDF ber-kop surat resmi PT Yintong format tema Navy]
    E8 --> E9[File PDF otomatis terunduh ke komputer pengguna]

    E6 -- Unduh Excel --> E10[Pengguna klik tombol Ekspor Excel]
    E10 --> E11[Sistem membentuk file spreadsheet .xlsx]
    E11 --> E12[File Excel otomatis terunduh untuk rekapitulasi data]

    E9 --> End([Selesai])
    E12 --> End
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
