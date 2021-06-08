package denis.generation;


import denis.exceptions.ArcException;
import denis.exceptions.SecondTheObjectCreationException;
import denis.exceptions.TheObjectCreationException;

import javax.xml.bind.annotation.*;
import java.awt.geom.Rectangle2D;

public class Arcs {

    protected long id;
    protected long sourceId;
    protected long destinationId;
    protected int multiplicity;
    protected Rectangle2D.Float removeDrawableArc = new Rectangle2D.Float();

    public Rectangle2D.Float getRemoveDrawableArc() {
        return removeDrawableArc;
    }

    public void setRemoveDrawableArc(Rectangle2D.Float removeDrawableArc) {
        this.removeDrawableArc = removeDrawableArc;
    }

    public Arcs(long sourceId, long destinationId, int multiplicity){
        this.sourceId = sourceId;
        this.destinationId = destinationId;
        this.multiplicity = multiplicity;
    }

    public Arcs(long id, long sourceId, long destinationId, int multiplicity){
        this.id = id;
        this.sourceId = sourceId;
        this.destinationId = destinationId;
        this.multiplicity = multiplicity;
    }

    public Arcs(){

    }

    public void setId(long id) {
        this.id = id;
    }

    public long getId() {
        return id;
    }

    public long getSourceId() {
        return sourceId;
    }

    public void setSourceId(long sourceId) {
        this.sourceId = sourceId;
    }

    public long getDestinationId() {
        return destinationId;
    }

    public void setDestinationId(long destinationId) {
        this.destinationId = destinationId;
    }

    public int getMultiplicity() {
        return multiplicity;
    }

    public void setMultiplicity(int multiplicity) {
        this.multiplicity = multiplicity;
    }

}
