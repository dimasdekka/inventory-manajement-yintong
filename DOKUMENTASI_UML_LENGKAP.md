# DOKUMENTASI SEQUENCE DIAGRAM (RAPI, PROPORSIONAL, DAN TIDAK TUMPANG TINDIH)
## SISTEM INFORMASI INVENTORI & ASET PT YINTONG

Perbaikan pada versi ini:
1. **Aktor Proporsional (Tidak Gepeng)**: Rasio lebar dan tinggi aktor diatur ideal (`width=35`, `size=65`) sehingga proporsional dan tegas.
2. **Header Lifeline Lega (`size=50`)**: Kotak partisipan memiliki tinggi cukup sehingga teks 2 baris (nama peran dan file controller/service) tidak terpotong garis.
3. **Urutan Panah dan Y-Axis Presisi**: Pesan 1 sampai 8 tersusun runut dari atas ke bawah, tidak menabrak garis frame `alt`.
4. **Latar Belakang Teks Bersih (`labelBackgroundColor=#FFFFFF`)**: Teks pesan memiliki background putih bersih sehingga tidak bertabrakan dengan garis putus-putus.

---

# 1. SEQUENCE DIAGRAM: LOGIN & AUTENTIKASI PENGGUNA

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- FRAME LUAR -->
    <mxCell id="frame_seq1" value="Sequence Diagram: Login &amp; Autentikasi Pengguna" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=260;height=35;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="40" y="40" width="880" height="660" as="geometry" />
    </mxCell>

    <!-- 5 PARTISIPAN (LIFELINES) -->
    <!-- 1. User (Aktor Proporsional) -->
    <mxCell id="p1_user" value="User&#xa;(Pengguna)" style="shape=umlLifeline;participant=umlActor;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=top;spacingTop=45;size=65;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="80" y="90" width="40" height="580" as="geometry" />
    </mxCell>

    <!-- 2. View -->
    <mxCell id="p1_view" value="View: Login&#xa;(login.blade.php)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="230" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <!-- 3. Controller -->
    <mxCell id="p1_ctrl" value="Controller&#xa;(AuthController)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="430" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <!-- 4. Service -->
    <mxCell id="p1_svc" value="Service&#xa;(AuthService)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="630" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <!-- 5. Database -->
    <mxCell id="p1_db" value="Database&#xa;(MySQL / SQLite)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="800" y="90" width="110" height="580" as="geometry" />
    </mxCell>

    <!-- PESAN ALUR UTAMA (1-5) -->
    <mxCell id="m1_1" value="1. Input Email &amp; Password, Klik Masuk" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_user" target="p1_view">
      <mxGeometry relative="1" as="geometry"><mxPoint as="offset" /><Array as="points"><mxPoint x="180" y="180" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_2" value="2. POST /login (email, password)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_view" target="p1_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="215" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_3" value="3. attemptLogin(credentials)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_ctrl" target="p1_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="250" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_4" value="4. SELECT * FROM users WHERE email = ?" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_svc" target="p1_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="285" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_5" value="5. Return Record User &amp; Password Hash" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_db" target="p1_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="320" /></Array></mxGeometry>
    </mxCell>

    <!-- KOTAK ALT KONDISI -->
    <mxCell id="alt_box1" value="alt" style="shape=umlFrame;whiteSpace=wrap;html=1;width=60;height=25;fillColor=none;strokeColor=#475569;" vertex="1" parent="1">
      <mxGeometry x="65" y="350" width="840" height="290" as="geometry" />
    </mxCell>

    <!-- LABEL KONDISI 1 -->
    <mxCell id="txt_cond1" value="[Password Salah / Akun Nonaktif]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="380" width="200" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m1_6a" value="6a. Return false (Login Gagal)" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_svc" target="p1_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="405" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_7a" value="7a. Redirect Back with Error Message" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_ctrl" target="p1_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="435" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_8a" value="8a. Tampilkan Pesan Error: Email/Password Salah" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_view" target="p1_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="465" /></Array></mxGeometry>
    </mxCell>

    <!-- GARIS PEMISAH ALT -->
    <mxCell id="alt_line1" value="" style="line;strokeWidth=1;dashed=1;strokeColor=#475569;" edge="1" parent="1">
      <mxGeometry width="840" height="10" as="geometry"><mxPoint x="65" y="495" as="sourcePoint"/><mxPoint x="905" y="495" as="targetPoint"/></mxGeometry>
    </mxCell>

    <!-- LABEL KONDISI 2 -->
    <mxCell id="txt_cond2" value="[Kredensial Valid &amp; Akun Aktif]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="505" width="200" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m1_6b" value="6b. Return true &amp; Generate Sesi Login" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_svc" target="p1_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="535" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_7b" value="7b. Redirect to /dashboard" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_ctrl" target="p1_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="570" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m1_8b" value="8b. Tampilkan Beranda Dashboard Sesuai Role" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p1_view" target="p1_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="605" /></Array></mxGeometry>
    </mxCell>

  </root>
