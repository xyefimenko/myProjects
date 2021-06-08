package denis.generation;

import denis.generated.Arc;
import denis.generated.ArcType;
import denis.generated.Document;
import denis.gui.NetCanvas;

import javax.swing.*;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;
import java.io.File;

public class MoveObjectsToDocumentForMarshal {

    public Document transform(PetriNetwork net){
        Document document = new Document();

        for(Place place : net.getPlaces()){
            denis.generated.Place newPlace = new denis.generated.Place();
            newPlace.setId((int)place.getId());
            newPlace.setX(place.getX());
            newPlace.setY(place.getY());
            newPlace.setLabel(place.getName());
            document.getPlace().add(newPlace);
        }

        for (Transition transition : net.getTransitions()){
            denis.generated.Transition newTransition = new denis.generated.Transition();
            newTransition.setId((int)transition.getId());
            newTransition.setX(transition.getX());
            newTransition.setY(transition.getY());
            newTransition.setLabel(transition.getName());
            document.getTransition().add(newTransition);
        }


        for(Arcs arc : net.getArcs()){
            denis.generated.Arc newArc = new denis.generated.Arc();
            newArc.setId((short)arc.getId());
            newArc.setSourceId((short)arc.getSourceId());
            newArc.setDestinationId((short)arc.getDestinationId());
            newArc.setMultiplicity((short) arc.getMultiplicity());
            newArc.setType(ArcType.REGULAR);
            document.getArc().add(newArc);
        }



        JFileChooser fileChooser = new JFileChooser(new File("./src/main/resources").getPath());
        fileChooser.setAcceptAllFileFilterUsed(false);
        FileNameExtensionFilter filter = new FileNameExtensionFilter(".xml File", "xml");
        fileChooser.addChoosableFileFilter(filter);
        int value = fileChooser.showOpenDialog(null);
        if (value == JFileChooser.APPROVE_OPTION) {
            try {
                File selectedFile = fileChooser.getSelectedFile();
                JAXBContext jaxbContext = JAXBContext.newInstance(Document.class);
                Marshaller marshaller = jaxbContext.createMarshaller();
                marshaller.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, true);
                marshaller.setProperty(Marshaller.JAXB_ENCODING, "UTF-8");
                marshaller.marshal(document, new File(selectedFile.getPath()));
            } catch (JAXBException ex) {
                ex.printStackTrace();
            }
        }
        return document;
    }

}
