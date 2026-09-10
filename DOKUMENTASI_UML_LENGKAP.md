# DOKUMENTASI 5 ACTIVITY DIAGRAM (LENGKAP FORMAT DRAW.IO SWIMLANE)
## SISTEM INFORMASI INVENTORI & ASET PT YINTONG

Dokumen ini berisi **5 Activity Diagram Lengkap** dengan struktur **Swimlane (User vs System)** sesuai standar Draw.io / diagrams.net.
Masing-masing diagram dilengkapi dengan **Kode XML Draw.io** yang dapat langsung di-copy-paste ke draw.io, serta visualisasi alur diagramnya.

---

# 1. ACTIVITY DIAGRAM: LOGIN & AUTENTIKASI PENGGUNA

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- FRAME CONTAINER -->
    <mxCell id="frame_1" value="Activity Diagram &lt;br&gt; Login &amp; Autentikasi Pengguna" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=200;height=40;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="100" y="80" width="760" height="740" as="geometry" />
    </mxCell>
    
    <mxCell id="grp_1" value="" style="group" vertex="1" connectable="0" parent="1">
      <mxGeometry x="125" y="130" width="710" height="660" as="geometry" />
    </mxCell>

    <!-- SWIMLANE USER -->
    <mxCell id="lane_u1" value="User (Pengguna)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_1">
      <mxGeometry x="0" y="0" width="250" height="660" as="geometry" />
    </mxCell>
    <mxCell id="st_1" value="" style="strokeWidth=2;html=1;shape=mxgraph.flowchart.start_2;whiteSpace=wrap;fillColor=#000000;" vertex="1" parent="lane_u1">
      <mxGeometry x="115" y="45" width="20" height="20" as="geometry" />
    </mxCell>
    <mxCell id="u1_act1" value="Buka Halaman Login" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u1">
      <mxGeometry x="50" y="85" width="150" height="40" as="geometry" />
    </mxCell>
    <mxCell id="u1_act2" value="Input Email &amp; Password&#xa;Klik Tombol Masuk" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u1">
      <mxGeometry x="50" y="160" width="150" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u1_act3" value="Terima Pesan Peringatan &amp;&#xa;Ulangi Pengisian Data" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u1">
      <mxGeometry x="45" y="380" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u1_act4" value="Berhasil Masuk Dashboard&#xa;Sesuai Hak Akses Role" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u1">
      <mxGeometry x="45" y="510" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="end_1" value="" style="ellipse;html=1;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_u1">
      <mxGeometry x="110" y="600" width="30" height="30" as="geometry" />
    </mxCell>
    
    <!-- Edges inside User -->
    <mxCell id="e_u1_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u1" source="st_1" target="u1_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u1_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u1" source="u1_act1" target="u1_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u1_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u1" source="u1_act4" target="end_1"><mxGeometry relative="1" as="geometry"/></mxCell>

    <!-- SWIMLANE SYSTEM -->
    <mxCell id="lane_s1" value="System (Sistem Inventori)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_1">
      <mxGeometry x="250" y="0" width="460" height="660" as="geometry" />
    </mxCell>
    <mxCell id="s1_dec" value="Verifikasi Kredensial&#xa;&amp; Status Aktif?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s1">
      <mxGeometry x="160" y="225" width="140" height="75" as="geometry" />
    </mxCell>
    <mxCell id="s1_act1" value="Kirim Pesan Error:&#xa;'Email atau password salah'" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s1">
      <mxGeometry x="60" y="315" width="165" height="45" as="geometry" />
    </mxCell>
    <mxCell id="s1_act2" value="Buat Sesi Login Pengguna&#xa;&amp; Siapkan Hak Akses Menu" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s1">
      <mxGeometry x="240" y="420" width="170" height="50" as="geometry" />
    </mxCell>

    <!-- Edges Inter-Lane -->
    <mxCell id="e_cross_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_1" source="u1_act2" target="s1_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_cross_2" value="Tidak Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_1" source="s1_dec" target="s1_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_cross_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_1" source="s1_act1" target="u1_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_cross_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_1" source="u1_act3" target="u1_act1"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="20" y="403"/><mxPoint x="20" y="105"/></Array></mxGeometry></mxCell>
    <mxCell id="e_cross_5" value="Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_1" source="s1_dec" target="s1_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_cross_6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_1" source="s1_act2" target="u1_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```