</mxGraphModel>
```

---

# 2. SEQUENCE DIAGRAM: PENDAFTARAN MASTER BARANG BARU & QR CODE

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- FRAME LUAR -->
    <mxCell id="frame_seq2" value="Sequence Diagram: Pendaftaran Master Barang Baru" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=270;height=35;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="40" y="40" width="880" height="660" as="geometry" />
    </mxCell>

    <!-- 5 PARTISIPAN -->
    <mxCell id="p2_user" value="User&#xa;(Admin / Staff)" style="shape=umlLifeline;participant=umlActor;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=top;spacingTop=45;size=65;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="80" y="90" width="40" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p2_view" value="View: Form Barang&#xa;(barang/create.blade.php)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="220" y="90" width="150" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p2_ctrl" value="Controller&#xa;(BarangController)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="430" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p2_svc" value="Service&#xa;(BarangService)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="630" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p2_db" value="Database&#xa;(MySQL / SQLite)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="800" y="90" width="110" height="580" as="geometry" />
    </mxCell>

    <!-- PESAN ALUR (1-8) -->
    <mxCell id="m2_1" value="1. Input Data Barang &amp; Klik Simpan" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_user" target="p2_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="180" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_2" value="2. POST /barang (form data)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_view" target="p2_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="220" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_3" value="3. storeBarang(validatedData)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_ctrl" target="p2_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="260" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_4" value="4. generateKodeBarang() &amp; renderQRCodeSVG()" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_svc" target="p2_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="730" y="295" /><mxPoint x="730" y="330" /><mxPoint x="700" y="330" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_5" value="5. INSERT INTO barang (kode, nama, qr_code, ...)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_svc" target="p2_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="375" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_6" value="6. Return Record Barang ID Berhasil Disimpan" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_db" target="p2_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="425" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_7" value="7. Return Barang Instance" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_svc" target="p2_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="475" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_8" value="8. Redirect route('barang.index') with Flash Success" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_ctrl" target="p2_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="525" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m2_9" value="9. Tampilkan Barang Baru &amp; QR Code pada Katalog" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p2_view" target="p2_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="575" /></Array></mxGeometry>
    </mxCell>

  </root>
</mxGraphModel>
```

---

