CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticias` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` varchar(8000) NOT NULL,
  `fecha` timestamp not null default now(),
  PRIMARY KEY (`id_noticias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `usuariosnoticias` (
  `id_usuarionot` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuarionot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
