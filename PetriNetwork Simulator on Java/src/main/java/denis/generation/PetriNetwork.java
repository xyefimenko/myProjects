package denis.generation;

import com.sun.org.glassfish.external.statistics.annotations.Reset;
import denis.exceptions.*;
import denis.generated.Arc;
import denis.generated.ArcType;
import denis.generated.Document;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import static denis.generated.ArcType.REGULAR;

public class PetriNetwork {

    private List<Place> places = new ArrayList<Place>();
    private List<Transition> transitions = new ArrayList<Transition>();
    private List<Arcs> arcs = new ArrayList<Arcs>();
    private List<ResetArcs> resetArcs = new ArrayList<ResetArcs>();




    private long maxId = 0;
    public PetriNetwork() {

    }

    public PetriNetwork(Document document) {
        for (denis.generated.Place place : document.getPlace()) {
            denis.generation.Place newPlace = new Place(place.getLabel(), place.getTokens(), place.getId());
            newPlace.setX(place.getX());
            newPlace.setY(place.getY());
            this.addPlace(newPlace);
            if(maxId < newPlace.getId()){
                maxId = newPlace.getId();
            }
        }


        for (denis.generated.Transition transition : document.getTransition()) {
            denis.generation.Transition newTransition = new denis.generation.Transition(transition.getLabel(), transition.getId());
            newTransition.setX(transition.getX());
            newTransition.setY(transition.getY());
            this.addTransition(newTransition);
            if(maxId < newTransition.getId()){
                maxId = newTransition.getId();
            }
        }

        for (Arc arc : document.getArc()) {
            switch (arc.getType()) {
                case REGULAR:
                    try {
                        this.addArc(arc.getId() ,arc.getSourceId(), arc.getDestinationId(), arc.getMultiplicity());
                    } catch (ArcException e) {
                        e.printStackTrace();
                    }
                    break;
                case RESET:
                    try {
                        this.addResetArc(arc.getSourceId(), arc.getDestinationId());
                    } catch (ArcException e) {
                        e.printStackTrace();
                    }
                    break;
            }
        }
    }

    public void checkAllTransitions() {
        for (ResetArcs ra : resetArcs) {
            getTransition(ra.getDestinationId()).setRunnable(true);
        }
        for (Arcs a : arcs) {
            Place p = getPlace(a.getSourceId());
            if (p != null && p.getTokens() >= a.getMultiplicity()) {
                getTransition(a.getDestinationId()).setRunnable(true);
            } else if (p != null) {
                getTransition(a.getDestinationId()).setRunnable(false);
            }
        }
    }

    public Transition getTransition(long id) {
        for (Transition t : transitions) {
            if (t.getId() == id) {
                return t;
            }
        }
        return null;
    }

    public Place getPlace(long id) {
        for (Place p : places) {
            if (p.getId() == id) {
                return p;
            }
        }
        return null;
    }

    public void addPlace(Place p) {
        this.places.add(p);
    }

    public void addTransition(Transition t) {
        this.transitions.add(t);
    }

    public void addArc(long id, long srcId, long dstId, int mul) throws ArcException {
        if (mul < 1) {
            throw new ArcException("Wrong multiplicity");
        }
        if ((idInPlaces(srcId) && idInPlaces(dstId)) || (idInTransits(srcId) && idInTransits(dstId))) {
            throw new ArcException("Cannot create arc. Same type start and end");
        }
        Arcs a = new Arcs(id ,srcId, dstId, mul);
        this.arcs.add(a);
        if(maxId < a.getId()){
            maxId = a.getId();
        }

    }

    public void addResetArc(long srcId, long dstId) throws ArcException {
        if (idInTransits(srcId)) {
            throw new ArcException("Reset arc can not start in transition");
        }
        if (idInPlaces(srcId) && idInPlaces(dstId)) {
            throw new ArcException("Cannot create arc. Same type start and end");
        }
        ResetArcs a = new ResetArcs(srcId, dstId);
        this.resetArcs.add(a);
        if(maxId < a.getId()){
            maxId = a.getId();
        }
    }

    public void runTransition(long id) {
        Transition t = getTransition(id);
        if (t.isRunnable()) {
            for (ResetArcs ra : resetArcs) {
                if (ra.getDestinationId() == t.getId()) {
                    getPlace(ra.getSourceId()).removeTokensForReset();
                }
            }
            for (Arcs a : arcs) {
                if (a.getDestinationId() == t.getId()) {
                    getPlace(a.getSourceId()).changeTokens(0 - a.getMultiplicity());
                }
                if (a.getSourceId() == t.getId()) {
                    getPlace(a.getDestinationId()).changeTokens(a.getMultiplicity());
                }
            }
        }
        this.checkAllTransitions();
    }

    private boolean idInPlaces(long id) {
        for (Place p : places) {
            if (id == p.getId()) {
                return true;
            }
        }
        return false;
    }

    private boolean idInTransits(long id) {
        for (Transition t : transitions) {
            if (id == t.getId()) {
                return true;
            }
        }
        return false;
    }

    public List<Place> getPlaces() {
        return places;
    }

    public List<Transition> getTransitions() {
        return transitions;
    }

    public List<Arcs> getArcs() {
        return arcs;
    }

    public List<ResetArcs> getResetArcs() {
        return resetArcs;
    }

    public long getMaxId() {
        return maxId;
    }

    public void setMaxId(long maxId) {
        this.maxId = maxId;
    }
}




