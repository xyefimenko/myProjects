package denis.gui.buttons;

import denis.generated.Document;
import denis.generation.PetriNetwork;
import denis.gui.Controls;
import denis.gui.NetCanvas;

import javax.swing.*;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Unmarshaller;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseListener;
import java.io.File;

public class ImportButton extends JButton implements ActionListener {

    private NetCanvas canvas;

    private Start start;

    public ImportButton(NetCanvas canvas, Start start){
        setText("Import");
        this.canvas = canvas;
        this.start = start;
    }

    private Document importFile(File f) throws JAXBException {
        JAXBContext jaxbContext = JAXBContext.newInstance(Document.class);
        Unmarshaller jaxbUnmarshaller = jaxbContext.createUnmarshaller();
        Document document = (Document) jaxbUnmarshaller.unmarshal(f);
        return document;
    }



    @Override
    public void actionPerformed(ActionEvent e) {
        if (canvas.getMouseListeners().length > 0) {
            for (MouseListener listener : canvas.getMouseListeners()) {
                canvas.removeMouseListener(listener);
            }
            start.setText("Start");
        }
        JFileChooser fileChooser = new JFileChooser();
        File f = null;
        fileChooser.setFileSelectionMode(JFileChooser.FILES_ONLY);
        fileChooser.addChoosableFileFilter(new FileNameExtensionFilter("XML Documents", "xml"));
        fileChooser.setFileFilter(new FileNameExtensionFilter("XML Documents", "xml"));
        int result = fileChooser.showOpenDialog(null);
        if (result == JFileChooser.APPROVE_OPTION)
            f = fileChooser.getSelectedFile();
        if (f != null) {
            try {
                canvas.setNet(new PetriNetwork(importFile(f)));
            } catch (JAXBException ex) {
                ex.printStackTrace();
            }
            canvas.repaint();
        }
    }
}
