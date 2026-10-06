-- Salón recreativo · datos iniciales
-- Se ejecuta SOLO la primera vez que arranca MariaDB con el volumen vacío.
USE arcade;

CREATE TABLE IF NOT EXISTS ranking (
  id INT AUTO_INCREMENT PRIMARY KEY,
  jugador VARCHAR(40) NOT NULL,
  juego VARCHAR(40) NOT NULL,
  puntos INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO ranking (jugador, juego, puntos) VALUES
  ('PAC-ANA',   'Pac-Man',        48200),
  ('MARIO_84',  'Donkey Kong',    35100),
  ('LARA_C',    'Tetris',         61750),
  ('NEO',       'Space Invaders', 27900),
  ('BIMBA_XL',  'Pac-Man',        52300),
  ('ZELDA',     'Tetris',         58400),
  ('R2D2',      'Space Invaders', 31200),
  ('TRON',      'Donkey Kong',    29800),
  -- Moneda oculta: solo se ve consultando la tabla con el cliente SQL
  ('MONEDA-1: ARC-7X3K', 'secreto', 0);
