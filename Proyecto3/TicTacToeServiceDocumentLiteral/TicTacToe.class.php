<?php
  
/**
 * 
 * Código realizado por Daniela Quesada Aguilar
 * para el curso "Desarrollo de Aplicaciones Web" II semestre 2021
 * de la Universidad de Costa Rica
 * 
 * Noviembre 2021
 */


/**
 * TicTacToe Clase implementa la lógica del juego TicTacToe
 * 
 * @package SoapDiscovery
 * @author Daniela Quesada Aguilar
 * @access public
 **/
class TicTacToe {
	private $jugador1 = '';
	private $jugador2 = '';
	//private $tablero = array('1','2', '3', '4', '5', '6', '7', '8', '9');
	private $tablero = array('-','-', '-', '-', '-', '-', '-', '-', '-');
	private $marcador = '';
	private $ganador = '';
	private $primeros10 = array(
		1 => array( 'jugador' => 0 ),
		2 => array( 'jugador2' => 0 ),
		3 => array( 'jugador3' => 0 ),
		4 => array( 'jugador4' => 0 ),
		5 => array( 'jugador5' => 0 ),
		6 => array( 'jugador6' => 0 ),
		7 => array( 'jugador7' => 0 ),
		8 => array( 'jugador8' => 0 ),
		9 => array( 'jugador9' => 0 ),
		10 => array( 'jugador10' => 0 ),
	);
	
	/**
	 * TicTacToe::__construct() Constructor de la clase TicTacToe.
	 * Asumimos que el jugador1 marcara con 'X' y el jugador2 con 'O'
	 * 
	 * @param array[string] $jugadores
	 **/
	public function __construct( $jugadores = array('', '') ) {
		$this->jugador1 = $jugadores[0];
		$this->jugador2 = $jugadores[1];
		$this->marcador = 'X'; //primer jugador marca con X
	}

	/**
	 * TicTacToe::iniciar() Inicia el juego con los nombres de los jugadores
	 * 
	 * @param array[string] $jugadores
	 * @return int
	 */
	public function iniciar($jugadores) {
		$this->jugador1 = $jugadores[0];
		$this->jugador2 = $jugadores[1];

		return 0;
	}
	
	/**
	 * TicTacToe::marcarCasilla() Marca la casilla seleccionada por el jugador
	 * Asumimos que el jugador1 marcara con 'X' y el jugador2 con 'O'.
	 * Retorna el tablero del juego
	 * 
	 * @param int $casilla
	 * @return array[strings]
	 **/
	public function marcarCasilla($casilla) {
		$posicion = $casilla - 1;

		//Verifico si la casilla no estaba marcada
		if ($this->tablero == '-'){
			$this->tablero[$posicion] = $this->marcador; //marco posicion

			//Verifico que si con marcar esa casilla no se ha terminado el juego
			verificarGanador($this->marcador, $casilla);

			//actualizo marcador para siguiente turno
			if ($this->marcador == 'X') {
				$this->marcador = 'O';
			}
			else {
				$this->marcador = 'X';
			}
		}

		return $this->tablero;
	}

	/**
	 * TicTacToe::verificarGanador() Determina si el juego ya terminó con la ultima casilla marcada, establece si hay ganador o empate.
	 * 
	 * @param string $jugador
	 * @param int $casilla
	 */
	public function verificarGanador($marca, $casilla) {
		$empate = true;
		//determino jugador actual 
		$jugadorActual = '';
		if ($marca == 'X') {
			$jugadorActual = $this->jugador1;
		}
		else {
			$jugadorActual = $this->jugador2;
		}

		//valido si ya hay ganador
		switch($casilla){
			case 1:
				if ( ($this->tablero[1] == $marca && $this->tablero[2] == $marca) ||
				($this->tablero[3] == $marca && $this->tablero[6] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[8] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 2:
				if ( ($this->tablero[0] == $marca && $this->tablero[2] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[7] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 3:
				if ( ($this->tablero[0] == $marca && $this->tablero[1] == $marca) ||
				($this->tablero[5] == $marca && $this->tablero[8] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[6] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 4:
				if ( ($this->tablero[0] == $marca && $this->tablero[6] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[5] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 5:
				if ( ($this->tablero[0] == $marca && $this->tablero[8] == $marca) ||
				($this->tablero[1] == $marca && $this->tablero[7] == $marca) ||
				($this->tablero[3] == $marca && $this->tablero[5] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 6:
				if ( ($this->tablero[2] == $marca && $this->tablero[8] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[3] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 7:
				if ( ($this->tablero[0] == $marca && $this->tablero[3] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[2] == $marca) ||
				($this->tablero[7] == $marca && $this->tablero[8] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 8:
				if ( ($this->tablero[6] == $marca && $this->tablero[8] == $marca) ||
				($this->tablero[4] == $marca && $this->tablero[1] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;

			case 9:
				if ( ($this->tablero[0] == $marca && $this->tablero[4] == $marca) ||
				($this->tablero[5] == $marca && $this->tablero[2] == $marca) ||
				($this->tablero[7] == $marca && $this->tablero[6] == $marca)
				){
					$this->ganador = $jugadorActual;
					$empate = false;
				}
				break;
		}

		$indice = 0;
		while ($empate && $indice < 9) {
			if ($this->tablero[$indice] == '-' ) {
				$empate = false;
			}
			$indice++;
		}
		if ($indice == 9 && $empate) {
			$this->ganador = 'EMPATE';
		}
	}
	
	/**
	 * TicTacToe::getGanador() Devuelve '' si no ha terminado eñ juego, el nombre del jugador si ya hay un ganador 
	 * o 'EMPATE' si ha ocurrido un empate
	 * 
	 * @return string 
	 **/
	public function getGanador() {
		return $this->ganador;
	}
	
	/**
	 * TicTacToe::top10() Devuelve los 10 jugadores con mejores tiempos
	 * 
	 * @return array[string]
	 **/
	public function top10() {
		return $this->primeros10;
	}
}

?>