# 3. SEQUENCE DIAGRAM: MUTASI LOKASI & PIC BARANG (AUTO-FILL & SCAN QR)

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- FRAME LUAR -->
    <mxCell id="frame_seq3" value="Sequence Diagram: Mutasi Lokasi &amp; PIC Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=250;height=35;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="40" y="40" width="880" height="660" as="geometry" />
    </mxCell>

    <!-- 5 PARTISIPAN -->
    <mxCell id="p3_user" value="User&#xa;(Staff / Admin)" style="shape=umlLifeline;participant=umlActor;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=top;spacingTop=45;size=65;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="80" y="90" width="40" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p3_view" value="View: Form Mutasi&#xa;(mutasi/create.blade.php)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="220" y="90" width="150" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p3_ctrl" value="Controller&#xa;(MutasiController)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="430" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p3_svc" value="Service&#xa;(BarangService)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="630" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p3_db" value="Database&#xa;(MySQL / SQLite)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="800" y="90" width="110" height="580" as="geometry" />
    </mxCell>

    <!-- PESAN ALUR (1-5) -->
    <mxCell id="m3_1" value="1. Scan QR / Pilih Barang, Isi Lokasi &amp; PIC Baru" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_user" target="p3_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="180" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_2" value="2. POST /mutasi (barang_id, jumlah, lokasi_tujuan, pic)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_view" target="p3_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="215" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_3" value="3. tambahMutasi(data, auth_user_id)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_ctrl" target="p3_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="250" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_4" value="4. SELECT stok FROM barang WHERE id = ?" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_svc" target="p3_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="285" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_5" value="5. Return Data Stok Tersedia" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_db" target="p3_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="320" /></Array></mxGeometry>
    </mxCell>

    <!-- ALT KONDISI STOK -->
    <mxCell id="alt_box3" value="alt" style="shape=umlFrame;whiteSpace=wrap;html=1;width=60;height=25;fillColor=none;strokeColor=#475569;" vertex="1" parent="1">
      <mxGeometry x="65" y="350" width="840" height="290" as="geometry" />
    </mxCell>

    <mxCell id="txt_m3_c1" value="[Jumlah Mutasi &gt; Stok Tersedia]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="380" width="200" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m3_6a" value="6a. Throw Error: Stok Tidak Mencukupi" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_svc" target="p3_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="405" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_7a" value="7a. Redirect Back with Validation Error" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_ctrl" target="p3_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="435" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_8a" value="8a. Tampilkan Pesan Peringatan Stok Tidak Cukup" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_view" target="p3_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="465" /></Array></mxGeometry>
    </mxCell>

    <!-- GARIS PEMISAH ALT -->
    <mxCell id="alt_line3" value="" style="line;strokeWidth=1;dashed=1;strokeColor=#475569;" edge="1" parent="1">
      <mxGeometry width="840" height="10" as="geometry"><mxPoint x="65" y="495" as="sourcePoint"/><mxPoint x="905" y="495" as="targetPoint"/></mxGeometry>
    </mxCell>

    <mxCell id="txt_m3_c2" value="[Jumlah Mutasi &lt;= Stok Tersedia]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="505" width="200" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m3_6b" value="6b. INSERT INTO mutasi_barang &amp; UPDATE barang SET lokasi, pic" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_svc" target="p3_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="535" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_7b" value="7b. Return Mutasi Instance" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_svc" target="p3_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="565" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_8b" value="8b. Redirect route('mutasi.index') with Success" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_ctrl" target="p3_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="595" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m3_9b" value="9b. Tampilkan Riwayat Mutasi Terbaru pada Tabel" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p3_view" target="p3_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="625" /></Array></mxGeometry>
    </mxCell>

  </root>
