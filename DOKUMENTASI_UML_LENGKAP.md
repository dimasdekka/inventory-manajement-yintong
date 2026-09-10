# DOKUMENTASI DIAGRAM UML SISTEM INFORMASI INVENTORI PT YINTONG
(Standard Skripsi & Tugas Akhir - Format Swimlane User vs System Tanpa Ikon)

Dokumen ini berisi:
1. Use Case Diagram (Lengkap dengan XML Draw.io)
2. 5 Activity Diagram Swimlane User vs System (Lengkap dengan XML Draw.io untuk masing-masing diagram)
3. 5 Sequence Diagram Arsitektur Teknis

---

# 1. USE CASE DIAGRAM

## XML Draw.io Use Case Diagram
```xml
<mxGraphModel dx="1422" dy="794" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1654" pageHeight="2336" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    <mxCell id="system_box" value="" style="swimlane;startSize=0;fillColor=#FFFFFF;strokeColor=#333333;strokeWidth=2;rounded=1;" vertex="1" parent="1">
      <mxGeometry x="380" y="100" width="880" height="1520" as="geometry" />
    </mxCell>
    <mxCell id="system_title" value="Sistem Informasi Inventori PT Yintong" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontStyle=1;fontSize=16;fontFamily=Helvetica;" vertex="1" parent="system_box">
      <mxGeometry x="240" y="20" width="400" height="30" as="geometry" />
    </mxCell>
    <!-- Group 1: Otentikasi -->
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
    <!-- Group 2: Master Data -->
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
    <!-- Group 3: Transaksi -->
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
    <mxCell id="inc_1" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_in" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="inc_2" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_out" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="inc_3" value="&amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="html=1;verticalAlign=bottom;labelBackgroundColor=none;endArrow=open;endFill=0;dashed=1;rounded=0;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_trx" source="uc_mutasi" target="uc_scan"><mxGeometry relative="1" as="geometry" /></mxCell>
    <!-- Group 4: Laporan -->
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
    <!-- Group 5: User Management -->
    <mxCell id="grp_user" value="" style="swimlane;startSize=0;fillColor=#F8FAFC;strokeColor=#CBD5E1;rounded=1;" vertex="1" parent="system_box">
      <mxGeometry x="40" y="1310" width="800" height="170" as="geometry" />
    </mxCell>
    <mxCell id="title_user" value="Manajemen Pengguna" style="text;html=1;strokeColor=none;fillColor=none;align=left;verticalAlign=middle;fontStyle=1;fontSize=13;fontFamily=Helvetica;" vertex="1" parent="grp_user">
      <mxGeometry x="20" y="10" width="180" height="20" as="geometry" />
    </mxCell>
    <mxCell id="uc_users" value="Kelola Data User &amp; Role" style="ellipse;whiteSpace=wrap;html=1;fillColor=#FFFFFF;strokeColor=#0F2942;strokeWidth=1.5;" vertex="1" parent="grp_user">
      <mxGeometry x="320" y="50" width="160" height="70" as="geometry" />
    </mxCell>
    <!-- Actors -->
    <mxCell id="act_admin" value="Administrator&#xa;(Nurul Faoziah)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="160" y="800" width="80" height="150" as="geometry" />
    </mxCell>
    <mxCell id="act_staff" value="Staff Gudang&#xa;(Rani)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="160" y="320" width="80" height="150" as="geometry" />
    </mxCell>
    <mxCell id="act_pimpinan" value="Pimpinan&#xa;(Pak Hermawan)" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="1400" y="700" width="80" height="150" as="geometry" />
    </mxCell>
    <!-- Associations Staff -->
    <mxCell id="e_s1" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s2" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s3" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_barang"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s4" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_in"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s5" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_out"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s6" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_mutasi"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s7" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_pinjam"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_s8" style="endArrow=none;html=1;strokeWidth=1.5;entryX=0;entryY=0.5;" edge="1" parent="1" source="act_staff" target="uc_kembali"><mxGeometry relative="1" as="geometry" /></mxCell>
    <!-- Associations Admin -->
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
    <!-- Associations Pimpinan -->
    <mxCell id="e_p1" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_login"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p2" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_logout"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p3" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_dashboard"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p4" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_notif"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_p5" style="endArrow=none;html=1;strokeWidth=1.5;entryX=1;entryY=0.5;" edge="1" parent="1" source="act_pimpinan" target="uc_laporan"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```

---

# 2. 5 ACTIVITY DIAGRAM (SWIMLANE USER VS SYSTEM)