---

# 2. ACTIVITY DIAGRAM: PENDAFTARAN BARANG BARU & PEMETAAN GOLONGAN

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- FRAME CONTAINER -->
    <mxCell id="frame_2" value="Activity Diagram &lt;br&gt; Pendaftaran Master Barang Baru" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=230;height=40;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="100" y="80" width="780" height="760" as="geometry" />
    </mxCell>
    
    <mxCell id="grp_2" value="" style="group" vertex="1" connectable="0" parent="1">
      <mxGeometry x="125" y="130" width="730" height="680" as="geometry" />
    </mxCell>

    <!-- SWIMLANE USER -->
    <mxCell id="lane_u2" value="User (Admin / Staff)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_2">
      <mxGeometry x="0" y="0" width="260" height="680" as="geometry" />
    </mxCell>
    <mxCell id="st_2" value="" style="strokeWidth=2;html=1;shape=mxgraph.flowchart.start_2;whiteSpace=wrap;fillColor=#000000;" vertex="1" parent="lane_u2">
      <mxGeometry x="120" y="40" width="20" height="20" as="geometry" />
    </mxCell>
    <mxCell id="u2_act1" value="Buka Menu Data Barang &amp;&#xa;Klik Tambah Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u2">
      <mxGeometry x="50" y="80" width="160" height="40" as="geometry" />
    </mxCell>
    <mxCell id="u2_act2" value="Pilih Kategori Barang&#xa;(Contoh: ATK)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u2">
      <mxGeometry x="50" y="145" width="160" height="40" as="geometry" />
    </mxCell>
    <mxCell id="u2_act3" value="Pilih Golongan Barang&#xa;&amp; Lengkapi Form Input" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u2">
      <mxGeometry x="50" y="275" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u2_act4" value="Klik Tombol Simpan" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u2">
      <mxGeometry x="50" y="345" width="160" height="35" as="geometry" />
    </mxCell>
    <mxCell id="u2_act5" value="Lihat Barang Baru &amp; QR Code&#xa;pada Katalog Master Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u2">
      <mxGeometry x="45" y="535" width="170" height="45" as="geometry" />
    </mxCell>
    <mxCell id="end_2" value="" style="ellipse;html=1;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_u2">
      <mxGeometry x="115" y="620" width="30" height="30" as="geometry" />
    </mxCell>

    <!-- Edges inside User -->
    <mxCell id="e_u2_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u2" source="st_2" target="u2_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u2_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u2" source="u2_act1" target="u2_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u2_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u2" source="u2_act3" target="u2_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u2_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u2" source="u2_act5" target="end_2"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- SWIMLANE SYSTEM -->
    <mxCell id="lane_s2" value="System (Sistem Inventori)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_2">
      <mxGeometry x="260" y="0" width="470" height="680" as="geometry" />
    </mxCell>
    <mxCell id="s2_act1" value="Filter &amp; Tampilkan Daftar&#xa;Golongan Sesuai Kategori" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s2">
      <mxGeometry x="60" y="145" width="170" height="40" as="geometry" />
    </mxCell>
    <mxCell id="s2_act2" value="Tampilkan Live Preview&#xa;Kode Barang (Hierarkis)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s2">
      <mxGeometry x="60" y="210" width="170" height="40" as="geometry" />
    </mxCell>
    <mxCell id="s2_dec" value="Validasi Kelengkapan&#xa;&amp; Format Data?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s2">
      <mxGeometry x="160" y="325" width="140" height="75" as="geometry" />
    </mxCell>
    <mxCell id="s2_act3" value="Tampilkan Tanda Peringatan&#xa;Merah pada Kolom Kosong" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s2">
      <mxGeometry x="50" y="415" width="175" height="40" as="geometry" />
    </mxCell>
    <mxCell id="s2_act4" value="Generate Kode Hierarkis,&#xa;Render SVG QR Code, &amp;&#xa;Simpan Record ke Database" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s2">
      <mxGeometry x="245" y="445" width="180" height="55" as="geometry" />
    </mxCell>

    <!-- Inter-Lane Connections -->
    <mxCell id="e2_c1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_2" source="u2_act2" target="s2_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0.5;exitY=1;entryX=0.5;entryY=0;" edge="1" parent="grp_2" source="s2_act1" target="s2_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_2" source="s2_act2" target="u2_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_2" source="u2_act4" target="s2_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c5" value="Tidak Lengkap" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_2" source="s2_dec" target="s2_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_2" source="s2_act3" target="u2_act3"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="20" y="435"/><mxPoint x="20" y="298"/></Array></mxGeometry></mxCell>
    <mxCell id="e2_c7" value="Lengkap &amp; Valid" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_2" source="s2_dec" target="s2_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e2_c8" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_2" source="s2_act4" target="u2_act5"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```

---

# 3. ACTIVITY DIAGRAM: MUTASI LOKASI & PIC BARANG (AUTO-FILL & SCAN QR)

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- FRAME CONTAINER -->
    <mxCell id="frame_3" value="Activity Diagram &lt;br&gt; Mutasi Lokasi &amp; PIC Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=220;height=40;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="100" y="80" width="780" height="760" as="geometry" />
    </mxCell>
    
    <mxCell id="grp_3" value="" style="group" vertex="1" connectable="0" parent="1">
      <mxGeometry x="125" y="130" width="730" height="680" as="geometry" />
    </mxCell>

    <!-- SWIMLANE USER -->
    <mxCell id="lane_u3" value="User (Staff Gudang / Admin)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_3">
      <mxGeometry x="0" y="0" width="260" height="680" as="geometry" />
    </mxCell>
    <mxCell id="st_3" value="" style="strokeWidth=2;html=1;shape=mxgraph.flowchart.start_2;whiteSpace=wrap;fillColor=#000000;" vertex="1" parent="lane_u3">
      <mxGeometry x="120" y="35" width="20" height="20" as="geometry" />
    </mxCell>
    <mxCell id="u3_act1" value="Buka Menu Mutasi Barang &amp;&#xa;Klik Mutasikan Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u3">
      <mxGeometry x="50" y="75" width="160" height="40" as="geometry" />
    </mxCell>
    <mxCell id="u3_act2" value="Pilih Barang (Dropdown /&#xa;Scan QR Code Kamera)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u3">
      <mxGeometry x="50" y="140" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u3_act3" value="Input Jumlah Mutasi &amp;&#xa;Lokasi Penyimpanan Baru" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u3">
      <mxGeometry x="50" y="270" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u3_act4" value="Klik Simpan Transaksi Mutasi" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u3">
      <mxGeometry x="50" y="340" width="160" height="35" as="geometry" />
    </mxCell>
    <mxCell id="u3_act5" value="Melihat Riwayat Mutasi&#xa;Terbaru pada Tabel" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u3">
      <mxGeometry x="50" y="530" width="160" height="45" as="geometry" />
    </mxCell>
    <mxCell id="end_3" value="" style="ellipse;html=1;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_u3">
      <mxGeometry x="115" y="615" width="30" height="30" as="geometry" />
    </mxCell>

    <!-- Edges inside User -->
    <mxCell id="e_u3_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u3" source="st_3" target="u3_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u3_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u3" source="u3_act1" target="u3_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u3_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u3" source="u3_act3" target="u3_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u3_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u3" source="u3_act5" target="end_3"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- SWIMLANE SYSTEM -->
    <mxCell id="lane_s3" value="System (Sistem Inventori)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_3">
      <mxGeometry x="260" y="0" width="470" height="680" as="geometry" />
    </mxCell>
    <mxCell id="s3_act1" value="Otomatis Mengisi Lokasi Asal,&#xa;PIC Asal, Stok, &amp; Catatan Mutasi" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s3">
      <mxGeometry x="60" y="140" width="180" height="45" as="geometry" />
    </mxCell>
    <mxCell id="s3_dec" value="Cek Jumlah Mutasi&#xa;&lt;= Stok Tersedia?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s3">
      <mxGeometry x="165" y="320" width="140" height="75" as="geometry" />
    </mxCell>
    <mxCell id="s3_act2" value="Tampilkan Peringatan:&#xa;Jumlah Melebihi Stok" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s3">
      <mxGeometry x="50" y="410" width="170" height="40" as="geometry" />
    </mxCell>
    <mxCell id="s3_act3" value="DB Transaction: Catat Mutasi&#xa;&amp; Perbarui Lokasi/PIC pada Master" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s3">
      <mxGeometry x="245" y="440" width="185" height="50" as="geometry" />
    </mxCell>

    <!-- Inter-Lane Connections -->
    <mxCell id="e3_c1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_3" source="u3_act2" target="s3_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e3_c2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_3" source="s3_act1" target="u3_act3"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="290" y="293"/></Array></mxGeometry></mxCell>
    <mxCell id="e3_c3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_3" source="u3_act4" target="s3_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e3_c4" value="Melebihi Stok" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_3" source="s3_dec" target="s3_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e3_c5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_3" source="s3_act2" target="u3_act3"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="20" y="430"/><mxPoint x="20" y="293"/></Array></mxGeometry></mxCell>
    <mxCell id="e3_c6" value="Stok Cukup" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_3" source="s3_dec" target="s3_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e3_c7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_3" source="s3_act3" target="u3_act5"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```

