package denis.gui.buttons;

import denis.generation.PetriNetwork;
import denis.generation.Transition;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;

public class TransitionButton extends JButton implements ActionListener {

    private NetCanvas canvas;

    public TransitionButton(NetCanvas canvas){
        setText("Transition");
        this.canvas = canvas;
    }


    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("Transition");
        } //else {
        //  transition.setText("Tapp");
        canvas.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseClicked(MouseEvent e) {
                int x = e.getX();
                int y = e.getY();
                if (canvas.getNet() == null)
                    canvas.setNet(new PetriNetwork());
                Transition newTransition = new Transition("", canvas.getNet().getMaxId() + 1);
                newTransition.setX(x);
                newTransition.setY(y);
                canvas.getNet().addTransition(newTransition);
                canvas.getNet().setMaxId(canvas.getNet().getMaxId() + 1);
                canvas.repaint();
            }
        });
        //}
    }

}