---

### 1. Activity Diagram: Login & Autentikasi Pengguna

#### XML Draw.io Activity Diagram 1:
```xml
<mxGraphModel dx="1000" dy="700" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0"/><mxCell id="1" parent="0"/>
    <mxCell id="frame" value="Activity Diagram: Login &amp; Autentikasi Pengguna" style="shape=umlFrame;whiteSpace=wrap;html=1;width=220;height=35;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="40" y="40" width="620" height="540" as="geometry"/></mxCell>
    <!-- Swimlanes -->
    <mxCell id="lane_user" value="User (Pengguna)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame"><mxGeometry x="20" y="45" width="270" height="470" as="geometry"/></mxCell>
    <mxCell id="lane_sys" value="System (Sistem Inventori)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame"><mxGeometry x="290" y="45" width="290" height="470" as="geometry"/></mxCell>
    <!-- Nodes User -->
    <mxCell id="start1" value="" style="ellipse;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_user"><mxGeometry x="125" y="40" width="20" height="20" as="geometry"/></mxCell>
    <mxCell id="u_act1" value="Buka Halaman Login" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_user"><mxGeometry x="65" y="80" width="140" height="35" as="geometry"/></mxCell>
    <mxCell id="u_act2" value="Input Email &amp; Password&#xa;Klik Tombol Masuk" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_user"><mxGeometry x="65" y="145" width="140" height="45" as="geometry"/></mxCell>
    <mxCell id="u_act3" value="Terima Pesan Peringatan&#xa;Ulangi Pengisian Data" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_user"><mxGeometry x="65" y="270" width="140" height="45" as="geometry"/></mxCell>
    <mxCell id="u_act4" value="Masuk ke Dashboard&#xa;Sesuai Role (Admin/Staff/Pimpinan)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_user"><mxGeometry x="50" y="370" width="170" height="45" as="geometry"/></mxCell>
    <mxCell id="end1" value="" style="ellipse;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_user"><mxGeometry x="123" y="435" width="24" height="24" as="geometry"/></mxCell>
    <!-- Nodes System -->
    <mxCell id="s_dec1" value="Verifikasi&#xa;Kredensial &amp; Status?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_sys"><mxGeometry x="85" y="195" width="120" height="65" as="geometry"/></mxCell>
    <mxCell id="s_act1" value="Kirim Pesan Error&#xa;'Email atau password salah'" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_sys"><mxGeometry x="70" y="270" width="150" height="45" as="geometry"/></mxCell>
    <mxCell id="s_act2" value="Buat Sesi Login Pengguna&#xa;&amp; Siapkan Hak Akses Menu" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_sys"><mxGeometry x="70" y="370" width="150" height="45" as="geometry"/></mxCell>
    <!-- Edges -->
    <mxCell id="e1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="start1" target="u_act1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="u_act1" target="u_act2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="u_act2" target="s_dec1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4" value="Tidak Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="s_dec1" target="s_act1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="s_act1" target="u_act3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="u_act3" target="u_act2"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="40" y="337"/><mxPoint x="40" y="212"/></Array></mxGeometry></mxCell>
    <mxCell id="e7" value="Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="s_dec1" target="s_act2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e8" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="s_act2" target="u_act4"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e9" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame" source="u_act4" target="end1"><mxGeometry relative="1" as="geometry"/></mxCell>
  </root>
</mxGraphModel>
```

#### Diagram Mermaid Activity 1:
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

