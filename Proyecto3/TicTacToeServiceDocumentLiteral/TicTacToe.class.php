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
	private $jugador;
	private $tablero = array('-','-', '-', '-', '-', '-', '-', '-', '-');
	//private $marcador = '';
	private $gameOver = false;
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
	public function __construct( $jugadorInicial = 0) {
		$this->jugador = $jugadorInicial;
		$this->gameOver = false;
		$this->tablero = $this->iniciarTablero();
		//Falta inicializar los 10 jugadores primeros
	}	

	/**
     * iniciarTablero(): Inicializa los 9 botones de las casillas del juego poniendo 
	 * numeros del 1 al 9
	 * Retorna 0 si inicio exitosamente 1 sino
	 * 
	 * @param array[string] $tablero
    */
	public function iniciarTablero(){
		$inicioExitoso = 0;
        for($i = 1; $i <= 9; $i++){
            $this->tablero[$i] = strval($i);
        }

		return $inicioExitoso;
    }

	/**
     * reiniciarJuego() = reinicia el tablero y las variables para volver a jugar
	 * Retorna 0 si inicio exitosamente 1 sino
	 * 
	 * @param array[string] $tablero
    */
    public function reiniciarJuego(){
		$reinicioExitoso = 0;
		$this->jugador = 0;
        $this->iniciarTablero();
        $this->gameOver = false;

		return $reinicioExitoso;
    }

	/**
     * boolean verificarEmpate casillas = verifica si ha ocurrido empate
     * Devuelve 0 si hubo empate, 1 sino
    */
    public function verificarEmpate(){
        $empate = 0;
        for($i = 1; $i < 9; $i++){
            if ($this->tablero[$i] >= '1' && $this->tablero[$i] <= '9')
                $empate = 1;
        }
        return $empate;
    }

	/**
     * int verificarGanador(int jugadorActual) = verifica si ya hay un ganador o si ocurrio empate
     * Recibe el jugador actual que tiene el turno activo y acaba de marcar casilla
     * Devuelve:
     *      - (-2) si el juego no ha terminado
     *      - (-1) si hubo empate
     *      - 0 si gano jugador que marca con O
     *      - 1 si gana jugador que marca X
    */
    public function verificarGanador($jugadorActual) {
        $resultado = -2;
        
        if(     ($this->tablero[0] == $this->tablero[1] && $this->tablero[1] == $this->tablero[2]) ||
                ($this->tablero[3] == $this->tablero[4] && $this->tablero[4] == $this->tablero[5]) ||
                ($this->tablero[6] == $this->tablero[7] && $this->tablero[7] == $this->tablero[8]) ||
                ($this->tablero[0] == $this->tablero[4] && $this->tablero[4] == $this->tablero[8]) ||
                ($this->tablero[6] == $this->tablero[4] && $this->tablero[4] == $this->tablero[2]) ||
                ($this->tablero[0] == $this->tablero[3] && $this->tablero[3] == $this->tablero[6]) ||
                ($this->tablero[1] == $this->tablero[4] && $this->tablero[4] == $this->tablero[7]) ||
                ($this->tablero[2] == $this->tablero[5] && $this->tablero[5] == $this->tablero[8])) {
            
            $resultado = $jugadorActual;
        }
        else {
			if ( $this->verificarEmpate() ) {
            	$resultado = -1;
			}
		}
        
        return $resultado;
    }	

	/**
	 * marcarCasilla(array(int)) = marca la casilla en el tablero segun jugador 
	 * Recibe un vector de int donde la primera posicion es el jugador y la segunda
	 * la casilla.
	 * Devuelve 0 si se marco exitosamente o 1 sino
	 *  
	 * @param array[int] $jugada
    */
    public function marcarCasilla($jugada){
		$casilla = $jugada - 1;
		$exitoso = 0;
		if ($this->jugador == 0) {
			if ($this->tablero[$casilla] != 'X' && $this->tablero[$casilla] != 'O') {
				$this->tablero[$casilla] = 'O';
				$this->jugador = 1;	//cambio para siguiente jugador
			}
			else {
				$exitoso = 1;
			}
		}
		else {
			if ($this->tablero[$casilla] != 'X' && $this->tablero[$casilla] != 'O') {
				$this->tablero[$casilla] = 'X';
				$this->jugador = 0;	//cambio para siguiente jugador
			}
			else {
				$exitoso = 1;
			}
		}

		return $exitoso;
	}
}

?>
