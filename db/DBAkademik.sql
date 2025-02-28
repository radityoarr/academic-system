USE [DBAkademik]
GO
/****** Object:  Table [dbo].[AmbilMK]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AmbilMK](
	[NRP] [char](10) NOT NULL,
	[ID_MK] [char](10) NOT NULL,
	[Nilai_Angka] [int] NULL,
	[Predikat] [varchar](2) NULL,
 CONSTRAINT [PK_AmbilMK] PRIMARY KEY CLUSTERED 
(
	[NRP] ASC,
	[ID_MK] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Asistensi]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Asistensi](
	[NRP] [char](10) NOT NULL,
	[NRP_Asisten] [char](10) NOT NULL,
	[Periode] [varchar](50) NULL,
 CONSTRAINT [PK_Asistensi] PRIMARY KEY CLUSTERED 
(
	[NRP] ASC,
	[NRP_Asisten] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Bimbingan]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Bimbingan](
	[ID_Dosen] [char](10) NOT NULL,
	[NRP] [char](10) NOT NULL,
	[Periode] [varchar](50) NULL,
 CONSTRAINT [PK_Bimbingan] PRIMARY KEY CLUSTERED 
(
	[ID_Dosen] ASC,
	[NRP] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Departemen]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Departemen](
	[ID_Dept] [char](10) NOT NULL,
	[ID_Dosen] [char](10) NOT NULL,
	[Nama] [varchar](50) NOT NULL,
	[Sekretariat] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Departemen] PRIMARY KEY CLUSTERED 
(
	[ID_Dept] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Dosen]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Dosen](
	[ID_Dosen] [char](10) NOT NULL,
	[Nama] [varchar](50) NOT NULL,
	[Alamat] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Dosen] PRIMARY KEY CLUSTERED 
(
	[ID_Dosen] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Mahasiswa]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mahasiswa](
	[NRP] [char](10) NOT NULL,
	[NRP_Komting] [char](10) NULL,
	[ID_Dosen] [char](10) NOT NULL,
	[Nama] [varchar](50) NOT NULL,
	[Alamat] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Mahasiswa] PRIMARY KEY CLUSTERED 
(
	[NRP] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MataKuliah]    Script Date: 2024-07-11 13:43:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MataKuliah](
	[ID_MK] [char](10) NOT NULL,
	[Nama] [varchar](50) NOT NULL,
	[Sks] [int] NOT NULL,
 CONSTRAINT [PK_MataKuliah] PRIMARY KEY CLUSTERED 
(
	[ID_MK] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[AmbilMK]  WITH CHECK ADD  CONSTRAINT [FK_AmbilMK_Mahasiswa] FOREIGN KEY([NRP])
REFERENCES [dbo].[Mahasiswa] ([NRP])
GO
ALTER TABLE [dbo].[AmbilMK] CHECK CONSTRAINT [FK_AmbilMK_Mahasiswa]
GO
ALTER TABLE [dbo].[AmbilMK]  WITH CHECK ADD  CONSTRAINT [FK_AmbilMK_MataKuliah] FOREIGN KEY([ID_MK])
REFERENCES [dbo].[MataKuliah] ([ID_MK])
GO
ALTER TABLE [dbo].[AmbilMK] CHECK CONSTRAINT [FK_AmbilMK_MataKuliah]
GO
ALTER TABLE [dbo].[Asistensi]  WITH CHECK ADD  CONSTRAINT [FK_Asistensi_Mahasiswa] FOREIGN KEY([NRP])
REFERENCES [dbo].[Mahasiswa] ([NRP])
GO
ALTER TABLE [dbo].[Asistensi] CHECK CONSTRAINT [FK_Asistensi_Mahasiswa]
GO
ALTER TABLE [dbo].[Asistensi]  WITH CHECK ADD  CONSTRAINT [FK_Asistensi_Mahasiswa1] FOREIGN KEY([NRP_Asisten])
REFERENCES [dbo].[Mahasiswa] ([NRP])
GO
ALTER TABLE [dbo].[Asistensi] CHECK CONSTRAINT [FK_Asistensi_Mahasiswa1]
GO
ALTER TABLE [dbo].[Bimbingan]  WITH CHECK ADD  CONSTRAINT [FK_Bimbingan_Dosen] FOREIGN KEY([ID_Dosen])
REFERENCES [dbo].[Dosen] ([ID_Dosen])
GO
ALTER TABLE [dbo].[Bimbingan] CHECK CONSTRAINT [FK_Bimbingan_Dosen]
GO
ALTER TABLE [dbo].[Bimbingan]  WITH CHECK ADD  CONSTRAINT [FK_Bimbingan_Mahasiswa] FOREIGN KEY([NRP])
REFERENCES [dbo].[Mahasiswa] ([NRP])
GO
ALTER TABLE [dbo].[Bimbingan] CHECK CONSTRAINT [FK_Bimbingan_Mahasiswa]
GO
ALTER TABLE [dbo].[Departemen]  WITH CHECK ADD  CONSTRAINT [FK_Departemen_Dosen] FOREIGN KEY([ID_Dosen])
REFERENCES [dbo].[Dosen] ([ID_Dosen])
GO
ALTER TABLE [dbo].[Departemen] CHECK CONSTRAINT [FK_Departemen_Dosen]
GO
ALTER TABLE [dbo].[Mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_Mahasiswa_Dosen] FOREIGN KEY([ID_Dosen])
REFERENCES [dbo].[Dosen] ([ID_Dosen])
GO
ALTER TABLE [dbo].[Mahasiswa] CHECK CONSTRAINT [FK_Mahasiswa_Dosen]
GO
ALTER TABLE [dbo].[Mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_Mahasiswa_Mahasiswa1] FOREIGN KEY([NRP_Komting])
REFERENCES [dbo].[Mahasiswa] ([NRP])
GO
ALTER TABLE [dbo].[Mahasiswa] CHECK CONSTRAINT [FK_Mahasiswa_Mahasiswa1]
GO