#### XML Draw.io Activity Diagram 2:
```xml
<mxGraphModel dx="1000" dy="700" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0"/><mxCell id="1" parent="0"/>
    <mxCell id="frame2" value="Activity Diagram: Pendaftaran Barang Baru &amp; Pemetaan Golongan" style="shape=umlFrame;whiteSpace=wrap;html=1;width=280;height=35;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="40" y="40" width="620" height="560" as="geometry"/></mxCell>
    <!-- Swimlanes -->
    <mxCell id="l_u2" value="User (Admin / Staff)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame2"><mxGeometry x="20" y="45" width="270" height="490" as="geometry"/></mxCell>
    <mxCell id="l_s2" value="System (Sistem Inventori)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame2"><mxGeometry x="290" y="45" width="290" height="490" as="geometry"/></mxCell>
    <!-- Nodes User -->
    <mxCell id="st2" value="" style="ellipse;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u2"><mxGeometry x="125" y="35" width="20" height="20" as="geometry"/></mxCell>
    <mxCell id="u2_1" value="Buka Menu Data Barang &amp;&#xa;Klik Tambah Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u2"><mxGeometry x="60" y="70" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u2_2" value="Pilih Kategori Barang&#xa;(Contoh: ATK)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u2"><mxGeometry x="60" y="130" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u2_3" value="Pilih Golongan Barang&#xa;&amp; Lengkapi Form Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u2"><mxGeometry x="60" y="250" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u2_4" value="Klik Tombol Simpan" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u2"><mxGeometry x="60" y="310" width="150" height="35" as="geometry"/></mxCell>
    <mxCell id="u2_5" value="Lihat Barang Baru &amp; QR Code&#xa;pada Katalog Master Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u2"><mxGeometry x="50" y="405" width="170" height="40" as="geometry"/></mxCell>
    <mxCell id="end2" value="" style="ellipse;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u2"><mxGeometry x="123" y="455" width="24" height="24" as="geometry"/></mxCell>
    <!-- Nodes System -->
    <mxCell id="s2_1" value="Filter &amp; Muat Golongan Sesuai&#xa;Kategori Secara Dinamis" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s2"><mxGeometry x="65" y="130" width="160" height="40" as="geometry"/></mxCell>
    <mxCell id="s2_2" value="Tampilkan Live Preview&#xa;Kode Barang (Hierarkis)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s2"><mxGeometry x="65" y="190" width="160" height="40" as="geometry"/></mxCell>
    <mxCell id="s2_dec" value="Validasi Form &amp;&#xa;Kelengkapan Input?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="l_s2"><mxGeometry x="85" y="295" width="120" height="65" as="geometry"/></mxCell>
    <mxCell id="s2_3" value="Generate Kode Hierarkis,&#xa;Render SVG QR Code, &amp;&#xa;Simpan Record ke Database" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s2"><mxGeometry x="60" y="395" width="170" height="50" as="geometry"/></mxCell>
    <!-- Edges -->
    <mxCell id="e2_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="st2" target="u2_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="u2_1" target="u2_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="u2_2" target="s2_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="s2_1" target="s2_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="s2_2" target="u2_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="u2_3" target="u2_4"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="u2_4" target="s2_dec"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_8" value="Tidak Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="s2_dec" target="u2_3"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="435" y="275"/></Array></mxGeometry></mxCell>
    <mxCell id="e2_9" value="Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="s2_dec" target="s2_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_10" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="s2_3" target="u2_5"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e2_11" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame2" source="u2_5" target="end2"><mxGeometry relative="1" as="geometry"/></mxCell>
  </root>
</mxGraphModel>
```

#### Diagram Mermaid Activity 2:
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

#### XML Draw.io Activity Diagram 3:
```xml
<mxGraphModel dx="1000" dy="700" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0"/><mxCell id="1" parent="0"/>
    <mxCell id="frame3" value="Activity Diagram: Mutasi Lokasi &amp; PIC Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;width=250;height=35;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="40" y="40" width="620" height="560" as="geometry"/></mxCell>
    <!-- Swimlanes -->
    <mxCell id="l_u3" value="User (Staff Gudang / Admin)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame3"><mxGeometry x="20" y="45" width="270" height="490" as="geometry"/></mxCell>
    <mxCell id="l_s3" value="System (Sistem Inventori)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame3"><mxGeometry x="290" y="45" width="290" height="490" as="geometry"/></mxCell>
    <!-- Nodes User -->
    <mxCell id="st3" value="" style="ellipse;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u3"><mxGeometry x="125" y="35" width="20" height="20" as="geometry"/></mxCell>
    <mxCell id="u3_1" value="Buka Menu Mutasi Barang &amp;&#xa;Klik Mutasikan Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u3"><mxGeometry x="60" y="70" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u3_2" value="Pilih Barang dari Dropdown /&#xa;Scan QR Kamera" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u3"><mxGeometry x="60" y="130" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u3_3" value="Isi Jumlah Mutasi &amp;&#xa;Lokasi Penyimpanan Baru" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u3"><mxGeometry x="60" y="240" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u3_4" value="Klik Simpan Transaksi Mutasi" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u3"><mxGeometry x="55" y="300" width="160" height="35" as="geometry"/></mxCell>
    <mxCell id="u3_5" value="Melihat Riwayat Mutasi&#xa;Terbaru pada Tabel" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u3"><mxGeometry x="60" y="405" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="end3" value="" style="ellipse;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u3"><mxGeometry x="123" y="455" width="24" height="24" as="geometry"/></mxCell>
    <!-- Nodes System -->
    <mxCell id="s3_1" value="Otomatis Mengisi Lokasi Asal,&#xa;PIC Asal, Stok, &amp; Catatan Mutasi" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s3"><mxGeometry x="60" y="130" width="170" height="40" as="geometry"/></mxCell>
    <mxCell id="s3_dec" value="Validasi Jumlah&#xa;&lt;= Stok Tersedia?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="l_s3"><mxGeometry x="85" y="285" width="120" height="65" as="geometry"/></mxCell>
    <mxCell id="s3_2" value="Tampilkan Peringatan:&#xa;Jumlah Melebihi Stok" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s3"><mxGeometry x="70" y="225" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="s3_3" value="Catat Record Mutasi &amp;&#xa;Perbarui Lokasi/PIC pada Master" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s3"><mxGeometry x="60" y="400" width="170" height="45" as="geometry"/></mxCell>
    <!-- Edges -->
    <mxCell id="e3_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="st3" target="u3_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="u3_1" target="u3_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="u3_2" target="s3_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="s3_1" target="u3_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="u3_3" target="u3_4"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="u3_4" target="s3_dec"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_7" value="Tidak Cukup" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="s3_dec" target="s3_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_8" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="s3_2" target="u3_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_9" value="Cukup" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="s3_dec" target="s3_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_10" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="s3_3" target="u3_5"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e3_11" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame3" source="u3_5" target="end3"><mxGeometry relative="1" as="geometry"/></mxCell>
  </root>
</mxGraphModel>
```

