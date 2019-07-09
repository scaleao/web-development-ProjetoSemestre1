CREATE TABLE usuarios (
  id INTEGER NOT NULL AUTO_INCREMENT,
  email VARCHAR(45) NOT NULL UNIQUE,
  nome VARCHAR(45) NOT NULL,
  usuario VARCHAR(45) NOT NULL UNIQUE,
  senha VARCHAR(45) NOT NULL,
  diretorio VARCHAR(45) NOT NULL,
  CONSTRAINT pk_Usuario PRIMARY KEY(id)
);

CREATE TABLE perfil {
  idUsuario INTEGER NOT NULL,
  email VARCHAR(45) NOT NULL,
  publicações INTEGER,
  seguidores INTEGER,
  seguindo INTEGER,
  telefone VARCHAR(15),
  redeSocial VARCHAR(150),
  sobre VARCHAR(400),
  CONSTRAINT fk_idUsuario_Usuario FOREIGN KEY(idUsuario) REFERENCES usuarios(id),
  CONSTRAINT fk_email_Usuario FOREIGN KEY(email) REFERENCES usuarios(email),
  CONSTRAINT pk_Perfil PRIMARY KEY(idPerfil, email)
};

CREATE TABLE foto {
  idFoto INTEGER NOT NULL AUTO_INCREMENT,
  idUsuario INTEGER NOT NULL,
  diretorioFoto VARCHAR(45) NOT NULL,
  legenda VARCHAR(400),
  curtidas INTEGER,
  comentarios INTEGER,
  data date,
  CONSTRAINT fk_idUsuario_Usuario FOREIGN KEY(idUsuario) REFERENCES usuarios(id),
  CONSTRAINT fk_diretorioFoto FOREIGN KEY(diretorioFoto) REFERENCES usuarios(diretorio),
  CONSTRAINT pk_Foto PRIMARY KEY(idFoto, idUsuario)
};

CREATE TABLE curtida_comentario{
  idFoto INTEGER NOT NULL,
  idUsuario_Foto INTEGER NOT NULL,
  idUsuario_Curtidor INTEGER NOT NULL,
  comentou INTEGER NOT NULL,
  comentario VARCHAR(400),
  data date,
  CONSTRAINT fk_idFoto FOREIGN KEY(idFoto) REFERENCES foto(idFoto),
  CONSTRAINT fk_idUsuario_Foto FOREIGN KEY(idUsuario) REFERENCES foto(idUsuario),
  CONSTRAINT fk_idUsuario_Curtidor FOREIGN KEY(idUsuario_Curtidor) REFERENCES usuarios(id)
}

CREATE TABLE seguindo{
  idUsuario INTEGER NOT NULL,
  idSeguidor INTEGER NOT NULL,
  data date,
  CONSTRAINT fk_Seguindo_Usuario FOREIGN KEY(idUsuario) REFERENCES usuarios(id)
}
