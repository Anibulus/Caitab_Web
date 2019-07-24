create database Caitab;

use Caitab;

CREATE TABLE Empleado(
  ID_Emp INT NOT NULL AUTO_INCREMENT,
  Nombre_E VARCHAR(30) NOT NULL,
  Apellidos_E VARCHAR(40) NOT NULL,
  Domicilio_E VARCHAR(50),
  Fecha_Nac_E DATE,
  Esp_pue VARCHAR(30),
  Turno char,
  Tel_E VARCHAR(15) NOT NULL,
  Tel_Eme_E VARCHAR(15) NOT NULL,
  Estatus_E VARCHAR(15) NOT NULL,
  Email_E VARCHAR(30),
  ID_Usu INT NOT NULL,
  CONSTRAINT PK_Empleado PRIMARY KEY(ID_Emp));

CREATE TABLE Cliente(
  ID_Cli INT NOT NULL AUTO_INCREMENT,
  Nombre_C VARCHAR(30) NOT NULL,
  Apellidos_C VARCHAR(40) NOT NULL,
  Domicilio_C VARCHAR(50),
  Fecha_Nac_C DATE,
  Tel_C VARCHAR(15) NOT NULL,
  Tel_Eme_C VARCHAR(15) NOT NULL,
  Estatus_C VARCHAR(15) NOT NULL,
  Email_C VARCHAR(30),
  ID_Usu INT,
  CONSTRAINT PK_Cliente PRIMARY KEY(ID_Cli));

CREATE TABLE Cita(
  ID_Cita INT NOT NULL AUTO_INCREMENT,
  ID_Emp INT NOT NULL,
  ID_Cli INT NOT NULL,
  Fecha_Hora datetime,
  Consultorio smallint,
  CONSTRAINT PK_Cita PRIMARY KEY(ID_Cita));

CREATE TABLE Expediente(
  ID_Exp INT NOT NULL AUTO_INCREMENT,
  ID_Emp INT NOT NULL,
  ID_Cli INT NOT NULL,
  ID_Cita INT NOT NULL,
  Hora_Inicio TIME,
  Hora_Fin TIME,
  Descripcion TEXT,
  Conclusion TEXT,
  CONSTRAINT PK_Expediente PRIMARY KEY(ID_Exp));

CREATE TABLE Usuario(
  ID_Usu INT NOT NULL AUTO_INCREMENT,
  Usuario VARCHAR(20) NOT NULL,
  Contrasenia VARCHAR(30) NOT NULL,
  Tipo_Usuario VARCHAR(20),
  CONSTRAINT PK_Usuario PRIMARY KEY(ID_Usu));

CREATE TABLE Evento_Curso(
  ID_EC INT NOT NULL AUTO_INCREMENT,
  ID_Emp INT NOT NULL,
  Nombre_EC VARCHAR(40) NOT NULL,
  Fecha_In_EC DATE,
  Fecha_Fin_EC DATE,
  Hora_In_EC TIME,
  Hora_Fin_EC TIME,
  Descripcion_EC TEXT,
  CONSTRAINT PK_Eventos_Cursos PRIMARY KEY(ID_EC));

/*LLaves secundarias*/

ALTER TABLE Empleado
ADD CONSTRAINT FK_UsuEmp FOREIGN KEY (ID_Usu) REFERENCES Usuario(ID_Usu);

ALTER TABLE Cliente
ADD CONSTRAINT FK_UsuCli FOREIGN KEY (ID_Usu) REFERENCES Usuario(ID_Usu);

ALTER TABLE Cita
ADD CONSTRAINT FK_EmpCita FOREIGN KEY (ID_Emp) REFERENCES Empleado(ID_Emp);

ALTER TABLE Cita
ADD CONSTRAINT FK_CliCita FOREIGN KEY (ID_Cli) REFERENCES Cliente(ID_Cli);

ALTER TABLE Expediente
ADD CONSTRAINT FK_EmpExpe FOREIGN KEY (ID_Emp) REFERENCES Empleado(ID_Emp);

ALTER TABLE Expediente
ADD CONSTRAINT FK_CliExpe FOREIGN KEY (ID_Cli) REFERENCES Cliente(ID_Cli);

ALTER TABLE Expediente
ADD CONSTRAINT FK_CitExpe FOREIGN KEY (ID_Cita) REFERENCES Cita(ID_Cita);

ALTER TABLE Evento_Curso
ADD CONSTRAINT FK_EmpEC FOREIGN KEY (ID_Emp) REFERENCES Empleado(ID_Emp);

/*Registros*/

-- insert into Empleado(Nombre_E,Apellidos_E,Domicilio_E,Fecha_Nac_E,Esp_pue,Turno,Tel_E,Tel_Eme_E,Estatus_E,Email_E) values(
--Empleado y usuario
insert into Usuario(Usuario, Contrasenia, Tipo_Usuario) values ('anibulus','kagamine','E');
insert into Empleado(ID_Emp,Nombre_E,Apellidos_E,Domicilio_E,Fecha_Nac_E,Esp_pue,Turno,Tel_E,Tel_Eme_E,Estatus_E,Email_E,ID_Usu) values(null,'Luis Antonio','Preza Padilla','Arquimides 262', '1999-06-13', 'Programador','M','3318891000','3318891000','A','anibulusnn@gmail.com',1);
--Cliente
insert into Cliente(ID_Cli,Nombre_C,Apellidos_C,Domicilio_C,Fecha_Nac_C,Tel_C,Tel_Eme_C,Estatus_C,Email_C,ID_Usu) values (null,'Jorge Alberto','Preza Padilla','Godinez Loear 23','2007-08-27','3319902321','3319902321','A','jorge_alberto@gmail.com',1);
insert into cita(ID_Cita,ID_Emp,ID_Cli,Fecha_Hora,Consultorio) values (null, 1,1,'2019-07-23',2);