#### Diagram Mermaid Activity 3:
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

#### XML Draw.io Activity Diagram 4:
```xml
<mxGraphModel dx="1000" dy="700" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0"/><mxCell id="1" parent="0"/>
    <mxCell id="frame4" value="Activity Diagram: Peminjaman &amp; Pengembalian Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;width=270;height=35;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="40" y="40" width="620" height="580" as="geometry"/></mxCell>
    <!-- Swimlanes -->
    <mxCell id="l_u4" value="User (Staff / Admin)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame4"><mxGeometry x="20" y="45" width="270" height="510" as="geometry"/></mxCell>
    <mxCell id="l_s4" value="System (Sistem Inventori)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame4"><mxGeometry x="290" y="45" width="290" height="510" as="geometry"/></mxCell>
    <!-- Nodes User -->
    <mxCell id="st4" value="" style="ellipse;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u4"><mxGeometry x="125" y="30" width="20" height="20" as="geometry"/></mxCell>
    <mxCell id="u4_dec" value="Pilih Transaksi?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="l_u4"><mxGeometry x="85" y="65" width="100" height="50" as="geometry"/></mxCell>
    <mxCell id="u4_p1" value="Input Data Peminjaman&#xa;(Barang, Peminjam, Tgl Kembali)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u4"><mxGeometry x="20" y="140" width="150" height="45" as="geometry"/></mxCell>
    <mxCell id="u4_p2" value="Klik Simpan Pinjam" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u4"><mxGeometry x="35" y="205" width="120" height="35" as="geometry"/></mxCell>
    <mxCell id="u4_k1" value="Pilih Transaksi Aktif &amp;&#xa;Klik Kembalikan Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u4"><mxGeometry x="100" y="330" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="u4_k2" value="Input Tgl Kembali &amp; Kondisi&#xa;Klik Simpan Pengembalian" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u4"><mxGeometry x="100" y="390" width="150" height="40" as="geometry"/></mxCell>
    <mxCell id="end4" value="" style="ellipse;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u4"><mxGeometry x="123" y="465" width="24" height="24" as="geometry"/></mxCell>
    <!-- Nodes System -->
    <mxCell id="s4_dec" value="Cek Ketersediaan&#xa;Stok Barang?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="l_s4"><mxGeometry x="85" y="190" width="120" height="65" as="geometry"/></mxCell>
    <mxCell id="s4_p1" value="Catat Peminjaman (PIN-...),&#xa;Status 'Dipinjam', &amp;&#xa;Kurangi Stok Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s4"><mxGeometry x="60" y="275" width="170" height="45" as="geometry"/></mxCell>
    <mxCell id="s4_k1" value="Catat Pengembalian (RET-...),&#xa;Ubah Status 'Dikembalikan', &amp;&#xa;Tambah Stok Kembali" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s4"><mxGeometry x="60" y="390" width="170" height="50" as="geometry"/></mxCell>
    <!-- Edges -->
    <mxCell id="e4_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="st4" target="u4_dec"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_2" value="Pinjam" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_dec" target="u4_p1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_p1" target="u4_p2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_p2" target="s4_dec"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_5" value="Kurang" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="s4_dec" target="u4_p1"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="435" y="162"/></Array></mxGeometry></mxCell>
    <mxCell id="e4_6" value="Cukup" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="s4_dec" target="s4_p1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="s4_p1" target="end4"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_8" value="Kembali" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_dec" target="u4_k1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_9" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_k1" target="u4_k2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_10" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="u4_k2" target="s4_k1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e4_11" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame4" source="s4_k1" target="end4"><mxGeometry relative="1" as="geometry"/></mxCell>
  </root>
</mxGraphModel>
```

