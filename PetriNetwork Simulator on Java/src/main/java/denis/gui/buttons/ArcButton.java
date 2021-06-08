package denis.gui.buttons;

import denis.exceptions.ArcException;
import denis.generation.Arcs;
import denis.generation.PetriNetwork;
import denis.generation.Place;
import denis.generation.Transition;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;
import java.awt.geom.Rectangle2D;

public class ArcButton extends JButton implements ActionListener {


    private NetCanvas canvas;

    public ArcButton (NetCanvas canvas){
        setText("Arc");
        this.canvas = canvas;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("Arc");
        } //else {
        // arc.setText("Tapp");
        canvas.addMouseListener(new MouseAdapter() {
            Arcs newArc = new Arcs(0, 0, 1);

            @Override
            public void mouseClicked(MouseEvent e) {
                int x = e.getX();
                int y = e.getY();

                if (canvas.getNet() == null)
                    canvas.setNet(new PetriNetwork());
                for (Place p : canvas.getNet().getPlaces()) {
                    if (x >= p.getX() && x <= p.getX() + 24 && y >= p.getY() && y <= p.getY() + 24) {
                        if (e.getButton() == MouseEvent.BUTTON1) {
                            if (newArc.getSourceId() == 0) {
                                newArc.setSourceId((short) p.getId());
                                canvas.repaint();
                                break;
                            } else {
                                newArc.setDestinationId((short) p.getId());
                                try {
                                    canvas.getNet().addArc(canvas.getNet().getMaxId() + 1 ,newArc.getSourceId(), newArc.getDestinationId(), 1);
                                } catch (ArcException e1) {
                                    e1.printStackTrace();
                                }
                                newArc.setSourceId(0);
                                newArc.setDestinationId(0);
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
                            if (newArc.getSourceId() == 0) {
                                newArc.setSourceId((short) t.getId());
                                canvas.repaint();
                                break;
                            } else {
                                newArc.setDestinationId((short) t.getId());
                                try {
                                    canvas.getNet().addArc(canvas.getNet().getMaxId() + 1, newArc.getSourceId(), newArc.getDestinationId(), 1);
                                } catch (ArcException e1) {
                                    e1.printStackTrace();
                                }
                                newArc.setSourceId(0);
                                newArc.setDestinationId(0);
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