---

# 4. ACTIVITY DIAGRAM: PEMINJAMAN & PENGEMBALIAN BARANG INVENTARIS

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- FRAME CONTAINER -->
    <mxCell id="frame_4" value="Activity Diagram &lt;br&gt; Peminjaman &amp; Pengembalian Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=250;height=40;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="100" y="80" width="800" height="780" as="geometry" />
    </mxCell>
    
    <mxCell id="grp_4" value="" style="group" vertex="1" connectable="0" parent="1">
      <mxGeometry x="125" y="130" width="750" height="700" as="geometry" />
    </mxCell>

    <!-- SWIMLANE USER -->
    <mxCell id="lane_u4" value="User (Staff / Admin)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_4">
      <mxGeometry x="0" y="0" width="270" height="700" as="geometry" />
    </mxCell>
    <mxCell id="st_4" value="" style="strokeWidth=2;html=1;shape=mxgraph.flowchart.start_2;whiteSpace=wrap;fillColor=#000000;" vertex="1" parent="lane_u4">
      <mxGeometry x="125" y="35" width="20" height="20" as="geometry" />
    </mxCell>
    <mxCell id="u4_act1" value="Buka Menu Peminjaman" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="60" y="75" width="150" height="35" as="geometry" />
    </mxCell>
    <mxCell id="u4_dec" value="Pilih Transaksi?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="85" y="130" width="100" height="55" as="geometry" />
    </mxCell>
    
    <!-- Branch Peminjaman -->
    <mxCell id="u4_p1" value="Input Barang, Peminjam,&#xa;Jumlah, &amp; Tgl Kembali" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="20" y="210" width="150" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u4_p2" value="Klik Simpan Peminjaman" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="25" y="275" width="140" height="35" as="geometry" />
    </mxCell>

    <!-- Branch Pengembalian -->
    <mxCell id="u4_k1" value="Pilih Data Peminjaman Aktif&#xa;&amp; Klik Kembalikan" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="90" y="440" width="165" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u4_k2" value="Input Tgl Kembali, Kondisi,&#xa;&amp; Klik Simpan Pengembalian" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u4">
      <mxGeometry x="90" y="505" width="165" height="45" as="geometry" />
    </mxCell>
    <mxCell id="end_4" value="" style="ellipse;html=1;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_u4">
      <mxGeometry x="120" y="635" width="30" height="30" as="geometry" />
    </mxCell>

    <!-- Edges inside User -->
    <mxCell id="e_u4_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u4" source="st_4" target="u4_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u4_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u4" source="u4_act1" target="u4_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u4_3" value="Peminjaman" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="lane_u4" source="u4_dec" target="u4_p1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u4_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u4" source="u4_p1" target="u4_p2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u4_5" value="Pengembalian" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="lane_u4" source="u4_dec" target="u4_k1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u4_6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u4" source="u4_k1" target="u4_k2"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- SWIMLANE SYSTEM -->
    <mxCell id="lane_s4" value="System (Sistem Inventori)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_4">
      <mxGeometry x="270" y="0" width="480" height="700" as="geometry" />
    </mxCell>
    <mxCell id="s4_dec" value="Cek Ketersediaan&#xa;Stok Barang?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s4">
      <mxGeometry x="160" y="255" width="140" height="75" as="geometry" />
    </mxCell>
    <mxCell id="s4_act1" value="Tampilkan Peringatan:&#xa;Stok Tidak Mencukupi" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s4">
      <mxGeometry x="40" y="345" width="165" height="40" as="geometry" />
    </mxCell>
    <mxCell id="s4_act2" value="Catat Peminjaman (PIN-...),&#xa;Status 'Dipinjam', &amp;&#xa;Kurangi Stok Master Barang" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s4">
      <mxGeometry x="235" y="360" width="185" height="55" as="geometry" />
    </mxCell>
    <mxCell id="s4_act3" value="Catat Pengembalian (RET-...),&#xa;Ubah Status 'Dikembalikan', &amp;&#xa;Kembalikan (Tambah) Stok" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s4">
      <mxGeometry x="140" y="500" width="190" height="55" as="geometry" />
    </mxCell>

    <!-- Inter-Lane Connections -->
    <mxCell id="e4_c1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_4" source="u4_p2" target="s4_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e4_c2" value="Stok Kurang" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_4" source="s4_dec" target="s4_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e4_c3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_4" source="s4_act1" target="u4_p1"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="10" y="365"/><mxPoint x="10" y="233"/></Array></mxGeometry></mxCell>
    <mxCell id="e4_c4" value="Stok Cukup" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_4" source="s4_dec" target="s4_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e4_c5" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0.5;exitY=1;entryX=1;entryY=0.5;" edge="1" parent="grp_4" source="s4_act2" target="end_4"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="597" y="650"/></Array></mxGeometry></mxCell>
    <mxCell id="e4_c6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_4" source="u4_k2" target="s4_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e4_c7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0.5;exitY=1;entryX=1;entryY=0.5;" edge="1" parent="grp_4" source="s4_act3" target="end_4"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="505" y="650"/></Array></mxGeometry></mxCell>
  </root>
