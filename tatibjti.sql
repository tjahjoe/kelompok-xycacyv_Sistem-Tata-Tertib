CREATE TABLE [dbo].[Users](
	[id_users] [nvarchar](20) NOT NULL,
	[password] [nvarchar](20) NOT NULL,
	[role] [nvarchar](10) NULL,
	[foto_diri] [nvarchar](max) NULL
	)

alter table Users
add primary key (id_users)

CREATE TABLE [dbo].[Admin](
	[nip] [nvarchar](20) NOT NULL,
	[email] [nvarchar](100) NULL,
	[notelp] [nvarchar](15) NULL,
	[status] [nvarchar](10) NULL,
	[nama_admin] [nvarchar](150) NULL
	)

alter table Admin
add primary key (nip)

alter table Admin
add constraint fk_Admin_nip
foreign key (nip) references Users(id_users)

alter table Admin 
add constraint uq_Admin_email unique (email)

alter table Admin 
add constraint uq_Admin_notelp unique (notelp)

CREATE TABLE [dbo].[Dosen](
	[nip] [nvarchar](20) NOT NULL,
	[email] [nvarchar](100) NULL,
	[notelp] [nvarchar](15) NULL,
	[status] [nvarchar](10) NULL,
	[nama_dosen] [varchar](100) NULL
	)

alter table Dosen
add primary key (nip)

alter table Dosen
add constraint fk_Dosen_nip
foreign key (nip) references Users(id_users)

alter table Dosen 
add constraint uq_Dosen_email unique (email)

alter table Dosen
add constraint uq_Dosen_notelp unique (notelp)

CREATE TABLE [dbo].[Mahasiswa](
	[nim] [nvarchar](20) NOT NULL,
	[notelp] [nvarchar](15) NULL,
	[nama_mahasiswa] [nvarchar](250) NULL,
	[email] [nvarchar](100) NULL,
	[nama_ortu] [nvarchar](100) NULL,
	[notelp_ortu] [nvarchar](15) NULL,
	[status] [nvarchar](10) NULL,
	[nip] [nvarchar](20) NOT NULL
	)

alter table Mahasiswa
add primary key (nim)

alter table Mahasiswa
add constraint fk_Mahasiswa_nim
foreign key (nim) references Users(id_users)

alter table Mahasiswa
add constraint fk_Mahasiswa_nip
foreign key (nip) references Dosen(nip)

alter table Mahasiswa
add constraint uq_Mahasiswa_email unique (email)

alter table Mahasiswa
add constraint uq_Mahasiswa_notelp unique (notelp)

CREATE TABLE [dbo].[ListPelanggaran](
	[id_list_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[nama_jenis_pelanggaran] [nvarchar](max) NULL,
	[tingkat_pelanggaran] [nvarchar](10) NULL,
	[status] [nvarchar](10) NOT NULL
	)

alter table ListPelanggaran
add primary key (id_list_pelanggaran)

CREATE TABLE [dbo].[TingkatPelanggaran](
	[id_tingkat_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[tingkat] [nvarchar](5) NULL,
	[deskripsi] [nvarchar](250) NOT NULL,
	[sanksi] [nvarchar](max) NULL
	)

alter table TingkatPelanggaran
add primary key (id_tingkat_pelanggaran)

CREATE TABLE [dbo].[PelanggaranMahasiswa](
	[id_pelanggaran_mhs] [int] IDENTITY(1,1) NOT NULL,
	[id_list_pelanggaran] [int] NOT NULL,
	[id_tingkat_pelanggaran] [int] NULL,
	[nim] [nvarchar](20) NOT NULL,
	[status] [nvarchar](10) NOT NULL,
	[catatan] [nvarchar](max) NULL,
	[pelapor] [nvarchar](20) NOT NULL,
	[tipe_pelapor] [nvarchar] (10) NOT NULL,
	[bukti_laporan] [nvarchar](max) NULL,
	[tgl_pelanggaran] [date] NULL
	)

alter table PelanggaranMahasiswa
add primary key (id_pelanggaran_mhs)

alter table PelanggaranMahasiswa
add constraint fk_Pelanggaran_idlist
foreign key (id_list_pelanggaran) references ListPelanggaran(id_list_pelanggaran)
on delete cascade
on update cascade

alter table PelanggaranMahasiswa
add constraint fk_Pelanggaran_idtingkat
foreign key (id_tingkat_pelanggaran) references TingkatPelanggaran(id_tingkat_pelanggaran)
on delete cascade
on update cascade

alter table PelanggaranMahasiswa
add constraint fk_Pelanggaran_nim
foreign key (nim) references Mahasiswa(nim)

alter table PelanggaranMahasiswa
add constraint fk_Pelanggaran_pelapor
foreign key (pelapor) references Users(id_users)

