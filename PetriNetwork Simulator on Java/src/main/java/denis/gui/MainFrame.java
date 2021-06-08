package denis.gui;
import javax.swing.*;
import java.awt.*;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;

public class MainFrame extends JFrame {

    public MainFrame(Dimension d){
        addWindowListener(new WindowAdapter(){
            public void windowClosing(WindowEvent e) {
                dispose();
            }
        });
        this.setSize((int)d.getWidth(), (int)d.getHeight());
        this.setLayout(new BorderLayout());
        NetCanvas canvas = new NetCanvas(new Dimension((int) d.getWidth(), (int) d.getHeight() - 20));
        Controls controls = new Controls(canvas);
        this.add(controls, BorderLayout.NORTH);
        this.add(canvas, BorderLayout.CENTER);
        canvas.repaint();
    }
}
