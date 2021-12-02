import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class TestOXGame {
    public static void main(String[] args) {
        MyOXGame myoxgame=new MyOXGame();
    }
}

class MyOXGame extends JFrame implements ActionListener {
    // Parte principal, dibujar GUI, editar respuesta relacionada
    JButton[] button;// Matriz de objetos, que representa nueve cuadrículas en el tablero de ajedrez
    JButton restart;//Tecla de reinicio
    JLabel judgement;// Árbitro, utilizado para mostrar el resultado del juego
    JPanel chessboard,basicPanel;// Tablero de ajedrez, la zona inferior del tablero
    int player=0;// Muestra el número de jugador actual
    boolean gameOverFlag=false;// Registra si el juego terminó, si el valor final es verdadero, deja de responder al evento

    MyOXGame(){// Generar función, generar juego
        setTitle("MY OXGAME");
        setBounds(500,500,300,300);// Configuración básica del formulario

        button=new JButton[10];
        restart=new JButton("Restart");
        chessboard=new JPanel();
        basicPanel=new JPanel();
        judgement=new JLabel("");
        chessboard.setLayout(new GridLayout(3,3));
        basicPanel.setLayout(new FlowLayout());// Configuración de inicialización de componentes


        add(chessboard,BorderLayout.CENTER);
        add(basicPanel,BorderLayout.SOUTH);
        basicPanel.add(restart);
        basicPanel.add(judgement);//Opciones de diseño

        initChessboard();// Inicialice el tablero de ajedrez, haga que los nueve botones agreguen 1-9 etiquetas en orden,
        addChessToChessboard(chessboard);// Agrega nueve botones al tablero de ajedrez
        restart.addActionListener(this);// Agrega un oyente

        buttonListener();// Agrega un oyente para el botón

        setVisible(true);// Configurar visualización
        setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);// Hace que la tecla de cierre sea útil
    }

    private void addChessToChessboard(JPanel chessboard){
        // Agregar botón al tablero
        for(int i=1;i<=9;i++) {
            chessboard.add(button[i]);
        }
    }

    private void initChessboard(){
        // Inicializa el botón de la pieza de ajedrez a 1-9
        for(int i=1;i<=9;i++){
            button[i]=new JButton(""+i);
        }
    }

    private void buttonListener(){
        // Agrega un oyente para el botón de pieza de ajedrez
        for(int i=1;i<=9;i++)
        {
            button[i].addActionListener(this);
        }
    }

    private void restartTheGame(){
        // Reinicia el juego
        chessboard.removeAll();// Debe usarse junto con repintado y updateUI, o nada, o sin cambios
        // Debe tenerse en cuenta que removell borrará el diseño
        chessboard.setLayout(new GridLayout(3,3));
        initChessboard();
        addChessToChessboard(chessboard);
        buttonListener();
        chessboard.updateUI();
        chessboard.repaint();

        judgement.setText("");
        gameOverFlag=false;
    }
    private boolean checkDogfall(char[] chess){
        // Comprueba si está lleno, es un empate
        for(int i=1;i<chess.length;i++){
            if (chess[i]>='1'&&chess[i]<='9')
                return false;
        }
        return true;
    }

    private int checkWinner(int playerNow) {
        // Verifica el estado actual del juego, -2 significa que no hay decisión, -1 significa empate. 0 significa que el jugador O gana, 1 significa que el jugador X gana
        char[] chess=new char[10];
        for(int i=1;i<=9;i++){
            chess[i]=button[i].getLabel().charAt(0);
        }
        if(     (chess[1]==chess[2]&&chess[2]==chess[3])||
                (chess[4]==chess[5]&&chess[5]==chess[6])||
                (chess[7]==chess[8]&&chess[8]==chess[9])||
                (chess[1]==chess[5]&&chess[5]==chess[9])||
                (chess[7]==chess[5]&&chess[5]==chess[3])||
                (chess[1]==chess[4]&&chess[4]==chess[7])||
                (chess[2]==chess[5]&&chess[5]==chess[8])||
                (chess[3]==chess[6]&&chess[6]==chess[9])){
            // Determinar si el jugador actual es el ganador
            return playerNow;
        }
        else if(checkDogfall(chess))
            return -1;
        return -2;
    }

    @Override
    public void actionPerformed(ActionEvent actionEvent) {
        // Responder al evento monitoreado
        int statueCode;
        JButton buttonSource=(JButton)actionEvent.getSource();
        if(buttonSource==restart){
            // Juzga si usar el botón de reinicio, si es así, reinicia el juego
            restartTheGame();
        }
        if (gameOverFlag==true) return;
        String buttonMark=buttonSource.getLabel();
        if(buttonMark.matches("[0-9]")){
            if(player==0) buttonSource.setLabel("O");
            else buttonSource.setLabel("X");
            statueCode=checkWinner(player);
            if(statueCode==0){
                judgement.setText("Player O wins the game! ");
                gameOverFlag=true;
            }
            else if(statueCode==1){
                judgement.setText("Player X wins the game!");
                gameOverFlag=true;
            }
            else if(statueCode==-1){
                judgement.setText("The game a draw!");
            }
            player=(player+1)%2;
        }
    }

}
