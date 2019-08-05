CREATE TABLE usuarios (
  id INTEGER NOT NULL AUTO_INCREMENT,
  email VARCHAR(45) NOT NULL UNIQUE,
  nome VARCHAR(45) NOT NULL,
  usuario VARCHAR(45) NOT NULL UNIQUE,
  senha VARCHAR(45) NOT NULL,
  diretorio VARCHAR(45) NOT NULL,
  fotoperfil VARCHAR(300),
  CONSTRAINT pk_Usuario PRIMARY KEY(id)
);

CREATE TABLE perfil (
  idUsuario INTEGER NOT NULL,
  email VARCHAR(45) NOT NULL,
  publicações INTEGER,
  seguidores INTEGER,
  seguindo INTEGER,
  telefone VARCHAR(15),
  redeSocial VARCHAR(150),
  biografia VARCHAR(400),
  CONSTRAINT fk_idUsuario_Usuario FOREIGN KEY(idUsuario) REFERENCES usuarios(id),
  CONSTRAINT fk_email_Usuario FOREIGN KEY(email) REFERENCES usuarios(email),
  CONSTRAINT pk_Perfil PRIMARY KEY(idUsuario, email)
);

CREATE TABLE foto (
  idFoto INTEGER NOT NULL AUTO_INCREMENT,
  idUsuario INTEGER NOT NULL,
  diretorioFoto VARCHAR(400) NOT NULL,
  legenda VARCHAR(400),
  curtidas INTEGER,
  comentarios INTEGER,
  data datetime,
  CONSTRAINT pk_Foto PRIMARY KEY(idFoto)
);

CREATE TABLE curtida(
  idFoto INTEGER NOT NULL,
  idUsuario_Curtidor INTEGER NOT NULL,
  data datetime,
  CONSTRAINT fk_curtida_idFoto FOREIGN KEY(idFoto) REFERENCES foto(idFoto),
  CONSTRAINT fk_curtida_idUsuario_Curtidor FOREIGN KEY(idUsuario_Curtidor) REFERENCES usuarios(id),
  CONSTRAINT pk_curtida PRIMARY KEY(idFoto, idUsuario_Curtidor)
);

CREATE TABLE comentario(
  idFoto INTEGER NOT NULL,
  idUsuario_Comentador INTEGER NOT NULL,
  nome VARCHAR(50),
  comentario VARCHAR(400),
  data datetime,
  CONSTRAINT fk_comentario_idFoto FOREIGN KEY(idFoto) REFERENCES foto(idFoto),
  CONSTRAINT fk_comentarioidUsuario_Comentador FOREIGN KEY(idUsuario_Comentador) REFERENCES usuarios(id)
);

CREATE TABLE seguindo(
  idQuant INTEGER AUTO_INCREMENT NOT NULL,
  idUsuario INTEGER NOT NULL,
  idSeguido INTEGER NOT NULL,
  data datetime,
  CONSTRAINT fk_Usuario_Usuario FOREIGN KEY(idUsuario) REFERENCES usuarios(id),
  CONSTRAINT fk_Usuario_Seguido FOREIGN KEY(idSeguido) REFERENCES usuarios(id),
  CONSTRAINT pk_Seguindo_Usuario PRIMARY KEY(idQuant, idUsuario, idSeguido)
);