</mxGraphModel>
```

---

# 4. SEQUENCE DIAGRAM: PEMINJAMAN & PENGEMBALIAN BARANG INVENTARIS

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- FRAME LUAR -->
    <mxCell id="frame_seq4" value="Sequence Diagram: Peminjaman &amp; Pengembalian Barang" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=280;height=35;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="40" y="40" width="880" height="660" as="geometry" />
    </mxCell>

    <!-- 5 PARTISIPAN -->
    <mxCell id="p4_user" value="User&#xa;(Staff / Admin)" style="shape=umlLifeline;participant=umlActor;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=top;spacingTop=45;size=65;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="80" y="90" width="40" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p4_view" value="View: Peminjaman&#xa;(peminjaman/index.blade.php)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="220" y="90" width="160" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p4_ctrl" value="Controller&#xa;(PeminjamanController)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="430" y="90" width="140" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p4_svc" value="Service&#xa;(BarangService)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="630" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p4_db" value="Database&#xa;(MySQL / SQLite)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="800" y="90" width="110" height="580" as="geometry" />
    </mxCell>

    <!-- PESAN ALUR (1-3) -->
    <mxCell id="m4_1" value="1. Input Transaksi (Pinjam Baru / Pengembalian)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_user" target="p4_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="180" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_2" value="2. POST /peminjaman atau POST /pengembalian" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_view" target="p4_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="215" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_3" value="3. handleTransaksi(data, auth_user_id)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_ctrl" target="p4_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="250" /></Array></mxGeometry>
    </mxCell>

    <!-- ALT KONDISI (PINJAM vs KEMBALI) -->
    <mxCell id="alt_box4" value="alt" style="shape=umlFrame;whiteSpace=wrap;html=1;width=60;height=25;fillColor=none;strokeColor=#475569;" vertex="1" parent="1">
      <mxGeometry x="65" y="280" width="840" height="300" as="geometry" />
    </mxCell>

    <mxCell id="txt_m4_c1" value="[Siklus 1: Peminjaman Barang Baru]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="305" width="220" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m4_4a" value="4a. INSERT INTO peminjaman (status='dipinjam') &amp; UPDATE stok = stok - jml" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_svc" target="p4_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="340" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_5a" value="5a. Return Peminjaman Object (Status: Dipinjam)" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_db" target="p4_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="380" /></Array></mxGeometry>
    </mxCell>

    <!-- GARIS PEMISAH ALT -->
    <mxCell id="alt_line4" value="" style="line;strokeWidth=1;dashed=1;strokeColor=#475569;" edge="1" parent="1">
      <mxGeometry width="840" height="10" as="geometry"><mxPoint x="65" y="420" as="sourcePoint"/><mxPoint x="905" y="420" as="targetPoint"/></mxGeometry>
    </mxCell>

    <mxCell id="txt_m4_c2" value="[Siklus 2: Pengembalian Barang]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="430" width="220" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m4_4b" value="4b. INSERT INTO pengembalian &amp; UPDATE peminjaman status='dikembalikan' &amp; stok = stok + jml" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_svc" target="p4_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="470" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_5b" value="5b. Return Pengembalian Object (Status: Dikembalikan)" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_db" target="p4_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="520" /></Array></mxGeometry>
    </mxCell>

    <!-- RESPON SETELAH ALT -->
    <mxCell id="m4_6" value="6. Redirect with Success Flash Message" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_svc" target="p4_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="600" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_7" value="7. Render Updated View" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_ctrl" target="p4_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="620" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m4_8" value="8. Tampilkan Status &amp; Stok Barang Terkini pada Tabel" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p4_view" target="p4_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="640" /></Array></mxGeometry>
    </mxCell>

  </root>
</mxGraphModel>
```

---

# 5. SEQUENCE DIAGRAM: MONITORING STOK & CETAK LAPORAN (PDF & EXCEL)

