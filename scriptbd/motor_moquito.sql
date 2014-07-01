create database motor_mosquito character set utf8 collate utf8_general_ci;
use motor_mosquito;


/*==============================================================*/
/* Table: TIPO_DE_VEHICULO                                      */
/*==============================================================*/
create table TIPO_DE_VEHICULO
(
   ID_TIPO_VEHICULO     int auto_increment,
   NOMBRE_TIPO_VEHICULO varchar(250),
   DESCRIPCION_TIPO_VEHICULO text not null,
   primary key (ID_TIPO_VEHICULO)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID_USUARIO           int auto_increment,
   NOMBRE               varchar(250),
   CORREO               varchar(100),
   PASSWORD             text not null,
   primary key (ID_USUARIO)
);

/*==============================================================*/
/* Table: VEHICULO                                              */
/*==============================================================*/
create table VEHICULO
(
   ID_VEHICULO          int auto_increment,
   ID_TIPO_VEHICULO     int not null,
   FABRICANTE_VEHICULO  varchar(250),
   MODELO_VEHICULO      varchar(250),
   ANIO_FABRICACION     date,
   DESCRIPCION_VEHICULO text,
   primary key (ID_VEHICULO)
);

alter table VEHICULO add constraint FK_VEHICULO_TIPO_VEHICULO foreign key (ID_TIPO_VEHICULO)references TIPO_DE_VEHICULO (ID_TIPO_VEHICULO);
