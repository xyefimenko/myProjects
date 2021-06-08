package denis.gui.buttons;

import denis.generation.PetriNetwork;
import denis.generation.Place;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;

public class PlaceButton extends JButton implements ActionListener {

    private NetCanvas canvas;

    public PlaceButton(NetCanvas canvas){
        setText("Place");
        this.canvas = canvas;
    }


    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            setText("Place");
        } //else {
        //place.setText("Tapp");
        canvas.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseClicked(MouseEvent e) {
                int x = e.getX();
                int y = e.getY();
                if (canvas.getNet() == null)
                    canvas.setNet(new PetriNetwork());
                Place newPlace = new Place(" ", 0, canvas.getNet().getMaxId() + 1);
                newPlace.setX(x);
                newPlace.setY(y);
                canvas.getNet().addPlace(newPlace);
                canvas.getNet().setMaxId(canvas.getNet().getMaxId() + 1);
                canvas.repaint();
            }
        });
        //}
    }

}