### 📋 Kode XML Draw.io:
```xml
<mxGraphModel dx="1200" dy="800" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
  <root>
    <mxCell id="0" />
    <mxCell id="1" parent="0" />

    <!-- FRAME LUAR -->
    <mxCell id="frame_seq5" value="Sequence Diagram: Monitoring Stok &amp; Cetak Laporan" style="shape=umlFrame;whiteSpace=wrap;html=1;pointerEvents=0;width=270;height=35;fontStyle=1;fontSize=13;" vertex="1" parent="1">
      <mxGeometry x="40" y="40" width="880" height="660" as="geometry" />
    </mxCell>

    <!-- 5 PARTISIPAN -->
    <mxCell id="p5_user" value="User&#xa;(Pimpinan / Admin)" style="shape=umlLifeline;participant=umlActor;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=top;spacingTop=45;size=65;outlineConnect=0;" vertex="1" parent="1">
      <mxGeometry x="80" y="90" width="40" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p5_view" value="View: Laporan&#xa;(laporan/index.blade.php)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="220" y="90" width="150" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p5_ctrl" value="Controller&#xa;(LaporanController)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="430" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p5_svc" value="Service&#xa;(LaporanService)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="630" y="90" width="130" height="580" as="geometry" />
    </mxCell>

    <mxCell id="p5_db" value="Database&#xa;(MySQL / SQLite)" style="shape=umlLifeline;perimeter=lifelinePerimeter;whiteSpace=wrap;html=1;container=1;collapsible=0;recursiveResize=0;verticalAlign=middle;size=50;fontStyle=1;" vertex="1" parent="1">
      <mxGeometry x="800" y="90" width="110" height="580" as="geometry" />
    </mxCell>

    <!-- PESAN ALUR (1-5) -->
    <mxCell id="m5_1" value="1. Tentukan Filter &amp; Klik Cetak PDF / Excel" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_user" target="p5_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="180" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_2" value="2. GET /laporan/export (jenis, filter, format)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_view" target="p5_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="215" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_3" value="3. generateReport(jenis, filter, format)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_ctrl" target="p5_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="250" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_4" value="4. Query Builder: SELECT Data Inventori Sesuai Filter" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_svc" target="p5_db">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="285" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_5" value="5. Return Dataset Hasil Query Filter" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_db" target="p5_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="750" y="320" /></Array></mxGeometry>
    </mxCell>

    <!-- ALT PILIHAN EKSPOR -->
    <mxCell id="alt_box5" value="alt" style="shape=umlFrame;whiteSpace=wrap;html=1;width=60;height=25;fillColor=none;strokeColor=#475569;" vertex="1" parent="1">
      <mxGeometry x="65" y="350" width="840" height="200" as="geometry" />
    </mxCell>

    <mxCell id="txt_m5_c1" value="[Format Ekspor PDF]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="375" width="180" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m5_6a" value="6a. Render Dokumen PDF DomPDF Ber-Kop Surat Resmi" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_svc" target="p5_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="730" y="390" /><mxPoint x="730" y="420" /><mxPoint x="700" y="420" /></Array></mxGeometry>
    </mxCell>

    <!-- GARIS PEMISAH ALT -->
    <mxCell id="alt_line5" value="" style="line;strokeWidth=1;dashed=1;strokeColor=#475569;" edge="1" parent="1">
      <mxGeometry width="840" height="10" as="geometry"><mxPoint x="65" y="445" as="sourcePoint"/><mxPoint x="905" y="445" as="targetPoint"/></mxGeometry>
    </mxCell>

    <mxCell id="txt_m5_c2" value="[Format Ekspor Excel]" style="text;html=1;strokeColor=none;fillColor=none;fontStyle=2;fontSize=11;" vertex="1" parent="1">
      <mxGeometry x="75" y="455" width="180" height="20" as="geometry" />
    </mxCell>

    <mxCell id="m5_6b" value="6b. Generate Spreadsheet Excel (.xlsx)" style="html=1;verticalAlign=bottom;endArrow=block;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_svc" target="p5_svc">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="730" y="475" /><mxPoint x="730" y="505" /><mxPoint x="700" y="505" /></Array></mxGeometry>
    </mxCell>

    <!-- RESPON SETELAH ALT -->
    <mxCell id="m5_7" value="7. Return File Binary Stream Object" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_svc" target="p5_ctrl">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="580" y="570" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_8" value="8. HTTP Download Stream Response" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_ctrl" target="p5_view">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="380" y="600" /></Array></mxGeometry>
    </mxCell>

    <mxCell id="m5_9" value="9. Browser Otomatis Mengunduh File Dokumen Laporan" style="html=1;verticalAlign=bottom;endArrow=open;dashed=1;endSize=8;rounded=0;labelBackgroundColor=#FFFFFF;" edge="1" parent="1" source="p5_view" target="p5_user">
      <mxGeometry relative="1" as="geometry"><Array as="points"><mxPoint x="180" y="630" /></Array></mxGeometry>
    </mxCell>

  </root>
</mxGraphModel>
```
