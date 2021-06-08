package denis.gui.buttons;

import denis.generation.Place;
import denis.generation.Transition;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;

public class Start extends JButton implements ActionListener {

    private NetCanvas canvas;

    public Start(NetCanvas canvas){
        setText("Start");
        this.canvas = canvas;
    }



    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("Start");
        } else {
            setText("Stop");
            canvas.addMouseListener(new MouseAdapter() {
                @Override
                public void mouseClicked(MouseEvent e) {
                    int x = e.getX();
                    int y = e.getY();
                    if (canvas.getNet() != null) {
                        for (Transition t : canvas.getNet().getTransitions()) {
                            if (x >= t.getX() && x <= t.getX() + 24 && y >= t.getY() && y <= t.getY() + 24) {
                                if (canvas.getNet().getTransition(t.getId()).isRunnable()) {
                                    canvas.getNet().runTransition(t.getId());
                                    canvas.repaint();
                                } else {
                                    JOptionPane.showMessageDialog(canvas, "Transitionion is not executable");
                                }
                            }
                        }
                        for (Place p : canvas.getNet().getPlaces()) {
                            if (x >= p.getX() && x <= p.getX() + 24 && y >= p.getY() && y <= p.getY() + 24) {
                                if (e.getButton() == MouseEvent.BUTTON1)
                                    p.changeTokens(1);
                                else if (e.getButton() == MouseEvent.BUTTON3) {
                                    if (p.getTokens() > 0)
                                        p.changeTokens(-1);
                                    else
                                        JOptionPane.showMessageDialog(canvas, "Place can't contain less then 0 marks");
                                }
                            }
                            canvas.repaint();
                        }
                    }
                }
            });
        }
    }

}
