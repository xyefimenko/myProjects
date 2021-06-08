package denis.gui;


import denis.gui.buttons.*;

import java.awt.*;


public class Controls extends Panel {
    private int id = 1;

    public Controls(final NetCanvas canvas) {
        Start start = new Start(canvas);
        ImportButton importButton = new ImportButton(canvas, start);
        PlaceButton placeButton = new PlaceButton(canvas);
        TransitionButton transitionButton = new TransitionButton(canvas);
        ArcButton arcButton = new ArcButton(canvas);
        ResetArcButton resetArcButton = new ResetArcButton(canvas);
        Delete delete = new Delete(canvas);
        ExportButton exportButton = new ExportButton(canvas);


        start.addActionListener(start);
        importButton.addActionListener(importButton);
        placeButton.addActionListener(placeButton);
        transitionButton.addActionListener(transitionButton);
        arcButton.addActionListener(arcButton);
        resetArcButton.addActionListener(resetArcButton);
        delete.addActionListener(delete);
        exportButton.addActionListener(exportButton);

        add(start);
        add(importButton);
        add(placeButton);
        add(transitionButton);
        add(arcButton);
        add(resetArcButton);
        add(delete);
        add(exportButton);


    }

}