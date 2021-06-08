package denis.gui.buttons;

import denis.generation.*;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;
import java.util.Iterator;

public class Delete extends JButton implements ActionListener {

    private NetCanvas canvas;

    public Delete (NetCanvas canvas){
        setText("Delete");
        this.canvas = canvas;
    }


    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("Delete");
        }
        canvas.addMouseListener(new MouseAdapter() {

            @Override
            public void mouseClicked(MouseEvent e) {

                int x = e.getX();
                int y = e.getY();
                if (canvas.getNet() == null)
                    canvas.setNet(new PetriNetwork());

                Iterator<Place> placeIterator = canvas.getNet().getPlaces().iterator();
                while(placeIterator.hasNext()){
                    Place p = placeIterator.next();
                    if (x >= p.getX() && x <= p.getX() + 24 && y >= p.getY() && y <= p.getY() + 24) {
                        if (e.getButton() == MouseEvent.BUTTON1) {
                            Iterator<Arcs> arcIterator = canvas.getNet().getArcs().iterator();
                            Iterator<ResetArcs> resetArcsIterator = canvas.getNet().getResetArcs().iterator();
                            while(arcIterator.hasNext()){
                                Arcs arcs = arcIterator.next();
                                if(arcs.getSourceId() == p.getId() || arcs.getDestinationId() == p.getId()){
                                    arcIterator.remove();
                                }
                            }
                            while(resetArcsIterator.hasNext()){
                                ResetArcs resetArc = resetArcsIterator.next();
                                if(resetArc.getSourceId() == p.getId() || resetArc.getDestinationId() == p.getId()){
                                    resetArcsIterator.remove();
                                }
                            }
                            placeIterator.remove();
                            canvas.repaint();
                            break;
                        }
                    }
                }


                Iterator<Transition> transitionIterator = canvas.getNet().getTransitions().iterator();
                while(transitionIterator.hasNext()){
                    Transition  t = transitionIterator.next();
                    if (x >= t.getX() && x <= t.getX() + 24 && y >= t.getY() && y <= t.getY() + 24) {
                        if (e.getButton() == MouseEvent.BUTTON1) {
                            Iterator<Arcs> arcIterator = canvas.getNet().getArcs().iterator();
                            Iterator<ResetArcs> resetArcsIterator = canvas.getNet().getResetArcs().iterator();
                            while(arcIterator.hasNext()){
                                Arcs arcs = arcIterator.next();
                                if(arcs.getSourceId() == t.getId() || arcs.getDestinationId() == t.getId()){
                                    arcIterator.remove();
                                }
                            }
                            while(resetArcsIterator.hasNext()){
                                ResetArcs resetArc = resetArcsIterator.next();
                                if(resetArc.getSourceId() == t.getId() || resetArc.getDestinationId() == t.getId()){
                                    resetArcsIterator.remove();
                                }
                            }
                            transitionIterator.remove();
                            canvas.repaint();
                            break;
                        }
                        canvas.repaint();
                    }
                }

                        Iterator<Arcs> arcIterator = canvas.getNet().getArcs().iterator();
                        while(arcIterator.hasNext()){
                            Arcs  a = arcIterator.next();
                            if(a.getRemoveDrawableArc().contains(x, y)){
                                arcIterator.remove();
                                canvas.repaint();
                                break;
                            }
                        }
            }
        });
    }


}
