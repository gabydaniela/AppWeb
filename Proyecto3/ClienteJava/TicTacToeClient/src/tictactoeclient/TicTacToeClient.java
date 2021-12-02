package tictactoeclient;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

/**
 *
 * @author Daniela Quesada
 */
public class TicTacToeClient {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        TicTacToe tictactoe = new TicTacToe();
    }
}

class TicTacToe extends JFrame implements ActionListener {
    JButton[] botones;      //Casillas del tablero
    JButton reiniciar;
    JLabel resultados;      //Parte inferior para mostrar resultados o informacion del juego
    JPanel tablero;         //Parte que contiene el tablero
    JPanel panelInferior;   //Parte inferior de la ventana
    int jugador = 0;        //Muestra el jugador actual
    boolean gameOver = false;   //Indica si el juego termino ya 

    TicTacToe(){
        setTitle("Tic-Tac-Toe");
        setBounds(500,500,300,300);// Configuración básica del formulario

        botones = new JButton[10];
        reiniciar = new JButton("Reiniciar");
        tablero = new JPanel();
        panelInferior = new JPanel();
        resultados = new JLabel("");
        tablero.setLayout(new GridLayout(3,3));
        panelInferior.setLayout(new FlowLayout());


        add(tablero,BorderLayout.CENTER);
        add(panelInferior,BorderLayout.SOUTH);
        panelInferior.add(reiniciar);
        panelInferior.add(resultados);

        iniciarTablero();
        agregarCasillasTablero(tablero);
        reiniciar.addActionListener(this);

        botonesListener();

        setVisible(true);
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);  //Para que la X cierre la ventana
    }

    /*
     * agregarCasillasTablero(JPanel tablero) = agregar los 9 botones de las casillas al tablero.
     + recibe el tablero.
    */
    private void agregarCasillasTablero(JPanel tablero){
        for(int i = 1; i <= 9; i++) {
            tablero.add(botones[i]);
        }
    }

    /*
     * iniciarTablero(): Inicializa los 9 botones de las casillas del juego poniendo guiones
    */
    private void iniciarTablero(){
        for(int i = 1; i <= 9; i++){
            botones[i] = new JButton("" + i);
        }
    }

    /*
     * botonesListener() = agrega el listener de eventos a los botones de las casillas
    */
    private void botonesListener(){
        for(int i = 1; i <= 9; i++)
        {
            botones[i].addActionListener(this);
        }
    }

    /*
     * reiniciarJuego() = reinicia el tablero y las variables para volver a jugar
    */
    private void reiniciarJuego(){
        tablero.removeAll();
        tablero.setLayout(new GridLayout(3,3));
        iniciarTablero();
        agregarCasillasTablero(tablero);
        botonesListener();
        tablero.updateUI();
        tablero.repaint();

        resultados.setText("");
        gameOver=false;
    }
    
    /*
     * boolean checkDogfall(char[] casillas = verifica si ha ocurrido empate
     * Recibe el vector con las casillas del tablero
     * Devuelve true si hubo empate, false sino
    */
    private boolean verificarEmpate(char[] casillas){
        boolean retorno = true;
        for(int i = 1; i < casillas.length; i++){
            if (casillas[i] >= '1' && casillas[i] <= '9')
                retorno = false;
        }
        return retorno;
    }

    /*
     * int verificarGanador(int jugadorActual) = verifica si ya hay un ganador o si ocurrio empate
     * Recibe el jugador actual que tiene el turno activo y acaba de marcar casilla
     * Devuelve:
     *      - (-2) si el juego no ha terminado
     *      - (-1) si hubo empate
     *      - 0 si gano jugador que marca con O
     *      - 1 si gana jugador que marca X
    */
    private int verificarGanador(int jugadorActual) {
        char[] casillas = new char[10];
        int retorno = -2;
        for(int i = 1; i <= 9; i++){
            casillas[i] = botones[i].getLabel().charAt(0);
        }
        if(     (casillas[1] == casillas[2] && casillas[2] == casillas[3])||
                (casillas[4] == casillas[5] && casillas[5] == casillas[6])||
                (casillas[7] == casillas[8] && casillas[8] == casillas[9])||
                (casillas[1] == casillas[5] && casillas[5] == casillas[9])||
                (casillas[7] == casillas[5] && casillas[5] == casillas[3])||
                (casillas[1] == casillas[4] && casillas[4] == casillas[7])||
                (casillas[2] == casillas[5] && casillas[5] == casillas[8])||
                (casillas[3] == casillas[6] && casillas[6] == casillas[9])){
            
            retorno = jugadorActual;
        }
        else if(verificarEmpate(casillas))
            retorno = -1;
        
        return retorno;
    }

    /*
     * actionPerformed(ActionEvent actionEvent) = Responde al evento de presionar el boton de la casilla
     * Recibe el evento.
    */
    @Override
    public void actionPerformed(ActionEvent actionEvent) {
        int estado;
        JButton botonEvento = (JButton)actionEvent.getSource();
        
        //Si se presiono el boton de reiniciar
        if(botonEvento == reiniciar){
            reiniciarJuego();
        }
        
        //Si ya se terminó el juego no respondo al evento
        if (gameOver == true) return;
        
        String buttonMark = botonEvento.getLabel();
        if(buttonMark.matches("[0-9]")){
            if(jugador == 0) botonEvento.setLabel("O");
            else botonEvento.setLabel("X");
            
            estado = verificarGanador(jugador);
            if(estado == 0){  //Gano O
                resultados.setText("Gana el Jugador O. ");
                gameOver = true;
            }
            else if(estado == 1){ //Gano X
                resultados.setText("Gana el Jugador X");
                gameOver = true;
            }
            else if(estado == -1){  //Hubo empate
                resultados.setText("EMPATE");
            }
            jugador = (jugador + 1) % 2;
        }
    }

}
