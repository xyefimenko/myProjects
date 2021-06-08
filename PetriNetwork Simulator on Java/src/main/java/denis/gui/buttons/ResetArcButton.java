package denis.gui.buttons;

import denis.exceptions.ArcException;
import denis.generation.PetriNetwork;
import denis.generation.Place;
import denis.generation.ResetArcs;
import denis.generation.Transition;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;

public class ResetArcButton extends JButton implements ActionListener {

    private NetCanvas canvas;

    public ResetArcButton (NetCanvas canvas){
        setText("ResetArc");
        this.canvas = canvas;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("ResetArc");
        } //else {
        // resetArc.setText("Tapp");
        canvas.addMouseListener(new MouseAdapter() {
            ResetArcs newResetArcs = new ResetArcs(0, 0);

            @Override
            public void mouseClicked(MouseEvent e) {
                int x = e.getX();
                int y = e.getY();

                if (canvas.getNet() == null)
                    canvas.setNet(new PetriNetwork());
                for (Place p : canvas.getNet().getPlaces()) {
                    if (x >= p.getX() && x <= p.getX() + 24 && y >= p.getY() && y <= p.getY() + 24) {
                        if (e.getButton() == MouseEvent.BUTTON1) {
                            if (newResetArcs.getSourceId() == 0) {
                                newResetArcs.setSourceId((short) p.getId());
                                canvas.repaint();
                                break;
                            } else {
                                newResetArcs.setDestinationId((short) p.getId());
                                try {
                                    canvas.getNet().addResetArc(newResetArcs.getSourceId(), newResetArcs.getDestinationId());
                                } catch (ArcException e1) {
                                    e1.printStackTrace();
                                }
                                newResetArcs.setSourceId(0);
                                newResetArcs.setDestinationId(0);
                                canvas.repaint();
                                break;
                            }
                        }
                    }
                    canvas.repaint();
                }
                for (Transition t : canvas.getNet().getTransitions()) {
                    if (x >= t.getX() && x <= t.getX() + 24 && y >= t.getY() && y <= t.getY() + 24) {
                        if (e.getButton() == MouseEvent.BUTTON1) {


                            if (newResetArcs.getSourceId() == 0) {
                                newResetArcs.setSourceId((short) t.getId());
                                canvas.repaint();
                                break;
                            } else {
                                newResetArcs.setDestinationId((short) t.getId());
                                try {
                                    canvas.getNet().addResetArc(newResetArcs.getSourceId(), newResetArcs.getDestinationId());
                                } catch (ArcException e1) {
                                    e1.printStackTrace();
                                }
                                newResetArcs.setSourceId(0);
                                newResetArcs.setDestinationId(0);
                                canvas.repaint();
                                break;
                            }
                        }
                        canvas.repaint();
                    }
                }
            }
        });
        //}
    }

}
