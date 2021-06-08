package denis.generation;

import denis.exceptions.SecondTheObjectCreationException;
import denis.exceptions.StartedPointException;
import denis.exceptions.TheObjectCreationException;

public class ResetArcs extends Arcs {
    public ResetArcs(long sourceId, long destinationId){
        super(sourceId, destinationId, 1);
    }

    public ResetArcs(){

    }

}
