create table mascotas(id int not null auto_increment primary key,especie varchar(20)not null,raza varchar(20) not null,detalle varchar(500) not null,fechaNacimiento datetime not null, estado enum('1','0'),rutaFoto varchar(200));
insert into mascotas values
('canino','Husky siberiano','Canino Bebe','24/08/2020','1','img/archivos/1.jpg');
(0,'canino','Pitbull','Canino Bebe Pitbull','24/08/2020','1','img/archivos/2.jpg');
(0,'canino','Pitbull','Blanco con Gris','24/08/2020','1','img/archivos/3.png');
(0,'canino','Bull dog','Canino Bebe Bull dog aleman','24/08/2020','1','img/archivos/4.jpg');