</mxGraphModel>
```

---

# 5. ACTIVITY DIAGRAM: MONITORING STOK & CETAK LAPORAN (PDF & EXCEL)

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />
    
    <!-- FRAME CONTAINER -->
    <mxCell id="frame_5" value="Activity Diagram &lt;br&gt; Monitoring Stok &amp; Cetak Laporan" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=230;height=40;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="100" y="80" width="780" height="740" as="geometry" />
    </mxCell>
    
    <mxCell id="grp_5" value="" style="group" vertex="1" connectable="0" parent="1">
      <mxGeometry x="125" y="130" width="730" height="660" as="geometry" />
    </mxCell>

    <!-- SWIMLANE USER -->
    <mxCell id="lane_u5" value="User (Pimpinan / Admin)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_5">
      <mxGeometry x="0" y="0" width="260" height="660" as="geometry" />
    </mxCell>
    <mxCell id="st_5" value="" style="strokeWidth=2;html=1;shape=mxgraph.flowchart.start_2;whiteSpace=wrap;fillColor=#000000;" vertex="1" parent="lane_u5">
      <mxGeometry x="120" y="35" width="20" height="20" as="geometry" />
    </mxCell>
    <mxCell id="u5_act1" value="Buka Menu Laporan Inventori" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u5">
      <mxGeometry x="50" y="75" width="160" height="35" as="geometry" />
    </mxCell>
    <mxCell id="u5_act2" value="Pilih Jenis Laporan &amp;&#xa;Tentukan Filter Periode/Kategori" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u5">
      <mxGeometry x="45" y="135" width="170" height="40" as="geometry" />
    </mxCell>
    <mxCell id="u5_act3" value="Klik Tombol Filter / Tampilkan" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u5">
      <mxGeometry x="50" y="195" width="160" height="35" as="geometry" />
    </mxCell>
    <mxCell id="u5_act4" value="Melihat Pratinjau Tabel &amp;&#xa;Klik Tombol Cetak PDF / Excel" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u5">
      <mxGeometry x="45" y="340" width="170" height="45" as="geometry" />
    </mxCell>
    <mxCell id="u5_act5" value="Menerima Unduhan File&#xa;(Laporan.pdf / .xlsx)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_u5">
      <mxGeometry x="50" y="515" width="160" height="40" as="geometry" />
    </mxCell>
    <mxCell id="end_5" value="" style="ellipse;html=1;shape=endState;fillColor=#000000;strokeColor=#000000;" vertex="1" parent="lane_u5">
      <mxGeometry x="115" y="595" width="30" height="30" as="geometry" />
    </mxCell>

    <!-- Edges inside User -->
    <mxCell id="e_u5_1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u5" source="st_5" target="u5_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u5_2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u5" source="u5_act1" target="u5_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u5_3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u5" source="u5_act2" target="u5_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e_u5_4" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;" edge="1" parent="lane_u5" source="u5_act5" target="end_5"><mxGeometry relative="1" as="geometry" /></mxCell>

    <!-- SWIMLANE SYSTEM -->
    <mxCell id="lane_s5" value="System (Sistem Inventori)" style="swimlane;whiteSpace=wrap;html=1;swimlaneFillColor=default;startSize=30;fontStyle=1;fontSize=13;fillColor=#FFFFFF;strokeColor=#333333;" vertex="1" parent="grp_5">
      <mxGeometry x="260" y="0" width="470" height="660" as="geometry" />
    </mxCell>
    <mxCell id="s5_act1" value="Query Database Sesuai Filter &amp;&#xa;Sajikan Tabel Pratinjau Data" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s5">
      <mxGeometry x="60" y="190" width="180" height="45" as="geometry" />
    </mxCell>
    <mxCell id="s5_dec" value="Pilihan Format&#xa;Ekspor Laporan?" style="rhombus;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s5">
      <mxGeometry x="165" y="325" width="140" height="75" as="geometry" />
    </mxCell>
    <mxCell id="s5_act2" value="Render Dokumen PDF Ber-Kop&#xa;Surat Resmi Tema Navy PT Yintong" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s5">
      <mxGeometry x="40" y="420" width="180" height="45" as="geometry" />
    </mxCell>
    <mxCell id="s5_act3" value="Generate Spreadsheet&#xa;File Excel (.xlsx)" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s5">
      <mxGeometry x="250" y="420" width="170" height="45" as="geometry" />
    </mxCell>
    <mxCell id="s5_act4" value="Kirim Stream File Download&#xa;ke Browser Pengguna" style="rounded=1;whiteSpace=wrap;html=1;" vertex="1" parent="lane_s5">
      <mxGeometry x="145" y="510" width="180" height="45" as="geometry" />
    </mxCell>

    <!-- Inter-Lane Connections -->
    <mxCell id="e5_c1" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_5" source="u5_act3" target="s5_act1"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c2" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_5" source="s5_act1" target="u5_act4"><mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="290" y="363"/></Array></mxGeometry></mxCell>
    <mxCell id="e5_c3" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0;entryY=0.5;" edge="1" parent="grp_5" source="u5_act4" target="s5_dec"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c4" value="Format PDF" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_5" source="s5_dec" target="s5_act2"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c5" value="Format Excel" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;entryX=0.5;entryY=0;" edge="1" parent="grp_5" source="s5_dec" target="s5_act3"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c6" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0.5;exitY=1;entryX=0.25;entryY=0;" edge="1" parent="grp_5" source="s5_act2" target="s5_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c7" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0.5;exitY=1;entryX=0.75;entryY=0;" edge="1" parent="grp_5" source="s5_act3" target="s5_act4"><mxGeometry relative="1" as="geometry" /></mxCell>
    <mxCell id="e5_c8" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;exitX=0;exitY=0.5;entryX=1;entryY=0.5;" edge="1" parent="grp_5" source="s5_act4" target="u5_act5"><mxGeometry relative="1" as="geometry" /></mxCell>
  </root>
</mxGraphModel>
```
