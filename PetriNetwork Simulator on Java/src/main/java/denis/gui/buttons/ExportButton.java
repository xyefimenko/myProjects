package denis.gui.buttons;

import denis.generation.*;
import denis.gui.NetCanvas;

import javax.swing.*;
import java.awt.event.*;
import java.util.Iterator;

public class ExportButton extends JButton implements ActionListener {

    private NetCanvas canvas;

    public ExportButton (NetCanvas canvas){
        setText("Export");
        this.canvas = canvas;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
        }


        MoveObjectsToDocumentForMarshal moveObjectsToDocumentForMarshal = new MoveObjectsToDocumentForMarshal();
        moveObjectsToDocumentForMarshal.transform(canvas.getNet());


    }


    }