#### Diagram Mermaid Activity 4:
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

#### XML Draw.io Activity Diagram 5:
```xml
<mxGraphModel dx="1000" dy="700" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="827" pageHeight="1169">
  <root>
    <mxCell id="0"/><mxCell id="1" parent="0"/>
    <mxCell id="frame5" value="Activity Diagram: Monitoring Stok &amp; Cetak Laporan" style="shape=umlFrame;whiteSpace=wrap;html=1;width=250;height=35;fontStyle=1;" vertex="1" parent="1"><mxGeometry x="40" y="40" width="620" height="520" as="geometry"/></mxCell>
    <!-- Swimlanes -->
    <mxCell id="l_u5" value="User (Pimpinan / Admin)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame5"><mxGeometry x="20" y="45" width="270" height="450" as="geometry"/></mxCell>
    <mxCell id="l_s5" value="System (Sistem Inventori)" style="swimlane;startSize=25;fontStyle=1;fillColor=#FFFFFF;" vertex="1" parent="frame5"><mxGeometry x="290" y="45" width="290" height="450" as="geometry"/></mxCell>
    <!-- Nodes User -->
    <mxCell id="st5" value="" style="ellipse;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u5"><mxGeometry x="125" y="30" width="20" height="20" as="geometry"/></mxCell>
    <mxCell id="u5_1" value="Buka Menu Laporan Inventori" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u5"><mxGeometry x="60" y="65" width="150" height="35" as="geometry"/></mxCell>
    <mxCell id="u5_2" value="Pilih Jenis Laporan &amp;&#xa;Tentukan Filter (Periode/Kategori)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u5"><mxGeometry x="50" y="120" width="170" height="40" as="geometry"/></mxCell>
    <mxCell id="u5_3" value="Klik Tombol Tampilkan / Filter" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u5"><mxGeometry x="55" y="180" width="160" height="35" as="geometry"/></mxCell>
    <mxCell id="u5_4" value="Melihat Pratinjau Tabel &amp;&#xa;Pilih Ekspor (PDF / Excel)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u5"><mxGeometry x="55" y="270" width="160" height="40" as="geometry"/></mxCell>
    <mxCell id="u5_5" value="Menerima Unduhan File Dokumen&#xa;(Laporan_Inventori.pdf / .xlsx)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_u5"><mxGeometry x="50" y="375" width="170" height="40" as="geometry"/></mxCell>
    <mxCell id="end5" value="" style="ellipse;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="l_u5"><mxGeometry x="123" y="420" width="20" height="20" as="geometry"/></mxCell>
    <!-- Nodes System -->
    <mxCell id="s5_1" value="Query Database Sesuai Filter &amp;&#xa;Sajikan Tabel Pratinjau" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s5"><mxGeometry x="60" y="175" width="170" height="45" as="geometry"/></mxCell>
    <mxCell id="s5_2" value="Render Dokumen Ber-Kop Surat&#xa;(PDF DomPDF / Sheet Excel) &amp;&#xa;Kirim File Download Stream" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="l_s5"><mxGeometry x="55" y="265" width="180" height="50" as="geometry"/></mxCell>
    <!-- Edges -->
    <mxCell id="e5_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="st5" target="u5_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="u5_1" target="u5_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="u5_2" target="u5_3"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="u5_3" target="s5_1"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="s5_1" target="u5_4"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="u5_4" target="s5_2"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="s5_2" target="u5_5"><mxGeometry relative="1" as="geometry"/></mxCell>
    <mxCell id="e5_8" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="frame5" source="u5_5" target="end5"><mxGeometry relative="1" as="geometry"/></mxCell>
  </root>
</mxGraphModel>
```

#### Diagram Mermaid Activity 5:
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
